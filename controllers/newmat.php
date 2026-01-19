<?php
class NewMat extends Controller{
        function __construct(){
                parent::__construct();   
                $this->view->mensaje='';    
        }
        function render(){
                $this->view->render('newMat/index');
        }
        function registrarMaterial(){ 
                // Se recibe la data enviada por POST
                $datos=array_values($_POST);               
                $materiales=[];

                // los datos necesarios para realizar la inserción multiple se almacenan en un nuevo array
                for ($i=3;$i<sizeof($datos)-2;$i++){
                array_push($materiales,$datos[$i]);
                } 
               
                $numEntrada=$_POST['num_entrada'];
                $tipoEntrada=$_POST['tipo_entrada'];
                $proveedor=$_POST['proveedor'];
                $idTrabajadorReintegro=$_POST['id_trabajador_reintegro'];
                $idresponsable=$_POST['idresponsable']; 
                $mensaje='';  
               
                // Se realiza la inserción multiple de acuerdo a la cantidad de materiales seleccionados por el usuario
                for($i=0;$i<sizeof($materiales);$i++){ 
                        // primer elemento del array corresponde al codigo el material, segundo elemento la cantidad 
                        $codigo=$materiales[$i];                   
                        $cantidad=$materiales[$i+1];
                        if($this->model->insertMaterial(['num_entrada'=>$numEntrada,'tipo_entrada'=>$tipoEntrada,'proveedor'=>$proveedor,'codigo'=>$codigo,'cantidad'=>$cantidad,'id_trabajador_reintegro'=>$idTrabajadorReintegro,'idresponsable'=>$idresponsable])){
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