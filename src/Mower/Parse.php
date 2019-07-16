<?php 
// src/Mower/Parse.php
namespace App\Mower;

class Parse
{
    private $file;
    private $content;

    public function setFile($file)
    {
        echo $file.PHP_EOL;
        if (is_file($file))
        {
            $this->setFile= $file;
        }
        if ($this->getContent() == "") {
            $this->setContent(file_get_contents($file));
        }
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function getFile(){
        return $this->file;
    }
    public function getContent()
    {
        return $this->content;
    }
    public function parseFile ()
    {
        $rows = explode (PHP_EOL, $this->getContent());
        return $rows;
    }
}

?>