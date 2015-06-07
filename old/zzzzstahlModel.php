<?php

//stahl model for economic capital
require 'Complex.php';
class StahlModel {
    private $y0=array();//lenght is number of "concentrations"
    private $alpha=array(); //lenght is number of "concentrations"
    private $sigma=array();//lenght is number of "concentrations"
    private $rho=array();//lenght is number of "concentrations" by number of conentrations..make sure is positive semidefinite
   // private int k; //number of u discretions
    //private int h; //number of x discretions
    private $p=array(); //lenght is number of "assets"
    private $l=array(); //lenght is number of "assets"
    private $r=array(); //lenght is number of "assets"
    private $w=array(); //weights of each asset...length of assets by length of concentrations
    private $lambda0=0;
    private $n=0;//number o assets
    private $m=0; //number of concentrations
    private $q=0;
    private $tau=0;
    private $y=array();
    private $x=array();
    private $lambda=0;
	private $exloss=0; //numerical
	private $vloss=0; //numeric
	private $eLoss=0; //analytic
	private $var=0; //analytic
    private $ValueAtRisk=array();//at .01 intervals...
	private $riskContribution=array();
	private $elContribution=array();
    private $defaultK=256;
    private $defaultH=1024;
    public function __construct($alpha_, $sigma_, $rho_, $p_, $l_, $r_, $w_, $lambda0_, $q_,$tau_, $y0_){
        $this->alpha=$alpha_;
        $this->sigma=$sigma_;
        $this->rho=$rho_;
        $this->p=$p_;
        $this->l=$l_;
        $this->r=$r_;
        $this->lambda0=$lambda0_;
        $this->q=$q_;  
        $this->tau=$tau_;
        $this->n=count($this->p);
        $this->m=count($this->alpha);
        $this->y0=$y0_;
        $this->lambda=0;
		$this->w=$w_;
        //for($i=0; $i<1000;$i++){
       //     $key=$i/1000;
           // array_push($this->ValueAtRisk, $key=>0.0);//for now, just 0.0
        //}
		//riskContribution=new Double[n];
		//elContribution=new double[n];
        for($i=0; $i<$this->n; $i++){
            $this->lambda=$this->lambda+$this->r[$i]*$this->l[$i];
        }
        $this->lambda=$this->lambda+$this->lambda0;
    }
    private function helpComputeMoments($alpha){ //hleper function since called so much
        return((1.0-exp(-$alpha*$this->tau))/$alpha);
    }
    private function phiZ($v){ //v is an array of complex values and has length m
        $el=new Complex(0, 0);
        $var=new Complex(0, 0);
        for($i=0; $i<$this->m; $i++){
            $ai=$this->helpComputeMoments($this->alpha[$i]);
            $eli=new Complex(($this->y0[$i]-1.0)*$ai+$this->tau, 0.0);
            $eli=$eli->multiply($v[$i]);
            $el=$el->add($eli);
            //double vari=0;
            for($j=0; $j<$this->m; $j++){
                $aj=$this->helpComputeMoments($this->alpha[$j]);
                $helpVarij=($this->rho[$i][$j]*$this->sigma[$i]*$this->sigma[$j]/($this->alpha[$i]*$this->alpha[$j]))*($this->tau-$ai-$aj+(1.0-exp(-($this->alpha[$i]+$this->alpha[$j])*$this->tau))/($this->alpha[$i]+$this->alpha[$j])); //difra page 10
                $varij=new Complex($helpVarij, 0);
                $var=$var->add($varij->multiply($v[$j])->multiply($v[$i]));
            }
            
        }
        $var=$var->multiply(new Complex(.5, 0.0))->add($el);
        $phi=$var->exp();
        return $phi;    
    }
    private function computeV($u){
        $v=array(); //of complex values
        $upperU=new Complex(0, $u*$this->lambda); //liquidity risk..u*lambda*i
        $upperU=$upperU->exp()->add(new Complex(-1.0, 0.0))->multiply(new Complex($this->q, 0.0));//.multiply(new Complex(0, 1));//q*(exp(i*u*lambda)-1)
		$upperU=$upperU->add(new Complex(0, $u)); //liquidity..u*i+q*(exp(u*lambda*i)-1)
        for($j=0; $j<$this->m; $j++){
            
            $v[]=new Complex(0, 0);
            for($i=0; $i<$this->n;$i++){
                $helperV=new Complex($this->w[$i][$j]*$this->p[$i], 0); //w_{j, k}*p_j
                $phiForL=$this->phiL($upperU, $this->l[$i])->add(new Complex(-1.0, 0.0));//e^{i*u*l_j}-1
                $v[$j]=$v[$j]->add($helperV->multiply($phiForL)); //w_{j, k}p_j*(e^{i*u*l_j}-1)
            }
        }
        return($v);
    
    }
	
    private function phiL(Complex $u, $l){ //for now, l is a constant...this may be a parameter in the future (if LGD is a distribution)
        //Complex phi=new Complex(0, u*l);
        return($u->multiply(new Complex($l, 0))->exp()); //e^{u*l}
    }
    private function computeDistribution(
        $k, //number of u discretions
        $h, //number of x discretions
        $xmax
    ) { //items that may vary...
        if(is_null($k)){
            $k=$this->defaultK;
        }
        if(is_null($h)){
            $h=$this->defaultH;
        }
        if(is_null($xmax)){ //default xmax
            if($this->eLoss==0){
                $this->computeMoments();
            }
            $xmax=$this->eLoss+sqrt($this->var)*19;//using chebeshev's inequality
        }
        $du=M_PI/$xmax;
        $dx=$xmax/($h-1.0);
        $cp=2.0/$xmax;
        $f=array();//new double[k];
        $this->y=array();
        $this->x=array();
        for($j=0; $j<$k; $j++){
            $v=$this->computeV($du*$j);
            $f[]=$this->phiZ($v)->getReal()*$cp;
            //f[j]=;
			//System.out.println(f[j]);
        }
        $f[0]=.5*$f[0];
        $this->exloss=0;
        $this->vloss=0;
        $cdf=0.0;
        for($i=0;  $i<$h; $i++){
            $this->y[]=0.0;
            $this->x[]=$i*$dx;
            for($j=0; $j<$k; $j++){
                $this->y[$i]=$this->y[$i]+$f[$j]*cos($du*$j*$dx*$i);
            }
            
            $valueRisk=0.0;
            if($cdf>$valueRisk){
                $key=strval($valueRisk);
                $this->ValueAtRisk[$key]=$cdf;// value at risk array
                $valueRisk=$valueRisk+.001;//increments of .001;
            }
            $cdf=$cdf+$this->y[$i]*$dx;
            
			$this->vloss=$this->vloss+$this->y[$i]*$i*$dx*$dx*$i;
            $this->exloss=$this->exloss+$this->y[$i]*$i*$dx;
        }
        $this->exloss=$this->exloss-$xmax*.5*$y[$h-1];
		$this->exloss=$this->exloss*$dx;
		$this->vloss=$this->vloss-$xmax*.5*$xmax*$y[$h-1];
		$this->vloss=$this->vloss*$dx;
		$this->vloss=$this->vloss-$this->exloss*$this->exloss;
    }
	public function getVaR($confidence){
        if(count($this->ValueAtRisk)==0){
            $this->computeDistribution();
        }
        return $this->ValueAtRisk[$confidence];
    }
    public function getDistribution($k, $h, $xmax){
        if(count($this->y)==0){
            $this->computeDistribution($k, $h, $xmax);
            
        }
        return $this->y;
    }
    public function getNumericalExLoss(){
        if($this->exloss==0){
            $this->computeDistribution($defaultK, $defaultH);
        }
        return $this->exloss;
    } 
	public function getNumericalVariance(){
        if($this->vloss==0){
            $this->computeDistribution($defaultK, $defaultH);
        }
        return $this->vloss;
    }

	public function getAnalyticRiskContribution($k, $c){
        if(is_null($c)){
            $c=1;
        }
		if(is_null($this->riskContribution[0])){
			$this->computeMoments();
		}
		return $this->elContribution[$k]+$c*$this->riskContribution[$k]/(sqrt($this->var));
	}

	private function computeVariance($c1, $c2){
		$varianceY=0;
		for($i=0; $i<$this->m; $i++){
			$ai=$this->helpComputeMoments($this->alpha[$i]);
			for($j=0; $j<$this->m; $j++){
				$aj=$this->helpComputeMoments($this->alpha[$j]);
				$varianceY=$varianceY+($c1[$i]*$c2[$j]*$this->rho[$i][$j]*$this->sigma[$i]*$this->sigma[$j]/($this->alpha[$i]*$this->alpha[$j]))*($this->tau-$ai-$aj+(1.0-exp(-($this->alpha[$i]+$this->alpha[$j])*$this->tau))/($this->alpha[$i]+$this->alpha[$j]));
			
			}
		
		}
		return $varianceY;
	}

	private function computeEL($c1){
		$expectationY=0;
		for($i=0; $i<$this->m; $i++){
			$ai=$this->helpComputeMoments($this->alpha[$i]);
			$expectationY=$expectationY+(($this->y0[$i]-1.0)*$ai+$this->tau)*$c1[$i];
		}
		return $expectationY;
	}
	private function computeMoments(){ //computes analytical expectation and variance
		$varP=array();
		$pl=array();
		$plE=array();
		$eLossP=array();
		$this->var=0;
		$this->eLoss=0;
		//compute ek and vk
		$ek=array();//new double[m];
		$vk=array();
		$mvk=array();
		for($j=0; $j<$this->m; $j++){
			$ek[]=0.0;
			$vk[]=0.0;
            
			for($i=0; $i<$this->n; $i++){
				$ek[$j]=$ek[$j]+$this->p[$i]*$this->l[$i]*$this->w[$i][$j];
				$vk[$j]=$vk[$j]+$this->p[$i]*$this->l[$i]*$this->l[$i]*$this->w[$i][$j];			
			}
		}
		/*compute expected loss and variance */
		$this->eLoss=$this->computeEL($ek);
		$this->var=$this->computeVariance($ek, $ek)+$this->computeEL($vk);
		
		/*compute marginal contributions */
        $this->riskContribution=array();
        $this->elContribution=array();
		$lmdbq0=(1.0+$this->lambda0*$this->q);
		for($i=0; $i<$this->n; $i++){
			
			//elContribution[i]=0;
			$elW=$this->computeEL($this->w[$i]);//this is clever
			//elContribution[i]=p[i]*l[i]*elW;
			$this->elContribution[]=$this->p[$i]*$this->l[$i]*$elW*(1.0+$this->lambda0*$this->q)+$this->r[$i]*$this->l[$i]*$this->q*$this->eLoss;
			$this->riskContribution[]=$this->p[$i]*$this->l[$i]*$this->l[$i]*$elW;
			$vlW=$this->computeVariance($this->w[$i], $ek);//this is clever
			$this->riskContribution[$i]=$this->riskContribution[$i]+$this->p[$i]*$this->l[$i]*$vlW;
			$this->riskContribution[$i]=$this->riskContribution[$i]*$lmdbq0*$lmdbq0;
			$this->riskContribution[$i]=$this->riskContribution[$i]+$this->q*$this->p[$i]*$this->l[$i]*$this->lambda0*$this->lambda0*$elW;
			$this->riskContribution[$i]=$this->riskContribution[$i]+2.0*$this->r[$i]*$this->l[$i]*$this->q*$this->var;
			$this->riskContribution[$i]=$this->riskContribution[$i]+$this->r[$i]*$this->l[$i]*$this->q*$this->var*$this->q*($this->lambda+$this->lambda0);
			$this->riskContribution[$i]=$this->riskContribution[$i]+$this->r[$i]*$this->l[$i]*($this->lambda0+$this->lambda)*$this->q*$this->eLoss;
		}

		$lmdbq=(1.0+$this->lambda*$this->q);
		$this->var=$this->var*$lmdbq*$lmdbq+$this->eLoss*$this->q*$this->lambda*$this->lambda;
		$this->eLoss=$this->eLoss*$lmdbq;

	
	}
	public function getVariance(){
		if($this->var==0){
			$this->computeMoments();
		}
		return $this->var;
	}
	public function getEL(){
		if($this->eLoss==0){
			$this->computeMoments();
		}
		return $this->eLoss;
	}
    public function addLoan($p, $l, $r, $w){ //w is an array
        array_push($this->p, $p);
        array_push($this->l, $l);
        array_push($this->r, $r);
        array_push($this->w, $w);
    }
    public function getDomain(){
         if(count($this->x)==0){
            //if(is_null($k)){
            $this->computeDistribution();
            //}
            //else {
                //computeDistribution($k, $h, $xmax);
           // }
            //
        }
        return $this->x;
    }
    
}






?>