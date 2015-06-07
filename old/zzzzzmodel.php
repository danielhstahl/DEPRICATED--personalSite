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
            <form action="Results.php" method="post">
                <?php
                require 'bbtLPM.php';
                session_start();
                $lpm=new bbtLPM();
                $_SESSION["LPM"]=serialize($lpm); //keep instance throughout session...
                
                ?>
                <input id='submitButton' type="submit" class="btn btn-primary"></input>
            </form>
            
        
        </div>
        


    </body>
    <script>
        $('#submitButton').click(function(e){
            var allFilledIn=true;
            $('.required').each(function(val){
                if(!$(this).val()){
                    allFilledIn=false;
                }
        
            });
            if(!allFilledIn){
                alert("requires all to be filled in!");
                return false;
            }
            /*else { //in future DONT DO AJAX!!! do form submit, go to another page, show results, etc
                $.ajax({
                    url: 'bbtLPM.php',
                    type: 'post',
                    data: {'action': 'follow', 'userid': '11239528343'},
                    success: function(data, status) {
                        if(data == "ok") {
                            $('#followbtncontainer').html('<p><em>Following!</em></p>');
                            var numfollowers = parseInt($('#followercnt').html()) + 1;
                            $('#followercnt').html(numfollowers);
                        }
                    },
                    error: function(xhr, desc, err) {
                        console.log(xhr);
                        console.log("Details: " + desc + "\nError:" + err);
                     }
                });
         
            }*/
        });
        
         
    
    </script>
</head>
