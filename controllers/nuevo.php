<?php
class Nuevo extends Controller{
        function __construct(){
                parent::__construct();   
                $this->view->mensaje='';    
        }
        function render(){
                $this->view->render('nuevo/index');
        }
        function registrarPersona(){
                $identificacion=$_POST['identificacion'];
                $nombre=$_POST['nombre'];
                $apellidos=$_POST['apellidos'];
                $cargo=$_POST['cargo'];   
                $mensaje='';
                if ($this->model->insert(['identificacion'=>$identificacion,'nombre'=>$nombre,'apellidos'=>$apellidos,'cargo'=>$cargo])){
                        $mensaje='Nueva Persona Creada';
                }else{
                        $mensaje='Ya existe el registro';
                }
                $this->view->mensaje=$mensaje;
                $this->render();
        }
}
?>