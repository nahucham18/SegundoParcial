<?php

include_once("Basket.php");
include_once("Futbol.php");

class Torneo
{
    private $partidos = [];
    private $ganadores;
    private $precio;

    public function __construct($precio)
    {
        $this->precio = $precio;
    }

    public function getPartidos()
    {
        return  $this->partidos;
    }
    public function setPartidos($partidos)
    {
        $this->partidos = $partidos;
    }
    public function getPrecio()
    {
        return  $this->precio;
    }
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }


    public function validarPartida($equipo1, $equipo2)
    {
        $valCat = false;
        $valJugadores = false;
        $validacion = false;
        $catEquipo1 = $equipo1->getObjCategoria();
        $catEquipo2 = $equipo2->getObjCategoria();
        $cat1 = $catEquipo1->getDescripcion();
        $cat2 = $catEquipo2->getDescripcion();
        $jugadores1 = $equipo1->getCantJugadores();
        $jugadores2 = $equipo2->getCantJugadores();
        if ($cat1 == $cat2) {
            $valCat = true;
        }

        if ($jugadores1 == $jugadores2) {
            $valJugadores = true;
        }


        if ($valCat && $valJugadores) {
            $validacion = true;
        }

        return $validacion;
    }



    public function ingresarPartido($ObjEquipo1, $ObjEquipo2, $fecha, $tipoPartido)
    {
        $validacion = false;
        $partidos = $this->getPartidos();
        $partido = null;
        if ($tipoPartido == "Futbol") {
            $validacion = $this->validarPartida($ObjEquipo1, $ObjEquipo2);
            if ($validacion) {
                $partido = new Futbol(uniqid(), $fecha, $ObjEquipo1, $ObjEquipo2, readline('Goles equipo 1:'), readline('Goles equipo 2:'), readline('Ingrese Categoria:'));
                
                array_push($partidos, $partido);
            }
        }
        if ($tipoPartido == "Basket") {
            $validacion = $this->validarPartida($ObjEquipo1, $ObjEquipo2);
            if ($validacion) {
                $partido = new Basket(uniqid(), $fecha, $ObjEquipo1, $ObjEquipo2, readline('Goles equipo 1:'), readline('Goles equipo 2:'), readline('Ingrese Infracicones:'));
                array_push($partidos, $partido);
            }
        }

        return $partido;
    }

    public function darGanadores($deporte)
    {
        $ganadoresTorneo = [];
        $goles = 0;

        foreach ($this->partidos as $partido) {
            if ($partido->getDeporte() instanceof $deporte) {
                $ganador = $partido->darEquipoGanador();
                if ($ganador[1] > $goles) {
                    $goles = $ganador[1];
                } elseif ($ganador[1] == $goles) {
                    $ganadoresTorneo[] = $ganador[0];
                }
            }
        }

        return $ganadoresTorneo;
    }

    public function calcularPremioPartido($objPartido) {
        $equipoGanador = $objPartido->darEquipoGanador();
        $premioPartido = $objPartido->coeficientePartido() * $this->getPrecio(); 
        

        return array(
            'equipoGanador' => $equipoGanador,
            'premioPartido' => $premioPartido
        );
    }

    public function __toString()
    {
        $cadena = "TORNEO\n";
        return $cadena;
    }
}
