<?php

class DatosReservasC{

    public function ctrCargarReservas(){
        return DatosReservasM::mdlCargarReservas();
        
    }
    public function ctrCargarReservasTravel(){
        return DatosReservasM::mdlCargarReservasTravel();
        
    }

    public function ctrCargarReservasAmenities(){
        return DatosReservasM::mdlCargarReservasAmenities();
    }

    public function ctrCargarReservasEstado(){
        return DatosReservasM::mdlCargarReservasEstado();
    }

    public function ctrCargarReservasMontos(){
        return DatosReservasM::mdlCargarReservasMontos();
    }

   
}