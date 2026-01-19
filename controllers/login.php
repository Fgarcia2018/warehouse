<?php
class Login extends Controller{
    function __construct(){
        parent::__construct();              
    }
    function render(){
        $this->view->render('login/index');
    }
    function validar(){
        //Se guardan los valores enviados desde el formulario login. Para que se omitan caracteres especiales, y evitar
        //inyecciones sql, se utilizan las funciones htmlentities() y addslashes().
        $login=htmlentities(addslashes($_POST['usuario']));
        $pass=htmlentities(addslashes($_POST['password']));
        // Se implementa validacion por medio de google recaptcha
        // IP del servidor desde donde se envía la petición, este dato es opcional para enviarlo en la petición
        $ip=$_SERVER['REMOTE_ADDR'];
        $captcha=$_POST['g-recaptcha-response'];
        $secretkey='6Lf8-v8mAAAAAAY7i0Wyj5yybgEgeVo2p8elsmbr';
        // Se guarda la respuesta enviada por el servidor
        $respuesta=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretkey&response=$captcha");
        // Se decodifica el JSON enviado por el servidor
        $atributos=json_decode($respuesta,true);
        //Se incluye archivo usuarios_model.php donde se encuentra la clase usuarios 
        require_once 'controllers/consulta.php';        
        // se crea un objeto de la clase usuario para validar usuarios
        $urlapi=$_GET['url'];
        $urlapi=explode('/',$urlapi); 
        $usuario=new Consulta();
        $usuario->loadModel('consulta');        
        // Se valida si el recaptcha no fué enviado por el usuario
        if(!$atributos['success']){
            $mensaje='verificar Captcha';
            header("location:".constant('URL')."login?mensaje=".$mensaje);
        }else{
            $usuario->validarUsuario($login,$pass);
        } 
    }
}    