<?php

//BB&T implementation of LPM
require 'LPM.php'; //this is the implementing class
require 'stahlModel.php'; //this is the implementing class
class bbtLPM implements LPM {
    
    private $allLoanPD=array();
    private $allLoanLGD=array(); //for now, implement as a constant not an array of functions...
    private $allLoanR=array();
    private $allLoanW=array(); //of arrays?
    
    private $alpha=array(); //length "m"
    private $sig=array(); //
    private $rho=array(); //
    private $lambda0=0; //
    private $q=0; //
    private $t=0; //
    private $z0=array(); //
    private $options=array();
    
    private $currLoanPD=0;
    private $currLoanLGD=0;
    private $currLoanR=0;
    private $currLoanW=array();
    private $currLoanTP=0;
    
    public function __construct(){
        $a = func_get_args(); 
        $i = func_num_args(); 
        //echo $i;
        if($i==0){
            $options_=array( //in id=>placeholder format
                "InterestRateType"=>"Variable or Fixed", //dropdown eventually
                "CashFlowCoverage"=>"Debt Service Coverage (DSC)",
                "LTV"=>"Loan To Value (LTV)",
                "ZipCode"=>"Zip code of collateral",
                "NAICSCode"=>"Naics Code",
                "LoanAmount"=>"Balance or Line Limit",
                "Maturity"=>"Time to maturity in months", 
                "PrePayment"=>"Does this loan prepay (Y/N)", //checkbox/dropdown
                "PrePaymentPenalty"=>"Percent penalty for prepayment",
                "CallCode"=>"Call Code", //in dropdown eventually
                "CollateralType"=>"Collateral Type" //in dropdown eventually
            );
            $this->__construct1($options_);
        }
        else { //fake overloaded constructor
            if (method_exists($this,$f='__construct'.$i)) { 
                call_user_func_array(array($this,$f),$a); 
            } 
        }
       
    }
    public function __construct1($options_){
        $this->options=$options_;
        $txtToWrite='';
        foreach($options_ as $key=>$value){
            $txtToWrite=$txtToWrite . '<div class="input-group">';// <span class="input-group-addon" id="'+index+'">';
            $txtToWrite=$txtToWrite . '<span class="input-group-addon" id="' . $key . '">' . $value . '</span>';
            $txtToWrite=$txtToWrite . '<input type="text" name="'. $key . '" class="form-control required" placeholder="' . $value . '">';
            $txtToWrite=$txtToWrite . '</div>';
        }
        echo $txtToWrite;
    }
    public function getOptions(){
        return json_encode($this->options);
    }
    public function getLGD($ltv, $naics, $loanAmount, $callCode, $collateralType, $zipCode) {
        $this->currLoanLGD=.7*$loanAmount; //for testing...this should call the data from the model
    }  
    public function getPD($ltv, $naics, $loanAmount, $dsc){
        $this->currLoanPD=.02; //instantaneous PD
    }
    public function getTransferPrice($interestRateType, $loanAmount, $maturity, $prePayment, $prePaymentPenalty){
        $this->currLoanTP=.02; //cost of funds
    }
    public function getLGLiquid($callCode, $collateralType) {
        $this->currLoanR=.2; //20 percent haircut
    }
    public function getStahlParameters(){
        $this->alpha=array(.05, .3, .6);
        $this->sig=array(.1, .15, .2);
		$this->rho=array(array(1, .2, -.3), array(.2, 1, .1), array(-.3, .1, 1));
		
    }
    public function getLoanData() { //currently just using fake data...eventually will use real data (connect to db, etc)
        $n=10000;
        $m=count($this->alpha);
        if($m==0){
            $this->getStahlParameters();
        }
        $m=count($this->alpha);
        $maxRand=mt_getrandmax();
        $sumL=0;
       // echo $m;
        for($i=0; $i<$n; $i++){
            $unif=0;
            $wR=Array();
            for($j=0; $j<$m; $j++){
                $un=mt_rand()/$maxRand;
                $wR[]= $un;
                $unif=$unif+mt_rand()/$maxRand;
               // echo $un;
            }
            //print_r($un);
            $this->allLoanW[]=array();
            for($j=0; $j<$m; $j++){
                $this->allLoanW[$i][]=$wR[$j]/$unif;
            }
            $l=5000+40000*(mt_rand()/$maxRand);
            $this->allLoanPD[]=.03*(mt_rand()/$maxRand);
            $this->allLoanLGD[]=$l;
            $this->allLoanR[]=.3*(mt_rand()/$maxRand);
            //$this->allLoanW[]=$wR; //array of arrays
            $sumL=$sumL+$l;
        }
        $this->z0=array(.9, 1.1, 1.05);
        $this->lambda0=.01*$sumL;
        $this->q=.2/$sumL;
        $this->t=1.0;
    }
    public function computeEC() {
        if(count($this->alpha)==0){
            $this->getStahlParameters();
        }
        if($this->t==0){
            $this->getLoanData();
        } 
        
        echo $this->allLoanW[0][0];
        $stahlModel=new StahlModel($this->alpha, $this->sig, $this->rho, $this->allLoanPD, $this->allLoanLGD, $this->allLoanR, $this->allLoanW, $this->lambda0, $this->q,$this->t, $this->z0);
        $stahlModel->addLoan($this->currLoanPD, $this->currLoanLGD, $this->currLoanR, $this->currLoanW);
        $y=$stahlModel->getDistribution();
        $x=$stahlModel->getDomain();
        $var=$stahlModel->getVaR('.99'); //i hope this works...
        echo $var;
    }
    public function computeMinRate($minROE) {
        
    }

}






?>