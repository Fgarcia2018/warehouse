<?php
class Cierre extends Controller{
    function __construct(){
        parent::__construct();  
    }    
    function cerrarSesion(){        
        session_start();
        session_destroy();        
        header("location:".constant('URL')."login");
    }
}