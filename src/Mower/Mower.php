<?php 
// src/Mower/Mower.php
namespace App\Mower;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Formatter\LineFormatter;


class Mower
{
    private $direction; 
    private $xAxis;
    private $yAxis;
    const cardinate = array("N","E","S","O");
    private $lawn;
    private $logger;
    
    public function __construct ($d, $x, $y, $lawn)
    {
        $this->setDirection ($d); 
        $this->setXAxis ($x);
        $this->setYAxis($y);
        $this->setLawn($lawn);
        $this->logger = new Logger('logger');
        
    }
    public function setDirection($d)
    {
        $this->direction = $d;
    }
    public function setXAxis($x)
    {
        $this->xAxis = $x;
    }
    public function setYAxis($y)    
    {
        $this->yAxis = $y;
    }
    public function setLawn($lawn)    
    {
        $this->lawn = $lawn;
    }
    public function getDirection()
    {
        return $this->direction;
    }
    public function getXAxis()
    {
        return $this->xAxis;
    }
    public function getYAxis()
    {
        return $this->yAxis;
    }
    public function getLawn()
    {
        return $this->lawn;
    }
    public function getCardinate()
    {
        return self::cardinate;
    }
    public function add($a, $b)
    {
        return $a + $b;
    }
    public function move($d)
    {
        switch ($d) 
        {
            case "G":
                $this->rotateLeft();
                break;
            case "D":
                $this->rotateRight();
                break;
            case "A":
                $this->moveForward();
                break;
        }
       
    }
    public function rotateLeft()
    {
        $key = array_search($this->getDirection(), self::cardinate);
        
        if ($key ==0) {
            $key = 3;
        }
        else 
        {
            $key = $key -1;
        }
        $this->logger->info("change direction to ". self::cardinate[$key]);
        $this->setDirection(self::cardinate[$key]);
    }
    public function rotateRight()
    {
        $key = array_search($this->getDirection(), self::cardinate);
        
        if ($key ==3) {
            $key = 0;
        }
        else 
        {
            $key = $key + 1;
        }
        $this->logger->info("change direction to ". self::cardinate[$key]);
        $this->setDirection(self::cardinate[$key]);
    }

    public function moveForward ()
    {
        $y = $this->getYAxis();
        $x = $this->getXAxis();
        switch ($this->getDirection())
        {
            case "N":
                if ($y < $this->lawn->getYAxisMax())
                {
                    $this->setYAxis(++$y);
                }
                break;
            case "E":
                if ($x < $this->lawn->getXAxisMax())
                {
                    $this->setXAxis(++$x);
                }
                break;
            case "S":
                if ($y > 0)
                {
                    $this->setYAxis(--$y);
                }
                break;
            case "O":
                if ($x > 0)
                {
                    //$x = $x -1;
                    $this->setXAxis(--$x);
                }
                break;
        }
        $this->logger->info("move direction to ". $this->getXAxis()." ".$this->getYAxis());
        
    }
}