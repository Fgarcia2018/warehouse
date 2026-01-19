<?php
include_once 'code.php';
$miArticulo=new articulo();

if (isset($_POST['descripcion']) && isset($_POST['unidad']) && isset($_POST['categoria'])){
   
    $miArticulo->set_articulo($_POST['descripcion'],$_POST['unidad'],$_POST['categoria']);

    
}elseif(){
    echo 'error';
   
}




