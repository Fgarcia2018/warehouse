<?php     
//Se valida si el usuario realizó el proceso de logueó, si no lo realizó no puede navegar por el sitio.     
session_start(); 
if(!isset($_SESSION['usuario'])){ 
    if (!headers_sent()){
        header("location:".constant('URL')."login");  
    }else{
        echo'<script type="text/javascript">window.location.href="'.constant('URL').'login";</script>';
    }    
}                             
?>        
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>::::WAREHOUSE🛠:::::</title>
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/styles.css">
</head>
<body>    
    <nav class="menu">
        <section class="menu_container">
            <h1 class="menu-logo">WAREHOUSE🛠</h1>
            <ul class="menu_links">
                <li class="menu_item">
                    <a href="<?php echo constant('URL');?>main" class="menu_link">Main</a>
                </li>
                <li class="menu_item menu_item--show">
                    <a href="" class="menu_link">Registrar <img src="public/assets/arrow.svg" alt="" class="menu_arrow"></a>
                    <ul class="menu_nesting">
                        <li class="menu_inside">
                            <a href="<?php echo constant('URL');?>newmat" class="menu_link menu_link--inside">Entrada De Material</a>
                        </li>
                        <li class="menu_inside">
                            <a href="<?php echo constant('URL');?>outmat" class="menu_link menu_link--inside">Salida De Material</a>
                        </li>
                    </ul>
                </li>
                <li class="menu_item menu_item--show">
                    <a href="#" class="menu_link">Consultas<img src="public/assets/arrow.svg" alt="" class="menu_arrow"></a>
                    <ul class="menu_nesting">
                        <li class="menu_inside">
                            <a href="<?php echo constant('URL');?>consulta" class="menu_link menu_link--inside">Stock</a>
                        </li>
                        <li class="menu_inside">
                            <a href="<?php echo constant('URL');?>consultaEntrada" class="menu_link menu_link--inside">Entradas De Material</a>
                        </li>   
                        <li class="menu_inside">
                            <a href="<?php echo constant('URL');?>consultaSalida" class="menu_link menu_link--inside">Salidas De Material</a>
                        </li>       
                         <li class="menu_inside">
                            <a href="<?php echo constant('URL');?>consultaInformes" class="menu_link menu_link--inside">Informes</a>
                        </li>       
                    </ul>
                </li>
                <li class="menu_item">
                    <a href="<?php echo constant('URL');?>docs" class="menu_link">Documentos</a>
                </li>
                <li class="menu_item">
                    <a href="<?php echo constant('URL');?>ayuda" class="menu_link">Ayuda</a>
                </li>
                <li class="menu_item">
                    <a href="<?php echo constant('URL');?>cierre/cerrarSesion" class="menu_link">Cerrar sesión</a>
                </li>
                
            </ul>
        </section>
    </nav>
   
    