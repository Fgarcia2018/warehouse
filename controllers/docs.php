<?php
class Docs extends Controller{
        function __construct(){
        parent::__construct();  
        }
        function render(){                
                $this->view->render('docs/index');
        }
        function subirDocumento(){
                $num_documento=$_POST['num_documento'];
                $directorio="public/uploads/";
                $archivo=$directorio . basename($_FILES["archivo"]["name"]);
                $tipoArchivo=strtolower(pathinfo($archivo,PATHINFO_EXTENSION));
                $sizeArchivo=filesize($_FILES['archivo']['tmp_name']);
                if($tipoArchivo=='pdf'){
                        if(move_uploaded_file($_FILES['archivo']['tmp_name'],$archivo)){   
                                if(substr($_POST['num_documento'],0,2)==='EN'){
                                        $this->model->updateEntrada(['num_documento'=>$num_documento,'documento'=>$archivo]);
                                }else {
                                        $this->model->updateSalida(['num_documento'=>$num_documento,'documento'=>$archivo]);
                                }
                                echo json_encode('Archivo guardado');
                        }                
                 }else{
                        echo json_encode('el archivo debe ser en formato PDF');
                }
        }
}
?>