<?php
class Partido{
    private $idpartido;
    private $fecha;
    private $objEquipo1;
    private $cantGolesE1;
    private $objEquipo2;
    private $cantGolesE2;
    private $coefBase;

    //CONSTRUCTOR
    public function __construct($idpartido, $fecha,$objEquipo1,$cantGolesE1,$objEquipo2,$cantGolesE2){
            $this->idpartido = $idpartido;
            $this->fecha = $fecha;
            $this->objEquipo1 =$objEquipo1;
            $this->cantGolesE1 = $cantGolesE1;
            $this->objEquipo2 = $objEquipo2;
            $this->cantGolesE2 = $cantGolesE2;
            $this->coefBase = 0.5;


    }

    //OBSERVADORES
    public function setidpartido($idpartido){
         $this->idpartido= $idpartido;
    }

    public function getIdpartido(){
        return $this->idpartido;
    }

    public function setFecha($fecha){
        $this->fecha= $fecha;
    }

    public function getFecha(){
        return $this->fecha;
    }


 public function setCantGolesE1($cantGolesE1){
        $this->cantGolesE1= $cantGolesE1;
    }

    public function getCantGolesE1(){
        return $this->cantGolesE1;
    }
 public function setCantGolesE2($cantGolesE2){
        $this->cantGolesE2= $cantGolesE2;
    }

    public function getCantGolesE2(){
        return $this->cantGolesE2;
    }



 public function setObjEquipo1($objEquipo1){
        $this->objEquipo1= $objEquipo1;
    }
    public function getObjEquipo1(){
        return $this->objEquipo1;
    }


 public function setObjEquipo2($objEquipo2){
        $this->objEquipo2= $objEquipo2;
    }
    public function getObjEquipo2(){
        return $this->objEquipo2;
    }




     public function setCoefBase($coefBase){
         $this->coefBase = $coefBase;
    }
      public function getCoefBase(){
        return $this->coefBase;
    }


    //METODO darEquipoGanador()
    public function darEquipoGanador(){
        $goles1 = $this->getCantGolesE1();
        $goles2 = $this->getCantGolesE2();
        $equipo1 = $this->getObjEquipo1();
        $equipo2 = $this->getObjEquipo2();
        $goles = $goles1;

        $ganador = [$equipo1, $equipo2];
        if($goles1 > $goles2){
            echo "entre";
            $ganador = [$equipo1];
            $goles = $goles1;
        }

        if($goles1 < $goles2){
            echo "entre";
            $ganador = [$equipo2];
            $goles = $goles2;
        }

        return [$ganador,$goles];

    }

    public function coeficientePartido(){
        $coefBase = $this->getCoefBase();
        $equipo1 = $this->getObjEquipo1();
        $equipo2 = $this->getObjEquipo2();
        $cantGoles1 = $this->getCantGolesE1();
        $cantGoles2 = $this->getCantGolesE2();
        $cantJugadores1 = $equipo1->setCantJugadores();
        $cantJugadores2 = $equipo2->setCantJugadores();
        $totalJugadores = $cantJugadores1 + $cantJugadores2;
        $totalGoles = $cantGoles1 + $cantGoles2;
        $coefBase = ($totalGoles + $totalJugadores) * $coefBase;
        $this->setCoefBase($coefBase);
        return $coefBase;
    }




public function __toString(){
        //string $cadena
        $cadena = "idpartido: ".$this->getIdpartido()."\n";
        $cadena = $cadena. "Fecha: ".$this->getFecha()."\n";
        $cadena = $cadena."\n"."--------------------------------------------------------"."\n";
        $cadena = $cadena. "<Equipo 1> "."\n".$this->getObjEquipo1()."\n";
        $cadena = $cadena. "Cantidad Goles E1: ".$this->getCantGolesE1()."\n";
          $cadena = $cadena. "\n"."--------------------------------------------------------"."\n";
         $cadena = $cadena. "\n"."--------------------------------------------------------"."\n";
        $cadena = $cadena. "<Equipo 2> "."\n".$this->getObjEquipo2()."\n";
        $cadena = $cadena. "Cantidad Goles E2: ".$this->getCantGolesE2()."\n";
         $cadena = $cadena. "\n"."--------------------------------------------------------"."\n";
        return $cadena;
    }
}


?>