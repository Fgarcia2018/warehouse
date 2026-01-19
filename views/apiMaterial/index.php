<?php
//  header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");  
$urlapi=$_GET['url'];
$urlapi=explode('/',$urlapi); 
require_once 'controllers/consulta.php';
$consultaMaterial=new Consulta();
$consultaMaterial->loadModel('consulta');
$nparam=sizeof($urlapi);
if($nparam>1){
    if($urlapi[1]==='id'){
        $consultaMaterial->getApiMaterialById($urlapi[2]);
    }elseif($urlapi[1]==='num_entrada'){
        $consultaMaterial->getIdEntrada();    
    }elseif($urlapi[1]==='num_salida'){
        $consultaMaterial->getIdSalida(); 
    }
}else{
    $consultaMaterial->getApiMateriales();
}



