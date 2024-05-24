<?php

include_once "Partido.php";

class Futbol extends Partido{
    private $categoria;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2)
    {
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,);
        $this->categoria = $objEquipo1->getCategoria();
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    public function coeficientePartido(){
        $categoria = $this->getCategoria();

        $coefBase = $this->getCoefBase();
        $cantColes1 = $this->getCantGolesE1();
        $cantColes2 = $this->getCantGolesE2();
        $totalGoles = $cantColes1 + $cantColes2;

        if($categoria == "Mayores"){
            $coefBase = 0.27;
        }elseif($categoria == "juveniles"){
            $coefBase = 0.19;
        }else{
            $coefBase = 0.13;
        }

        if($totalGoles > 0){
            $coefBase = $coefBase * $totalGoles;
        }

        $this->setCoefBase($coefBase);
        return $coefBase;
    }


}