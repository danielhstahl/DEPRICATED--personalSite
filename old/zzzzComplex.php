<?php

//complex number class
class Complex {
    private $real=0;
    private $im=0;
    public function __construct(){
        $this->real=0;
        $this->im=0;
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        } 
    }
    public function __construct2($real, $im){
        $this->real=$real;
        $this->im=$im;
    }

	public function multiply(Complex $c) {
      //  $this->real=$this->real*$c->real-$this->im*$c->im; //will this work!?!? (accessing private variable)
       // $this->im=$this->im*$c->real+$this->real*$c->im;
        $localReal=$c->getReal();
        $localIm=$c->getIm();
        $cmp=new Complex($this->real*$localReal-$this->im*$localIm, $this->im*$localReal+$this->real*$localIm);
        return $cmp;

	}

	public function exp() {
        $localReal=exp($this->real)*cos($this->im);
        $localIm=exp($this->real)*sin($this->im);
        $cmp=new Complex($localReal, $localIm);
        return $cmp;
		//Complex plac=new Complex(Math.exp(real)*Math.cos(im), Math.exp(real)*Math.sin(im));
		//return plac;
	}
	public function log() {
		$modulus=sqrt($this->real*$this->real+$this->im*$this->im);
        $cmp=new Complex(log($modulus), atan2($this->im, $this->real));
        return $cmp;
	}
	public function add(Complex $c) {
        $localReal=$c->getReal();
        $localIm=$c->getIm();
		$cmp=new Complex($this->real+$localReal, $this->im+$localIm);
		return $cmp;
	}
	public function power($exponent) {
		$modulus=sqrt($this->real*$this->real+$this->im*$this->im);
		$arg=atan2($this->im, $this->real);
		$log_re=log($modulus);
		$log_im=$arg;
		$x_log_re=$exponent*$log_re;
		$x_log_im=$exponent*$log_im;
		$modulus_ans=exp($x_log_re);
        $cmp=new Complex($modulus_ans*cos($x_log_im), $modulus_ans*sin($x_log_im));
		//Complex plac=new Complex(modulus_ans*Math.cos(x_log_im), modulus_ans*Math.sin(x_log_im));
		return $cmp;
	}
	public function getReal() {
		return $this->real;
	}
	public function getIm() {
		return $this->im;
	}



}






?>