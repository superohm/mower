<?php // tests/Mower/mowerTest.php
namespace App\test\mower;
use App\Mower\Lawn;
use App\Mower\Mower;
use App\Mower\Parse;
use PHPUnit\Framework\TestCase;

class mowerTest extends TestCase
{
    public function testConstructor()
    {
        $lawn = new Lawn(5,5);        
        $mower = new Mower("N",1 ,2, $lawn);
        // assert that your instancy correctly your Mower !
        $this->assertEquals(1, $mower->getXaxis());
        $this->assertEquals(2, $mower->getYaxis());
        $this->assertEquals("N", $mower->getDirection());
    }

    public function testMoveLeft()
    {
        $lawn = new Lawn(5,5);
        $mower = new Mower("O",1 ,2, $lawn);
        $mower->move("G");
        // assert that your move left correctly by changing direction 
        $this->assertEquals("S", $mower->getDirection());
    }
    public function testMoveRight()
    {
        $lawn = new Lawn(5,5);
        $mower = new Mower("O",1 ,2, $lawn);
        $mower->move("D");
        // assert that your move right correctly by changing direction
        $this->assertEquals("N", $mower->getDirection());
        
    }
    public function testMoveForwardAndDirection()
    {
        $lawn = new Lawn(5,5);
        $mower = new Mower("O",1 ,2, $lawn);
        // move forward !
        $mower->move("A");
        //change direction 
        $mower->move("D");
        //move forward again
        $mower->move("A");
         // assert that your move forward correctly by changing Axis
        $this->assertEquals(0, $mower->getXaxis());
        $this->assertEquals(3, $mower->getYaxis());
        $this->assertEquals("N", $mower->getDirection());
    }
    public function testDontMoveOverthelimit()
    {
        $lawn = new Lawn(5,5);
        $mower = new Mower("E",5 ,5, $lawn);
        // move forward ! 
        $mower->move("A");
        // I can't move right forward nothing change
        $this->assertEquals(5, $mower->getXaxis());
        $this->assertEquals(5, $mower->getYaxis());
        $this->assertEquals("E", $mower->getDirection());
        //change direction to north
        $mower->move("G");
        $this->assertEquals("N", $mower->getDirection());
        //move forward again
        $mower->move("A");
        // I can't move up forward, nothing change expect direction
        $this->assertEquals(5, $mower->getXaxis());
        $this->assertEquals(5, $mower->getYaxis());
        
    }
    public function testInputContent()
    {
        $content = "55
        12 N
        GAGAGAGAA
        33 E
        AADAADADDA";
        $parse = new Parse();
        $parse->setContent($content);
        $rows = $parse->parseFile();
        // counter for create new mower :
        $cpt=0;
        // counter to know if it's instruction line
        $cptLine = 0;
        // remove first line contain the lawn dimension and create lawn :
        $lawn = new Lawn($rows[0][0],$rows[0][1]);
        unset($rows[0]);
        foreach($rows as $key=>$val){
            // extract position first line a line of the file and trim (remove space):
            if ($cptLine == 0)
            {
                $array_position = str_split(trim($val));
                $mower = new Mower(trim($array_position[3]), trim($array_position[0]), trim($array_position[1]), $lawn);
                $cptLine=1;
            }
            elseif ($cptLine == 1)
            {
                // we got move instruction 
                // put the instruction in a array and trim (remove space):
                $array_instruction = str_split(trim($val));
                //count nb instruction 
                $nbMoveInstruction = count($array_instruction);
                // iterate for each instruction line
                for ($i=0;$i<$nbMoveInstruction;$i++) {
                    // operate the move :
                    $mower->move($array_instruction[$i]);
                }
                // reset the counter of instruction (next line be a mower position)
                $cptLine=0;
                // increase the mower counter
                $cpt = $cpt + 1;
            }
            // end of instruction get position for the first mower ($cptLine = 0 to know if the moves are done)
            if ($cpt == 1 && $cptLine == 0) {
                // first mower :
                $this->assertEquals("N", $mower->getDirection());
                $this->assertEquals(1, $mower->getXaxis());
                $this->assertEquals(3, $mower->getYaxis());
            }
            elseif ($cpt == 2)
            {
                // second mower :
                $this->assertEquals("E", $mower->getDirection());
                $this->assertEquals(5, $mower->getXaxis());
                $this->assertEquals(1, $mower->getYaxis());
            }
        }
    }
    public function testInputFile()
    {
        // get the absolute path for the instruction file;
        $file = dirname(__DIR__, 2)."/instructionFile.txt";
        $parse = new Parse();
        $parse->setFile($file);
        $rows = $parse->parseFile();
        // counter for create new mower :
        $cpt=0;
        // counter to know if it's instruction line
        $cptLine = 0;
        // remove first line contain the lawn dimension and create lawn :
        $lawn = new Lawn($rows[0][0],$rows[0][1]);
        unset($rows[0]);
        foreach($rows as $key=>$val){
            // extract position first line a line of the file and trim (remove space):
            if ($cptLine == 0)
            {
                $array_position = str_split(trim($val));
                $mower = new Mower(trim($array_position[3]), trim($array_position[0]), trim($array_position[1]), $lawn);
                $cptLine=1;
            }
            elseif ($cptLine == 1)
            {
                // we got move instruction 
                // put the instruction in a array and trim (remove space):
                $array_instruction = str_split(trim($val));
                //count nb instruction 
                $nbMoveInstruction = count($array_instruction);
                // iterate for each instruction line
                for ($i=0;$i<$nbMoveInstruction;$i++) {
                    // operate the move :
                    $mower->move($array_instruction[$i]);
                }
                // reset the counter of instruction (next line be a mower position)
                $cptLine=0;
                // increase the mower counter
                $cpt = $cpt + 1;
            }
            // end of instruction get position for the first mower ($cptLine = 0 to know if the moves are done)
            if ($cpt == 1 && $cptLine == 0) {
                // first mower :
                $this->assertEquals("N", $mower->getDirection());
                $this->assertEquals(1, $mower->getXaxis());
                $this->assertEquals(3, $mower->getYaxis());
            }
            elseif ($cpt == 2)
            {
                // second mower :
                $this->assertEquals("E", $mower->getDirection());
                $this->assertEquals(5, $mower->getXaxis());
                $this->assertEquals(1, $mower->getYaxis());
            }
        }
    }
}
