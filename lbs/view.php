<?php
class view{
    function __construct(){
        // echo'<p> vista Base</p>';        
    }
    function render($nombre){
        require 'views/'.$nombre.'.php';
    }
}
?>