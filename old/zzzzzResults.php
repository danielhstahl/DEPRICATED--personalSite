<html>
    <head>
         
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <style>
            .input-group-addon {
                min-width:250px;
                text-align:left;
            }
        </style>
    </head>


    <body>
        <div class="jumbotron">
            <div class="container">
                <h1>Loan Pricing Model </h1>
                <p>Input parameters and get some results!</p>
            </div>   
        </div>
        <div class='container' id='mainInput'>
            <a href='#'>Documentation</a>
            <?php
            require 'bbtLPM.php';
            session_start();
            set_time_limit(300);
            $lpm = unserialize($_SESSION["LPM"]); //continue with class
            //there is a more efficient way to do this...iterate through keys, assign class variables, and don't explicitly call functions...but i think i dont' want to do that since I like the explicit dependence on variables in the function
            $ltv=$_POST["LTV"];
            $naics=$_POST["NAICSCode"];
            $loanAmount=$_POST["LoanAmount"];
            $callCode=$_POST["CallCode"];
            $collateralType=$_POST["CollateralType"];
            $zipCode=$_POST["ZipCode"];
            $maturity=$_POST["Maturity"];
            $dsc=$_POST["CashFlowCoverage"];
            $prePayment=$_POST["PrePayment"];
            $prePaymentPenalty=$_POST["PrePaymentPenalty"];
            $interestRateType=$_POST["InterestRateType"];
            
            $lpm->getLGD($ltv, $naics, $loanAmount, $callCode, $collateralType, $zipCode);
            $lpm->getPD($ltv, $naics, $loanAmount, $dsc);
            $lpm->getTransferPrice($interestRateType, $loanAmount, $maturity, $prePayment, $prePaymentPenalty);
            $lpm->getLGLiquid($callCode, $collateralType); 
            $lpm->computeEC();

            ?>
        
        <!-- <button id='submitButton' type="button" class="btn btn-primary">Submit</button>-->
        </div>
       


    </body>
    <script>
              
         
    
    </script>
</head>
