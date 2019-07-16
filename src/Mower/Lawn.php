<?php 
// src/Mower/Lawn.php
namespace App\Mower;

class Lawn
{
    
    private  $XAxisMax; 
    private  $YAxisMax; 

    
    public function __construct ($x, $y)
    {
        
        $this->setXAxisMax($x);
        $this->setYAxisMax($y);
    }
    public function setXAxisMax($x)
    {
        $this->XAxisMax = $x;
    }
    public function setYAxisMax($y)
    {
        $this->YAxisMax = $y;
    }
    
    public function getXAxisMax()
    {
        return $this->XAxisMax;
    }
    public function getYAxisMax()
    {
        return $this->YAxisMax;
    }
}