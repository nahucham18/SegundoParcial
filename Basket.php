<?php

include_once "Partido.php";

class Basket extends Partido{
    private $infracciones;

    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,$infracciones)
    {
        parent::__construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2,);
        $this->infracciones = $infracciones;
    }

    public function getInfracciones(){
        return $this->infracciones;
    }

    public function setInfracciones($infracciones){
        $this->infracciones = $infracciones;
    }

    public function coeficientePartido(){
        $infracciones = $this->getInfracciones();

        $coefBase = $this->getCoefBase();
        $cantColes1 = $this->getCantGolesE1();
        $cantColes2 = $this->getCantGolesE2();
        $totalGoles = $cantColes1 + $cantColes2;
        $coefInfracciones = 0.75 * $infracciones;

        if($totalGoles > 0){
            $coefBase = $coefBase * $totalGoles;
        }

        if($coefInfracciones > $coefBase){
            $coefBase = 0;
        }

        $this->setCoefBase($coefBase);
        return $coefBase;
    }


}