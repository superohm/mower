<?php // tests/Mower/lawnTest.php
namespace App\test\lawn;

use App\Mower\Lawn;
use PHPUnit\Framework\TestCase;

class lawnTest extends TestCase
{
    
    public function testSetXAxisMax()
    {
        $lawn= new Lawn(1,2);
       
        // check constructor and get method
        $this->assertEquals(1, $lawn->getXaxisMax());
        $this->assertEquals(2, $lawn->getYaxisMax());

    }

}
