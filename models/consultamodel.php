<?php

include_once('models/material.php');
class ConsultaModel extends Model{
    function __construct(){
        parent::__construct();        
    }
    public function get(){
        $items=[];
        try{
            $query=$this->db->connect()->query("SELECT * FROM tb_material");   
            while($row=$query->fetch(PDO::FETCH_ASSOC)){ 
                $item=new Material();
                $item->codigoMaterial=$row['CODIGO_MATERIAL'];   
                $item->descripcionMaterial=$row['DESCRIPCION_MATERIAL'];   
                $item->unidadMaterial=$row['UNIDAD_MATERIAL'];   
                $item->entradaMaterial=$row['ENTRADA_MATERIAL'];   
                $item->salidaMaterial=$row['SALIDA_MATERIAL']; 
                $item->stockMaterial=$row['STOCK_MATERIAL'];                  
                array_push($items,$item);
            }
            return $items;
        }catch(PDOEXCEPCTION $e){
            return[];
        }
    }
    public function getById($id){
        $item=new Persona();
        $query=$this->db->connect()->prepare("SELECT * FROM tbpersonas WHERE IDENTIFICACION=:identificacion"); 
        try{
            $query->execute(['identificacion'=>$id]);
            while($row=$query->fetch(PDO::FETCH_ASSOC)){   
                $item->identificacion=$row['IDENTIFICACION'];   
                $item->nombre=$row['NOMBRE'];   
                $item->apellidos=$row['APELLIDOS'];   
                $item->cargo=$row['CARGO'];                
            }
            $query->closeCursor();   
            return $item;
        }catch(PDOExeption $e){
            return null;
        }
    }
    public function update($item){
        $query=$this->db->connect()->prepare("UPDATE tbpersonas SET NOMBRE=:nombre,APELLIDOS=:apellidos,CARGO=:cargo WHERE IDENTIFICACION=:identificacion"); 
        try{
            $query->execute(['identificacion'=>$item['identificacion'],'nombre'=>$item['nombre'],'apellidos'=>$item['apellidos'],'cargo'=>$item['cargo']]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    
    public function delete($id){
        $query=$this->db->connect()->prepare("DELETE FROM tbpersonas WHERE IDENTIFICACION=:identificacion"); 
        try{
            $query->execute(['identificacion'=>$id]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function getMateriales(){
        // Se obtiene listado de todos los materiales ordenados alfabeticamente por la descripcion
        $items=array();
            $query=$this->db->connect()->query("SELECT * FROM tb_material ORDER BY DESCRIPCION_MATERIAL ASC");   
            while($row=$query->fetch(PDO::FETCH_ASSOC)){  
                $item=array(
                    'id'=>$row['CODIGO_MATERIAL'],
                    'descripcion'=>$row['DESCRIPCION_MATERIAL'],
                    'unidad'=>$row['UNIDAD_MATERIAL'],
                    'entrada_material'=>$row['ENTRADA_MATERIAL'],
                    'salida_material'=>$row['SALIDA_MATERIAL'],
                    'stock'=>$row['STOCK_MATERIAL']
                );  
                array_push($items,$item);
            }
        echo json_encode($items);
    }  
        public function get_articulos(){
            $listaArticulos=array();
            // $listaArticulos["items"]=array();
            $consulta=$this->db->connect()->query("SELECT * from TB_ARTICULOS order by DESCRIPCION asc");   
            while($fila=$consulta->fetch(PDO::FETCH_ASSOC)){                
                // $this->articulo[]=$fila; 
                $item=array(
                    'id'=>$fila['ID'],
                    'descripcion'=>$fila['DESCRIPCION'],
                    'unidad'=>$fila['UNIDAD'],
                    'categoria'=>$fila['CATEGORIA'],
                    'comprar'=>$fila['COMPRAR'],
                    'estado'=>$fila['ESTADO'],
                    'creado_en'=>$fila['created_at'],
                    'actualizado_en'=>$fila['updated_at']
                );  
                array_push($listaArticulos,$item);
            }
           echo json_encode($listaArticulos);
        }
    public function getPersonal(){
        // Se obtienen identificacion, nombre y apellidos del personal operativo.
        $items=array();
            $query=$this->db->connect()->query("SELECT IDENTIFICACION,CONCAT(NOMBRE,' ',APELLIDOS) AS NOMBRE FROM tb_personal_cali WHERE AREA='OPERATIVO' ORDER BY NOMBRE ASC");   
            while($row=$query->fetch(PDO::FETCH_ASSOC)){                
                
                $item=array(
                    'id'=>$row['IDENTIFICACION'],
                    'nombre'=>$row['NOMBRE'],                        
                );  
                array_push($items,$item);
            }
            echo json_encode($items);
    }      
    public function getMaterialById($id){
        // Se obtiene material buscando por codigo
        $items=array();
            $query=$this->db->connect()->query("SELECT * FROM tb_material WHERE CODIGO_MATERIAL=$id");   
            while($row=$query->fetch(PDO::FETCH_ASSOC)){  
                $item=array(
                    'id'=>$row['CODIGO_MATERIAL'],
                    'descripcion'=>$row['DESCRIPCION_MATERIAL'],
                    'unidad'=>$row['UNIDAD_MATERIAL'],
                    'entrada_material'=>$row['ENTRADA_MATERIAL'],
                    'salida_material'=>$row['SALIDA_MATERIAL'],
                    'stock'=>$row['STOCK_MATERIAL']
                );  
                array_push($items,$item);
            }
            echo json_encode($items);
    }    
    public function getEntradaById(){ 
            // se verifica la cantidad de registros existentes y de acuerdo al resultado se genera un nuevo consecutivo
            // y se inserta en la tabla tb_entradas_material_responsable
            $query=$this->db->connect()->prepare("SELECT * FROM tb_entradas_material_responsable");                     
            $query->execute();
            $numEntradas=$query->rowCount();
            $nuevoNumEntrada='EN-'.strval($numEntradas+1);
            $query=$this->db->connect()->prepare("INSERT INTO tb_entradas_material_responsable (NUM_ENTRADA,ID_RESPONSABLE) VALUES (:num_entrada,NULL)");       
            $query->execute(['num_entrada'=>$nuevoNumEntrada]);
            echo json_encode($nuevoNumEntrada);              
    }  
    public function getSalidaById(){ 
        // se verifica la cantidad de registros existentes y de acuerdo al resultado se genera un nuevo consecutivo
        // y se inserta en la tabla tb_Salidas_material_responsable
        $query=$this->db->connect()->prepare("SELECT * FROM tb_salidas_material_responsable");                     
        $query->execute();
        $numSalidas=$query->rowCount();
        $nuevoNumSalida='SA-'.strval($numSalidas+1);
        $query=$this->db->connect()->prepare("INSERT INTO tb_salidas_material_responsable (NUM_SALIDA,ID_RESPONSABLE) VALUES (:num_salida,NULL)");       
        $query->execute(['num_salida'=>$nuevoNumSalida]);
        echo json_encode($nuevoNumSalida);              
    }  
    public function getEntradas($agrupadas){
        // Se obtienen numeros de entrada agrupadas o no agrupadas por el numero
        $items=array();
        if($agrupadas==='true'){
            $query=$this->db->connect()->query("SELECT tb_entradas_material.*,tb_entradas_material_responsable.DOCUMENTO_ENTRADA from tb_entradas_material,tb_entradas_material_responsable WHERE tb_entradas_material.NO_ENTRADA=tb_entradas_material_responsable.NUM_ENTRADA GROUP BY tb_entradas_material.NO_ENTRADA");   
            while($row=$query->fetch(PDO::FETCH_ASSOC)){  
                $item=array(
                    'fecha_entrada'=>$row['FECHA_ENTRADA'],
                    'no_entrada'=>$row['NO_ENTRADA'],
                    'tipo_entrada'=>$row['TIPO_ENTRADA'],
                    'proveedor'=>$row['PROVEEDOR'],
                    'id_material'=>$row['ID_MATERIAL'],                       
                    'cantidad_entrada'=>$row['CANTIDAD_ENTRADA'],
                    'id_trabajador_reintegro'=>$row['ID_TRABAJADOR_REINTEGRO'],
                    'id_trabajador_recibe'=>$row['ID_TRABAJADOR_RECIBE'],
                    'documento'=>$row['DOCUMENTO_ENTRADA']
                );  
                array_push($items,$item);
            }
        }else{
            $query=$this->db->connect()->query("SELECT tb_material.DESCRIPCION_MATERIAL,tb_material.UNIDAD_MATERIAL,tb_entradas_material.* from tb_material,tb_entradas_material WHERE tb_material.CODIGO_MATERIAL=tb_entradas_material.ID_MATERIAL"); 
            while($row=$query->fetch(PDO::FETCH_ASSOC)){  
                $item=array(
                    'fecha_entrada'=>$row['FECHA_ENTRADA'],
                    'no_entrada'=>$row['NO_ENTRADA'],
                    'tipo_entrada'=>$row['TIPO_ENTRADA'],
                    'proveedor'=>$row['PROVEEDOR'],
                    'id_material'=>$row['ID_MATERIAL'],
                    'descripcion_material'=>$row['DESCRIPCION_MATERIAL'],
                    'unidad_material'=>$row['UNIDAD_MATERIAL'],
                    'cantidad_entrada'=>$row['CANTIDAD_ENTRADA'],
                    'id_trabajador_reintegro'=>$row['ID_TRABAJADOR_REINTEGRO'],                    
                    'id_trabajador_recibe'=>$row['ID_TRABAJADOR_RECIBE']
                );  
                array_push($items,$item);
            }
        }   
            echo json_encode($items);
    } 
    public function getSalidas($agrupadas){
        // Se obtienen numeros de salidas agrupadas o no agrupadas por el numero
        $items=array();

        if($agrupadas==='true'){
            $query=$this->db->connect()->query("SELECT tb_salidas_material.*,tb_salidas_material_responsable.DOCUMENTO_SALIDA from tb_salidas_material,tb_salidas_material_responsable WHERE tb_salidas_material.NO_SALIDA=tb_salidas_material_responsable.NUM_SALIDA GROUP BY tb_salidas_material.NO_SALIDA");   
            while($row=$query->fetch(PDO::FETCH_ASSOC)){  
                $item=array(
                    'fecha_salida'=>$row['FECHA_SALIDA'],
                    'no_salida'=>$row['NO_SALIDA'], 
                    'id_material'=>$row['ID_MATERIAL'],                       
                    'cantidad_salida'=>$row['CANTIDAD_SALIDA'],
                    'id_trabajador_responsable'=>$row['ID_RESPONSABLE'],
                    'id_almacenista'=>$row['ID_ALMACENISTA'],
                    'documento'=>$row['DOCUMENTO_SALIDA']
                );  
                array_push($items,$item);
            }
        }else{
            $query=$this->db->connect()->query("SELECT tb_material.DESCRIPCION_MATERIAL,tb_material.UNIDAD_MATERIAL,tb_salidas_material.*,concat(tb_personal_cali.NOMBRE,' ',tb_personal_cali.APELLIDOS)as NOMBRE_RESPONSABLE from tb_material,tb_salidas_material,tb_personal_cali WHERE tb_material.CODIGO_MATERIAL=tb_salidas_material.ID_MATERIAL and tb_personal_cali.IDENTIFICACION=tb_salidas_material.ID_RESPONSABLE"); 
            while($row=$query->fetch(PDO::FETCH_ASSOC)){  
                $item=array(
                    'fecha_salida'=>$row['FECHA_SALIDA'],
                    'no_salida'=>$row['NO_SALIDA'],                                         
                    'id_material'=>$row['ID_MATERIAL'],
                    'descripcion_material'=>$row['DESCRIPCION_MATERIAL'],
                    'unidad_material'=>$row['UNIDAD_MATERIAL'],
                    'cantidad_salida'=>$row['CANTIDAD_SALIDA'],
                    'id_trabajador_responsable'=>$row['ID_RESPONSABLE'],
                    'nombre_responsable'=>$row['NOMBRE_RESPONSABLE'],
                    'id_almacenista'=>$row['ID_ALMACENISTA'],
                );  
                array_push($items,$item);
            }
        }   
            echo json_encode($items);
    } 
    public function get_usuario($usuario,$clave){
        // Se valida si la persona que está realizando el logueo tiene usuario creado
        //se prepara la consulta
        $resultado=$this->db->connect()->prepare("select * from tb_personal_cali where USUARIO=:login and PASS=:password");       
        //bindvalue, para asociar los marcadores a los valores enviados desde la pagina del formulario
        $resultado->bindValue(":login",$usuario);
        $resultado->bindValue(":password",$clave);
        //se ejecuta la senetencia sql
        $resultado->execute();
        //Cantidad de registros que encuentran con la consulta
        $num_registros= $resultado->rowCount();
        return $num_registros;        
    }
    public  function get_persona($clave){ 
        $resultado=$this->db->connect()->prepare("select * from tb_personal_cali where PASS=:password");        
        $resultado->bindValue(":password",$clave,PDO::PARAM_STR);
        $resultado->execute();
        while($fila=$resultado->fetch(PDO::FETCH_ASSOC)){
            //el resultado (recordeset) se guarda en el array asociativo
            $this->usuario[]=$fila;            
        }        
        return $this->usuario;        
    }
}
?>  