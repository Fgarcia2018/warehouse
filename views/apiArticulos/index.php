<?php
header("Access-Control-Allow-Origin:https://mercalist.kesug.com");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

$urlapi=$_GET['url'];
$urlapi=explode('/',$urlapi); 
require_once 'controllers/consulta.php';
$consultaArticulos=new Consulta();
$consultaArticulos->loadModel('consulta');
$nparam=sizeof($urlapi);
if($nparam>1){
    if($urlapi[1]==='id'){
       $consultaArticulos->getApiMaterialById($urlapi[2]);
    }elseif($urlapi[1]==='num_entrada'){
        $consultaArticulos->getIdEntrada();    
    }elseif($urlapi[1]==='num_salida'){
        $consultaArticulos->getIdSalida(); 
    }
}else{
    $consultaArticulos->getApiArticulos();
}



