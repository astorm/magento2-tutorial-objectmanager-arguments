<?php
namespace Pulsestorm\TutorialObjectManagerArguments\Model;
class Example
{
    public $object1;
    public $object2;
    public $scaler1;
    public $scaler2;
    public $scaler3;
    public $array;
    
    public function __construct(
        ExampleArgument1 $object1,
        ExampleArgument2 $object2,
        $scaler1='foo',
        $scaler2=0,
        $scaler3=false,
        $array=['foo'])        
    {
        $this->object1 = $object1;
        $this->object2 = $object2;    
        
        $this->scaler1 = $scaler1;
        $this->scaler2 = $scaler2;
        $this->scaler3 = $scaler3;        
        $this->array   = $array;                
    }
}