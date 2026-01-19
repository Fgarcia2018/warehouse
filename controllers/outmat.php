<?php
class OutMat extends Controller{
        function __construct(){
                parent::__construct();   
                $this->view->mensaje='';    
        }
        function render(){
                $this->view->render('outMat/index');
        }
        function registrarMaterial(){ 
                // Se recibe la data enviada por POST
                $datos=array_values($_POST);               
                $materiales=[];
                // los datos necesarios para realizar la inserción multiple se almacenan en un nuevo array
                for ($i=1;$i<sizeof($datos)-2;$i++){
                array_push($materiales,$datos[$i]);
                }               
                $numSalida=$_POST['num_salida'];   
                $idResponsable=$_POST['idresponsable']; 
                $idAlmacenista=$_POST['idalmacenista']; 
                $mensaje='';
                for($i=0;$i<sizeof($materiales);$i++){ 
                        // primer elemento del array corresponde al codigo el material, segundo elemento la cantidad 
                        $codigo=$materiales[$i];                   
                        $cantidad=$materiales[$i+1];    
                        if($this->model->insertMaterial(['num_salida'=>$numSalida,'codigo'=>$codigo,'cantidad'=>$cantidad,'idresponsable'=>$idResponsable,'idalmacenista'=>$idAlmacenista])){
                                $mensaje='Registro Exitoso';
                        }else{
                                $mensaje='Ya existe el registro';
                        }
                        //Se avanza al siguiente elemento, ya que la insercion se realiza de a dos indices  
                        $i++;    
                }    
                echo json_encode($mensaje);                            
                return;  
        }
}
?>