<!DOCTYPE html>
 
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.14.2/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/ScrollMagic.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/animation.gsap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/debug.addIndicators.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"><!-- CDN -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script><!-- CDN -->
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>-->
 
 
 
 
<style type="text/css">
                html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
 
                .panel {
                                height: 100%;
                                width: 100%;
                }
    .first{
        background-image: url("Network-Server-Room.jpg");
        background-repeat:no-repeat;
        background-size:cover;
        //background-size:100% 100%;
    }
    h1 {
        text-align: center;
        position: relative;
        top: 80%;
        transform: translateY(-50%);
        //transform: translateX(-150%);
        
        display: block;
        font-family: 'Raleway', sans-serif;
    }
</style>
 
</head>
<body>               
               
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid"> </div>
    </nav>
    <section class="panel first">
        <!--<div class="container">
        <img src="singapore.jpg" class="img-responsive" alt="Responsive image">   
          </div> -->  
        <h1 style="visibility:inherit; opacity:1; "><font color="#DDD5E1">Daniel Stahl</font></h1>                                                   
                                                        
                       
        
    </section>
    <section class="panel">
        <div class="container">
             
            <div class='col-md-8'>
            <h3> Purpose </h3> <br>
                Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum                                                               
            </div>
            <div class='col-md-4'>
                <img src="test.jpg" class="img-responsive" alt="Responsive image">                                                    
            </div>
                       
        </div>
    </section>
    <section class="panel">
        <div class="container">
            <div class='col-md-8'>
            <h3> Hodor </h3> <br>
                Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum                                                               
            </div>
            <div class='col-md-4'>
                <img src="test.jpg" class="img-responsive" alt="Responsive image">                                                    
            </div>
                       
        </div>
    </section>
 
 
</body>
 
<script>
    $(function () { // wait for document ready
        $('.navbar').hide();
        // init
        var controller = new ScrollMagic.Controller({
            globalSceneOptions: {
                triggerHook: 'onLeave'
            }
        });

        // get all slides
        var slides = document.querySelectorAll("section.panel");
        new ScrollMagic.Scene({
                triggerElement: slides[0]
            })
            .setPin(slides[0])
            //.addIndicators() // add indicators (requires plugin)
            .addTo(controller).on("leave", function(e){
                $('.navbar').show();
            }).on("enter", function(e){
                $('.navbar').hide();
            });
        for (var i=1; i<slides.length; i++) {
           // if(i==0){
                
            //}
            new ScrollMagic.Scene({
                    triggerElement: slides[i]
                })
                .setPin(slides[i])
                //.addIndicators() // add indicators (requires plugin)
                .addTo(controller);
        }
    });
</script>
</html>