<?php 
// src/Mower/Parse.php
namespace App\Mower;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Processor\UidProcessor;
use Monolog\Processor\WebProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Formatter\LineFormatter;


class Parse
{
    private $file;
    private $content;
    private $logger;

    public function __construct ()
    {
        $this->logger = new Logger('logger');
    }
    public function setFile($file)
    {
        if (is_file($file))
        {
            $this->setFile= $file;
            if ($this->getContent() == "") {
                $this->setContent(file_get_contents($file));
            }
        }
        else 
        {
            $this->logger->info("file expected");
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