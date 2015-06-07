<html>
    <head>
         
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="http://latex.codecogs.com/latexit.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.14.2/TweenMax.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/ScrollMagic.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/animation.gsap.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/debug.addIndicators.js"></script>
        <!--<script src="//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/plugins/debug.addIndicators.min.js"></script>-->
        
        
        <link rel="stylesheet" href="styles/default.css">
        <script src="highlight.pack.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
       
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
            .eq {
               text-align: center;
               
                 display: block;
            }
               
        </style>
    </head>


    <body>
    <div class="Container">
        <div class='col-md-8'>
            <h3>Disclaimer: Rigor is sacrificed for the sake of clarity.  Most proofs or derivations are heuristic.</h3>
            <h3>Characteristic functions explained</h3>
            The characteristic function of a random variable <span lang="latex">X</span> is defined as <span class='eq' lang='latex'>\phi(u)=\mathbb{E}\left[e^{uiX}\right]=\int_\Omega e^{uiX} d\mathbb{P}(\omega)=\int_{\mathbb{R}} e^{uix} f(x) dx</span>  The last equality assumes that the random variable <span lang="latex">X</span> has a density function <span lang='latex'>f(x)</span>. By Fourier's inversion theorem, <span class="eq" lang="latex">\frac{1}{2\pi} \int_\mathbb{R} e^{-iux} \phi(u) du = f(x) </span>
            
            <h4>Simple Example </h4>
            
            The density of a normal random variable with mean <span lang="latex">\mu</span> and variance <span lang="latex">\sigma^2 </span> is 
            <span class='eq' lang="latex">f(x)=\frac{1}{\sqrt{2\pi} \sigma} e^{-\frac{(x-\mu)^2}{2\sigma^2}}</span>
            The characteristic function is 
            <span class='eq' lang="latex">\phi(u)= e^{u \mu i - \frac{\sigma^2 u ^2}{2}}</span>
            To demonstrate the Fourier inversion theorem, we will invert <span lang='latex'>\phi(u)</span> to recover <span lang='latex'>f(x)</span>
            <span class='eq' lang='latex'>\frac{1}{2\pi} \int_\mathbb{R} e^{-iux} e^{u \mu i - \frac{\sigma^2 u^2}{2}} du </span>
            <span class='eq' lang='latex'>=\frac{1}{2\pi} \int_\mathbb{R} e^{ui (\mu-x) - \frac{\sigma^2 u^2}{2}} du </span>
            <span class='eq' lang='latex'>=\frac{1}{2\pi} \int_\mathbb{R} e^{- \frac{\sigma^2}{2}\left(u-\frac{(\mu-x)i}{\sigma^2}\right)^2 -\frac{1}{2\sigma^2}(\mu-x)^2 } du </span>
            <span class='eq' lang='latex'>=\frac{1}{\sqrt{2\pi}}e^{-\frac{1}{2\sigma^2}(x-\mu)^2 } \int_\mathbb{R} \frac{1}{\sqrt{2\pi}}e^{- \frac{z^2}{2} } \frac{dz}{\sigma} </span>
            Where <span lang='latex'>z=\sigma\left(u-\frac{(\mu-x)i}{\sigma^2}\right)</span> and <span lang='latex'>dz=\sigma du</span>.  
            <span class='eq' lang='latex'>=\frac{1}{\sqrt{2\pi}\sigma}e^{-\frac{1}{2\sigma^2}(x-\mu)^2 } \int_\mathbb{R} \frac{1}{\sqrt{2\pi}}e^{- \frac{z^2}{2} } dz </span>
            <span class='eq' lang='latex'>=\frac{1}{\sqrt{2\pi}\sigma}e^{-\frac{1}{2\sigma^2}(x-\mu)^2 } </span>
        
        
        
            <h3>Density of the First Hitting Time </h3>
            
            With few exceptions, the density of the first hitting time of even a single dimensional Stochastic Differential Equation (SDE) is not explicitly known.  However, finding the distribution numerically is not computationally difficult.  
            <br>
            <h4>Dynkan's Formula</h4>
            In what follows, the driving process is <span lang="latex">X_t</span> which solves the SDE <span lang="latex"> dX=\alpha(X_t, t)dt+\sigma(X_t, t)dW_t </span> with initial value <span lang="latex">X_0</span>.  Dynkan's formula states the following:
            <span class='eq' lang="latex"> \mathbb{E}[g(X_\tau)]=g(X_0)+\mathbb{E}\left[\int_0 ^ \tau \mathcal{A}g dt \right]</span>
            
            Where <span lang="latex"> \mathcal{A}=\alpha(x, t)\frac{\partial }{\partial x} + \sigma^2(x, t) \frac{1}{2} \frac{\partial^2}{\partial x^2}</span> is the generator of <span lang="latex"> X_t</span> and <span lang="latex"> \tau </span> is a stopping time with respect the filtration generated by the Brownian motion. 
            
            <h4>The Trick </h4>
            
            The characteristic function of a random variable <span lang="latex"> X_t</span> can be numerically inverted to recover the density.  Recalling that the characteristic function is defined as 
            <span class='eq' lang="latex"> \phi(u)=\mathbb{E}\left[e^{uiX_T}\right]</span> and letting <span lang="latex"> g(X_t)=e^{uiX_t}h(X_t)</span>, then by Dynkan's formula we have 
            <span class='eq' lang="latex"> \phi(u)=\mathbb{E}[e^{uiX_T}]=h(X_0)+\int_0 ^ \tau \left(Ah+uih\right) dt</span>
            
            With <span lang="latex"> fh(X_T)=1 </span>.  <span lang="latex"> \phi(u) </span> is then the solution to the ODE 
            
            <span class='eq' lang="latex"> \mathcal{A}h+uih=0</span> 

            
            With terminal condition <span lang="latex">h(X_T)=1 </span>.  This ODE can be efficiently solved numerically (eg, by using finite difference methods) and then numerically inverted to obtain the density function of <span lang="latex">\tau</span>.  The following "r" functions provide examples of this inversion.  
                    
              
              <pre><code class="r">
ode=function(n, alpha, sigma, mu, delta, m){
 #number of discrete steps, drift, volatility, complex term, CEV parameter, barrier.
  f=c(2:(n-1))-1
  xVal=c(1:(n))
  dx=m/(n-1)
  lngth=length(f)
  
  #finite difference using implicit method
  as=-(mu+sigma*sigma*(f^(2*delta))*(dx^(2*delta))/(dx*dx)) #diagonal of tridiagonal matrix
  bs=f*alpha*.5+.5*sigma*sigma*(f^(2*delta))*(dx^(2*delta))/(dx*dx) #upper diagonal of tridiagonal matrix
  gs=.5*sigma*sigma*(f^(2*delta))*(dx^(2*delta))/(dx*dx)-f*alpha*.5 #lower diagonal of tridiagonal matrix
  mat=matrix(0/c(1:(lngth* lngth)), lngth, lngth) #tridiagonal matrix
  
  mat[row(mat)==col(mat)]=as #set the vectors of the tridiagonal matrix
  mat[row(mat)==(col(mat)-1)]=gs[2:lngth]
  mat[row(mat)==(col(mat)+1)]=bs[1:(lngth-1)]

  x=0/c(2:(n-1))
  x[length(f)]=-bs[length(f)]
  f=solve(mat, cbind(x))
  xVal[1]=0
  xVal[n]=1
  xVal[2:(n-1)]=f[1:(n-2)]
  return(xVal)
}
            </code></pre>
            
            The following algorithm inverts the density numerically.  This algorithm was proposed by Fang and Oosterlee as an efficient option pricing method, but they also point out its speed and precision with inverting densities.
            <pre><code class="r">
ff=function(n, k, l, m, alpha, delta, sigma) { 
  #n is the number of discretions in u, k is descretions in x-axis, 
  #l is the discretions in the ODE solution, m is the hitting value,
  #alpha is the coefficient on dX, delta is the power of X (one corresponds to Black Scholes),
  #and sigma is the volatility
  
  exVal=abs(log(m/s)/(alpha-.5*sigma^2)) #rough expected value based on analytic expression when delta=1
  std=sqrt(abs((log(m/s)*sigma^2)/((alpha-.5*sigma^2)^3))) #rough standard deviation based on analytic expression when delta=1
  xmax=exVal+std*5 # a fairly "wide" range (in "production" applications, this would use something like Chebyshev's formula to compute the range)
  lam=xmax/(k-1)
  du=pi/xmax
  cp=2/xmax
  f=matrix(0/c(1:(l * n)), n, l)
  x=c(1:k)
  y=matrix(0/c(1:(k * l)), k,l)
  
  ff=sapply(c(0:(n-1)), function(u){ode(l, alpha, sigma, complex(1, 0, u*du), delta, m)})
  f= Re(ff)*cp

  f[1, ]=.5*f[1, ]

  u=du*(0:(m-1))
  K=0:(k-1)
  y=sapply(K, function(K)(sum(f[, K]*cos(u*lam*K))))
  x=(K+1)*lam

  z=cbind(x, y)

  return(z)

}

            </code></pre>
        
        
        </div>
        <div class='col-md-4'>
        <img src="density.png" class="img-responsive" alt="Responsive image">
        </div>
      
    </div>

    </body>
    <script>
       
        
         
    
    </script>
</head>
