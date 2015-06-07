<!DOCTYPE html>

<html>

    <head>

         <?php include 'assets/includes/header.php'; ?>
        <style>
            .stockUp{
                color: green;
            }
            .stockDown{
                color:red;
            }
        
        </style>
    </head>

    <body>

        <div class='jumbotron navbar-fixed-top'>

            <div class="container title">

                About

            </div>

        </div>
        <div class='container'>
            <div class='title'>
                Summary
            </div>
            <div class='txt'>
                I work for BB&T (<span class='stock' id='NYSE:BBT'></span>) in Audit Analytics.  I have a masters degree in mathematical finance from the University of North Carolina Charlotte.  Previously I worked as a model developer and risk analyst at Uwharrie Capital Corp (<span class='stock' id='OTCMKTS:UWHR'></span>); a small community bank outside Charlotte, NC.  I am 
                <?php $datetime1 = new DateTime('now'); 
                    $birthdate = new DateTime('1989-04-10'); 
                    $interval = date_diff(new DateTime('now'), new DateTime('1989-04-10')); 
                    $yearAlive=$interval->format('%y');
                    echo $yearAlive; 
                ?>
                years old, married to a wonderful woman, and currently residing in Winston Salem, NC.
            </div>
            <br>
            <div class='title'>
                Analytics
            </div>
            <div class='txt'>
                Audit Analytics provides data services to Audit Services to facilitate audit testing.  These data services involve creating visualizations to make the underlying data accessible and actionable to Audit Services, automating audit testing, and providing self-service tools for auditors to dynamically explore the data.  Audit provides a unique opportunity for analyzing data.  Audit's mandate is to independently access bank data sources in order to provide assurance around the bank's processes.  Hence all the bank's data is available for Audit Analytics to mine.  These data sources can be as diverse as system access data (for example, using active directory), portfolio data at the loan level, and transactional data for wires.
                
            </div>
            <br>
            <div class='title'>
                Model Risk
            </div>
            <div class='txt'>
                In addition to data acquisition and data visualization, Audit Analytics also audits model risk management.  Similar to the data element of Audit Analytics' purpose, auditing MRMD allows Audit Analytics to be exposed to every model at the bank.  The diverse mathematical techniques and the variety of ways in which models meet business needs provides constant learning opportunities.  
            
            </div>
        </div>

        <?php include 'assets/includes/menu.php';?> <!--side menu -->

    </body>

    <?php include 'assets/includes/footerScripts.php';?> <!--final includes for side menu --> 

    <script>
        $(document).ready(function(){
            $('.stock').each(function(index, value){
                var symbol=$(this).attr('id');
                //console.log(symbol);
                getStock(symbol, $(this));
                //console.log(html);
               // $(this).prepend(html);
            });
            
            function getStock(stockSymbol, element){
                var url='https://finance.google.com/finance/info?client=ig&q='+stockSymbol+'&callback=?';
                //console.log(url);
                var stockString ='';//'<div class="stockWrapper">';
                $.ajax({
                    url:url,
                   // type:'POST',
                    dataType:'json',
                    data:JSON.stringify({}),
                    success: function(response){
                        //console.log(response);
                        var stockInfo = response[0];
                        
                        var stockClass="stockUp";
                        if(stockInfo.c.substring(0, 1)==='-'){
                            stockClass="stockDown";
                        }
                        stockString +='<span class="stockSymbol">'+stockInfo.t+'</span>';
                        
                        stockString +='<span class="stockPrice"> '+stockInfo.l+'</span>';
                        stockString +='<span class="stockChange '+stockClass+'"> '+stockInfo.c+'</span>';
                       // console.log(stockString);
                        //stockString +='<span>at</span> <span class="stockTime">'+stockInfo.ltt+'</span>';
                        //stockString +='</div>';
                        element.prepend(stockString);
                        //return stockString;
                    }
                });
                return stockString;
            }     
        });
 
    </script>

</head>