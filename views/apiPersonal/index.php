<?php
$urlapi=$_GET['url'];
$urlapi=explode('/',$urlapi); 
require_once 'controllers/consulta.php';
$consultaPersonal=new Consulta();
$consultaPersonal->loadModel('consulta');
$consultaPersonal->getApiPersonal();
