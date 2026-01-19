<?php
class Consulta extends Controller{
        function __construct(){
        parent::__construct();  
        }
        function render(){
                $material=$this->model->get();
                $this->view->material=$material;
                $this->view->render('consulta/index');
        }
         function getApiArticulos(){
                $articulos=$this->model->get_articulos();
               return $articulos;
        }
        function getApiMateriales(){
                $material=$this->model->getMateriales();
               return $material;
        }
        function getApiPersonal(){
                $persona=$this->model->getPersonal();
               return $persona;
        }
        function getApiMaterialById($id){
                $material=$this->model->getMaterialById($id);
               return $material;
        }
        function getIdEntrada(){
                $numEntrada=$this->model->getEntradaById();
               return $numEntrada;
        }
        function getIdSalida(){
                $numSalida=$this->model->getSalidaById();
               return $numSalida;
        }
        function getApiEntradas($agrupada){
                $entrada=$this->model->getEntradas($agrupada);
               return $entrada;
        }
        function getApiSalidas($agrupada){
                $salida=$this->model->getSalidas($agrupada);
               return $salida;
        }
        function verPersona($param=null){
                $idPersona=$param[0];
                $persona=$this->model->getById($idPersona);
                session_start();
                $_SESSION['id_verPersona']=$persona->identificacion;
                $this->view->persona=$persona;
                $this->view->mensaje="";
                $this->view->render('consulta/detalle');
        }
        function actualizarPersona(){
                session_start();
                $identificacion=$_SESSION['id_verPersona'];
                $nombre=$_POST['nombre'];
                $apellidos=$_POST['apellidos'];
                $cargo=$_POST['cargo'];
                unset($_SESSION['id_verPersona']);
                if ($this->model->update(['identificacion'=>$identificacion,'nombre'=>$nombre,'apellidos'=>$apellidos,'cargo'=>$cargo])){
                        $persona=new Persona();
                        $persona->identificacion=$identificacion;
                        $persona->nombre=$nombre;
                        $persona->apellidos=$apellidos;
                        $persona->cargo=$cargo;
                        $this->view->persona=$persona;
                        $this->view->mensaje='Persona Actualizada';
                }else{
                        $this->view->mensaje='No se pudieron actualizar los datos';
                }
                $this->view->render('consulta/detalle');
        }
        function eliminarPersona($param=null){
                $identificacion=$param[0];
                if ($this->model->delete($identificacion)){
                        $this->view->mensaje='Persona Eliminada';
                }else{
                        $this->view->mensaje='No se pudo eliminar';
                }
                $this->render();
        }
        function validarUsuario($login,$pass){
                $registro=$this->model->get_usuario($login,$pass);  
                // Si el usuarop se encuentra en la base de datos, se inicia sesion y se asignan los valores a variables de session, si no se redirige a la 
                // página del index.
                if($registro!=0){                     
                        $matriz_persona=$this->model->get_persona($pass);       
                                session_start();                    
                                foreach ($matriz_persona as $persona){
                                $_SESSION['usuario']=$persona['NOMBRE']." ".$persona['APELLIDOS'];
                                }
                                // Se valida el envío de cabeceras, ya que con algunos servicios de hosting se genera conflicto si se genera conflicto se realiza el redireccionamiento por medio de codigo javascript.                                
                                if(!(headers_sent())){
                                        header("location:".constant('URL')."main");
                                        die();
                                }else{
                                echo'<script type="text/javascript">window.location.href="'.constant('URL').'main";</script>';
                                }                                
                                
                }else{                   
                        $mensaje='Acceso Denegado. Nombre de usuario o contraseña incorrectos.';
                        if(!(headers_sent())){
                        header("location:".constant('URL')."login?mensaje=".$mensaje);  
                        }else{
                         echo'<script type="text/javascript">window.location.href="'.constant('URL').'login?mensaje='.$mensaje.'";</script>'; 
                        }
                }
        }
}
