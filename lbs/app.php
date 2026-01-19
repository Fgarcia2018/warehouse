<?php
// En esta clase se administran los CONTROLADORES
//Tener en cuenta que el archivo .htacces se creó para poder que apache entienda los / como simbolo para incluir parámetros en la url en lugar de los simbolos ? y &. en ese archivo se determinó que la variable url guardará esos parámetrps


// Como se va a reutilizar el controlador de errores se incluye el script al inicio
require_once './controllers/error.php';
class App{
    function __construct(){     
        // Se verifica si se envía la url incluyendo index.php o no
        $url=isset($_GET['url'])?$_GET['url']:null;
        // En caso de que digiten /// al final, se retiran
        $url=rtrim($url,'/');
        // explode Devuelve un array de string, siendo cada uno un substring del parámetro string formado por la división realizada por los delimitadores indicados en el parámetro
        $url=explode('/',$url); 
        
        // Si el primer elemento de la url está vacio, se redirecciona al login (si no se define controlador)
        if(empty($url[0])){
            $archivoController='controllers/login.php';
            require_once $archivoController;
            // nuevo objeto controlador Main, que en su constructor tiene una propiedad la cual crea una nueva instancia de la vista Main (index)
            $controller=new Login();
            $controller->loadModel('login');
            $controller->render();
            return false;
        }     
        //Se obtienen la url y se busca el controlador correspondiente
        $archivoController='controllers/'.$url[0].'.php';
        // Si el fichero existe se crea nueva instancia del controlador y se carga el modelo correspondiente
        if(file_exists($archivoController)){
            require_once $archivoController;
            // Nueva instancia del controlador
            $controller=new $url[0];
            $controller->loadModel($url[0]);
            // Se verifica el tamaño del array para verificar si se llama tambien a una funcion dentro del controlador y si tiene parámetros.
            $nparam=sizeof($url);
            if($nparam>1){
                if($nparam>2){
                    $param=[];
                    for($i=2;$i<$nparam;$i++){
                        array_push($param,$url[$i]);
                    }
                    // se ejecuta la función con sus parámetros
                    $controller->{$url[1]}($param);
                }else{
                    $controller->{$url[1]}();
                }
            }else{
                $controller->render();
            }       
        }else{
            //  se crea un nuevo objeto controlador errores
            $controller=new Errores();
        }        
    }
}
?>