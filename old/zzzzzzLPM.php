<?php

//LPM interface
interface LPM {

    public function getLGD($ltv, $naics, $loanAmount, $callCode, $collateralType, $zipCode);//calls results from "external" LGD model. "naics" can be 0 for consumer...note that in this implementation LGD*balance is the "l" from the Stahl model.  The Stahl model is more general than this, allowing for stochastic "l".  In a "perfect" world, the LGD model would at least hand over a "distribution" for each "l" and not simply be a number, but this may require some more sophistication of the bank...
    public function getPD($ltv, $naics, $loanAmount, $dsc); //how to differentiate consumer and commercial...consumer needs credit scores not naics
    public function getTransferPrice($interestRateType, $loanAmount, $maturity, $prePayment, $prePaymentPenalty);//calls results from "external" transfer pricing algorithm
    public function getLGLiquid($callCode, $collateralType);//calls results from "loss given liquidity" model
    public function getStahlParameters();//gets the empirically estimated parameters for the underlying processes in the Stahl model
    public function getLoanData();//
    public function computeEC();//actually conputes the laons' EC
    public function computeMinRate($minROE); //minimum acceptable rate

}






?>