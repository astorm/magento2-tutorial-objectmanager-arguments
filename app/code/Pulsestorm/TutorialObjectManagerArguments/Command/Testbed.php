<?php
namespace Pulsestorm\TutorialObjectManagerArguments\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use \Magento\Framework\ObjectManagerInterface;


class Testbed extends Command
{
    protected $output;
    protected $om;
    public function __construct(ObjectManagerInterface $om)
    {
        $this->om = $om;
        return parent::__construct();
    }
    
    protected function getObjectManager()
    {
        return $this->om;
    }
    
    protected function configure()
    {
        $this->setName("ps:tutorial-object-manager-arguments");
        $this->setDescription("A command the programmer was too lazy to enter a description for.");
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        $output->writeln("Installed!");          
        // $this->showPropertiesForObject();
    }
    
    protected function showPropertiesForObject()
    {
        $object_manager = $this->getObjectManager();        
        $object         = $object_manager->create('Pulsestorm\TutorialObjectManagerArguments\Model\Example');
        $properties     = get_object_vars($object);
        foreach($properties as $name=>$property)
        {
            $this->reportOnVariable($name, $property);       
        }
    }
    
    protected function getAOrAn($string)
    {
        if(in_array($string[0], ['a','e','i','o','u']))
        {
            return 'an';
        }
        return 'a';
    }
    
    protected function reportOnVariable($name, $thing)
    {
        $this->output('The Property $' . $name);
        $type = gettype($thing);
        $aoran   = $this->getAOrAn($type);
        $this->output('  is '.$aoran.' ' . $type);
        call_user_func([$this,'outputValueOf'.ucwords($type)],$thing);
//         $this->output('  of the class: ');
//         $this->output('  with a value of: ');
//         $this->output('  with the elements: ');
        $this->output('');        
    }
    
    protected function outputValueOfObject($thing)
    {
        $this->output('  created with the class: ');
        $this->output('  ' . get_class($thing));
        
    }

    protected function outputValueOfString($thing)
    {
        $this->output('  with a value of: ' . $thing);
    }    
    
    protected function outputValueOfInteger($thing)
    {
        $this->output('  with a value of: ' . $thing);
    }    
    
    protected function outputValueOfBoolean($thing)
    {
        $this->output('  with a value of: ' . ($thing ? 'true' : 'false'));
    }        

    protected function outputValueOfArray($thing)
    {
        $this->output('  with the elements: ');
        foreach($thing as $key=>$value)
        {
            $this->output('  ' . $key . '=>' . $value);
        }
    }                
    
    protected function output($string)
    {
        $this->output->writeln($string);
    }
} 