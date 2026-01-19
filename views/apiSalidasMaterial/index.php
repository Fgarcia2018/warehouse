<?php
$urlapi=$_GET['url'];
$urlapi=explode('/',$urlapi); 
require_once 'controllers/consulta.php';
$consultaSalidas=new Consulta();
$consultaSalidas->loadModel('consulta');
$nparam=sizeof($urlapi);
if($urlapi[1]==='agrupada'){
    $consultaSalidas->getApiSalidas($urlapi[2]);
    
}



