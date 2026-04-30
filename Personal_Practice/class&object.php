<?php
class car {
    public $color;
    public $model;

    function setCar($color,$model){
        $this->color=$color;
        $this->model=$model;
    }
    function getCar(){
        return $this->color . ' ' . $this->model;
    }
}

$car1=new car();
$car1->setCar('Red','Toyota Supra');
echo $car1->getCar();
?>