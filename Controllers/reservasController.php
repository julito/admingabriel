<?php

class DatosReservasC{
    public function ctrCargarEstadisticas($fechas,$hotel){
        return DatosReservasM::mdlCargarEstadisticas($fechas,$hotel);
        
    }

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

    public function ctrBorrarReservaciones(){
        return DatosReservasM::mdlBorrarReservaciones();
    }

    public function ctrContarReservasCanceladas(){
        return DatosReservasM::mdlCargarReservasCanceladas();
    }

   
}