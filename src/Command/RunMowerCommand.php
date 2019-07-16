<?php
// src/Command/runMowerCommand.php
namespace App\Command;
use App\Mower\Lawn;
use App\Mower\Mower;
use App\Mower\Parse;;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class RunMowerCommand extends Command
{
    protected static $defaultName = 'app:run-mower';
    public function configure()
    {
        
        $this
        // the short description shown while running "php bin/console list"
        ->setDescription('Execute the mower test')

        // the full command description shown when running the command with
        // the "--help" option
        ->setHelp('This command allows you to execute the mower test')
        ->addArgument('instructionFile', 
        InputArgument::REQUIRED ,
        'the instruction file with absolute path is required')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $parse = new Parse();
        $output->writeln('instruction file : '.$input->getArgument('instructionFile'));
        $parse->setFile($input->getArgument('instructionFile'));
        $output->writeln([
            'Start run mower',
            '============',
            '',
        ]);
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
                $output->writeln([
                    '============',
                    'first mower result',
                    '============',
                    '',
                ]);
                $output->writeln('Direction  : '.$mower->getDirection());
                $output->writeln('X Axis  : '.$mower->getXaxis());
                $output->writeln('Y Axis  : '.$mower->getYaxis());
            }
            elseif ($cpt == 2)
            {
                // second mower :
                // first mower :
                $output->writeln([
                    '============',
                    'second mower result',
                    '============',
                    '',
                ]);
                $output->writeln('Direction  : '.$mower->getDirection());
                $output->writeln('X Axis  : '.$mower->getXaxis());
                $output->writeln('Y Axis  : '.$mower->getYaxis());
            }
        }
    }
}
