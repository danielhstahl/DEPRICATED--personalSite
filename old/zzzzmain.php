<!DOCTYPE html>
 
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.0/TweenMax.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/ScrollMagic.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/animation.gsap.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/debug.addIndicators.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"><!-- CDN -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script><!-- CDN -->
<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script> -->
 
 
 
 
<style type="text/css">
    html, body {
        height: 100%;
        margin-top: -1px; 
        margin-bottom:-1px;
        margin-right:-10px;
        margin-left:-1px;
        padding: 0;
        
    }
    
    
        
        
        
    .panel {
        height: 100%;
        width: 100%; 

        padding-top: 60px; 

    }  
    #first{
        background-image: url("Network-Server-Room.jpg");
        background-repeat:no-repeat;
        background-size:cover;
        //background-size:100% 100%;
    }
    #displayName {
        position: relative;
        top: 60%;
         display: block;
        font-family: 'Raleway', sans-serif;
        font-size: 500%;
        color:#F2F2F2;
    }
    
    h1 {
        text-align: center; 
        
        
        display: block;
        font-family: 'Raleway', sans-serif;
    }
   
    .background {
        font-size: 300%;
        
       display: block;
       font-family: 'Raleway', sans-serif;
    } 
    .txt {
        font-size: 175%;
       display: block;
       font-family: 'Raleway', sans-serif;
    }  
    .productivity, .myProjects { 
        background-color: #FCFCFC;
     
    } 
     .data, .myResearch {
        background-color: #FAFAFA; 
    
    }
     .model, .myInterests {
        background-color: #F2F2F2;
    
    }
    
     
    #menuContainer{
        padding:0;
        min-width:100px;
    }
    .links{ 
        position: relative;
        list-style: none;
        padding-bottom: 15px;
        padding-left:  
        top: 0px;
        opacity:0;
        text-align: left;
    }
   // .delay1{ 
   //     animation-delay: 0.2s;
   //     -webkit-animation-delay: 0.2s;
   // }
    //.delay2{
     //   animation-delay: 0.4s;
     //   -webkit-animation-delay: 0.4s;
    //}
    @keyframes drop {
      from { 
        top: -50px;
      }
      to {
        top: 50px;
        animation-timing-function: ease-out;
      }
    }
    @-webkit-keyframes drop {
      from {
        top: -50px; 
      }

      to {  
        top: 50px;
        -webkit-animation-timing-function: ease-out;
      }
    }
    .animate{
    
        animation: drop 0.9s;
        -webkit-animation: drop 0.9s;
        animation-fill-mode: forward;
        opacity: 1;
        -webkit-animation-fill-mode: forward;
        opacity: 1; 
    }
    #navElement{
        
        left: 85%;
        padding-top:10px;
        position:fixed;
        min-height:50px;
        width:50px;
        z-index:999;
        opacity:1;
    }
    #navBox {
        fill: #F2F2F2;
    }
</style>
 
</head>


<svg id="svg-source" height="0" version="1.1" 
  xmlns="http://www.w3.org/2000/svg" style="position:absolute; margin-left: -100%" 
  xmlns:xlink="http://www.w3.org/1999/xlink">
  <g id="menu" data-iconmelon="80 icons pack:df4c03e14fffd286f5d0afe417c30316">
    <g>
      <g>
        <path d="M2.081,8.724h27.838C31.068,8.724,32,7.791,32,6.643c0-1.149-0.932-2.08-2.081-2.08H2.081C0.932,4.562,0,5.493,0,6.643
			C0,7.791,0.932,8.724,2.081,8.724z"></path>
      </g>
      <g>
        <path d="M29.919,13.918H2.081C0.932,13.918,0,14.851,0,15.999c0,1.15,0.932,2.081,2.081,2.081h27.838
			c1.149,0,2.081-0.931,2.081-2.081C32,14.851,31.068,13.918,29.919,13.918z"></path>
      </g>
      <g>
        <path d="M29.919,23.276H2.081C0.932,23.276,0,24.207,0,25.357c0,1.147,0.932,2.08,2.081,2.08h27.838
			c1.149,0,2.081-0.933,2.081-2.08C32,24.207,31.068,23.276,29.919,23.276z"></path>
      </g>
    </g>
  </g>
</svg>

<body>               
               
  <!-- <header id='navHead'> 
        <nav class='navigation'>
            <div class='navButton btn-menu'>
                <span class='glyphicon glyphicon-menu-hamburger'> </span>
                <ul>
                    <li class='myProjects'>Projects</li>
                    <li class='myResearch'>Research</li>
                    <li class='myInterests'>Interests</li>
                </ul>
            </div>
        </nav>
   
   </header> -->
   
  <!-- <nav class="nav" id='navBox' >
       
        
        <a href="#"> <span class='glyphicon glyphicon-menu-hamburger' aria-hidden="true"> </span></a>
        <ul> 
            <li  class='myProjects'><a href="#">Projects</a></li> 
            <li  class='myResearch'><a href="#">Research</a></li>
            <li  class='myInterests'><a href="#">Interests</a></li>
        </ul>
           
    </nav> -->

    
    <div id='navElement' >
        <!--<li role="presentation" class="dropdown">-->
          <div  id='dropdown'><svg viewBox="0 0 32 32" id='navBox'><use xlink:href="#menu"></use> </svg></div>
          <ul class=" hidden" id='menuContainer'>
            <li  class='links txt myProjects'><a href="#">Projects</a></li> 
            <li  class='links txt myResearch'><a href="#">Research</a></li>
            <li  class='links txt myInterests'><a href="#">Interests</a></li>
             
          </ul>
       <!-- </li>-->
            
     </div>
   
    <!--test to see if wrapping sections in a div still works -->
   
    <section class="panel" id='first'>
        <div class="container" id='displayName'>
          
            <div class='col-md-8'  style="visibility:inherit; opacity:1; ">
                Daniel Stahl<!--<h1 style="visibility:inherit; opacity:1; "><font color="#DDD5E1">-->      
            </div>
            

        </div>                                                
                       
        
    </section>
    <section id='prod' class="panel productivity">
        <div class="row">
            <div class="container " > <!--style="background-image: url(../../img/example_parallax_bg1.png);"-->
                <div class='background productivity col-md-4' id='productivityDesc'>
                <!--<div class='background productivity' id='productivityDesc'>-->
                    Productivity
                </div>
                <div class='col-md-8 txt'>
                <!--<div class='col-md-12 txt'>  -->
                    Humans are naturally creative thinkers.  Many mundane and repetitive tasks are delegated to humans in the corporate world.  These are the tasks at which computers are superior.  My passion is to realize productivity enhancements through the proper design of workflows so that the workload is optimally divided between man and machine.  A happy byproduct of such an optimization is a technically superior, critically engaged workforce.                                                               
                </div>
            </div>            
        </div>
    </section>
    <section class="panel data">
        <div class="row">
            <div class="container " > <!--style="background-image: url(../../img/example_parallax_bg1.png);"-->
                <div class='background data col-md-4' id='dataDesc'>
                    Data Management
                </div>
                <div class='col-md-8 txt'>
                   The purpose of data is to deliver information to humans in an actionable form. This purpose implies data availability, data integrity, and data connectivity.  To help achieve this purpose, I have self-imposed the following criteria:
                   <ul>
                   <li>Every data table that I create will have a primary key.  </li>
                   <li>In the nearly universal case that more than one table is required to maintain efficient and normalized data, every pertinent table will have at least one foreign key. </li>
                   </ul>
                   
                   This purpose also precludes humans from ever altering, viewing, or touching data at any granular level.  Humans were not intended to accurately and efficiently process data.
                </div>
                       
            </div>
        </div>
    </section>
    
    
    
     <section class="panel model">
        <div class="row">
            <div class="container " > <!--style="background-image: url(../../img/example_parallax_bg1.png);"-->
                <div class='background model col-md-4' id='modelDesc'>
                    Mathematical Modeling
                </div>
                <div class='col-md-8 txt'>
                
                    The purpose of a model is to interpret data for human consumption.  The use of mathematical sophistication implies that models are most useful when applied to a complex problem.  The constraint on a model is that to add value to the decision making process of a human, it must be computationally efficient, it must have output that is applicable and understandable to the audience, and it must be reliable.  As with data, I have self-imposed the following constraints in creating a model:
                    <ul>
                    <li> The model must be parsimonious</li>
                    <li> The model must, whenever practicable, have a semi-analytical solution (to the point that efficient methods of solutions can achieved)</li>
                    <li> The model must be repeatable.</li>
                    <li> The model must be have a GUI interface.</li>
                    
                    </ul>
                </div>
                
                           
            </div>
        </div>
    </section>
 
    
</body>
 
<script>
    $(function () { // wait for document ready
        var isMobile=false;
        //$('#navBox').click(showMenu);
        $('#navBox').click(showMenu); //hover takes two functions, one for entering hover, and one for leaving
        function showMenu(){
            //console.log("got here1");
            var menu=$('#menuContainer');
           // console.log(menu);
            if(menu.hasClass('hidden')){
                //console.log("got here!");
                
                /*$('.links').each(function(index){
                    var delay=index*.2+'s';
                    $(this).css("animation-delay", delay);
                    $(this).css("-webkit-animation-delay", delay); 
                                  
                });*/
                $('.links').addClass('animate');
                menu.removeClass('hidden');
            }
            else {
                $('.links').removeClass('animate');
                menu.addClass('hidden');
            }
            
            
        
        }
        
        if(screen.width<=480){ //then mobile
            isMobile=true; 

        }
        // init
        var controllerWipes = new ScrollMagic.Controller({
            globalSceneOptions: {
                triggerHook: 'onLeave'
            }
        });
        

        if(!isMobile){
            var blockTween = new TweenMax.to('#displayName', 1, {
                    //backgroundColor: 'red'
                    top: 0
                }); 
            new ScrollMagic.Scene({  
                triggerElement: $('body')[0],
                duration: '70%' //$(this).height()
            })
            //.setPin('#displayName')
            .setTween(blockTween)
            //.addIndicators() // add indicators (requires plugin)
            .addTo(controllerWipes);
             
             
            var colorTween = new TweenMax.to('#navBox', 0, {
                    fill: 'black'
                });
             
             new ScrollMagic.Scene({  
                triggerElement:$("#prod")[0]//,
               // duration: '70%' //$(this).height()
            })
            .setTween(colorTween)
            .addTo(controllerWipes);
           
            $('section.panel').each(function(index, value){ 
       
               
                new ScrollMagic.Scene({
                        triggerElement: value 
                    })
                    .setPin(value)
                    //.addIndicators() // add indicators (requires plugin)
                    .addTo(controllerWipes); 
            
        
            });
        }
        

    });
</script>
</html>