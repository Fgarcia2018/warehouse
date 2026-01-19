<?php
$urlapi=$_GET['url'];
$urlapi=explode('/',$urlapi); 
require_once 'controllers/consulta.php';
$consultaEntradas=new Consulta();
$consultaEntradas->loadModel('consulta');
$nparam=sizeof($urlapi);
if($urlapi[1]==='agrupada'){
    $consultaEntradas->getApiEntradas($urlapi[2]);
}



