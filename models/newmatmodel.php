<?php
class NewMatModel extends Model{
    function __construct(){
        parent::__construct();        
    }   
    public function insertMaterial($datos){
        // Se inserta nuevo registro de material y se actualiza el inventario. Se creo un trigger en la BD para realizar esta actualización automatica, pero el servicio de hosting gratuito habilita permiso para realizarlo, entonces se realiza por medio de esta funcion.
        try{    
            $query=$this->db->connect()->prepare("INSERT INTO tb_entradas_material (NO_ENTRADA,TIPO_ENTRADA,PROVEEDOR,ID_MATERIAL,CANTIDAD_ENTRADA,ID_TRABAJADOR_REINTEGRO,ID_TRABAJADOR_RECIBE) VALUES (:num_entrada,:tipo_entrada,:proveedor,:codigo,:cantidad,:id_trabajador_reintegro,:idresponsable)");       
            $query->execute(['num_entrada'=>$datos['num_entrada'],'tipo_entrada'=>$datos['tipo_entrada'],'proveedor'=>$datos['proveedor'],'codigo'=>$datos['codigo'],'cantidad'=>$datos['cantidad'],'id_trabajador_reintegro'=>$datos['id_trabajador_reintegro'],'idresponsable'=>$datos['idresponsable']]);
            $query->closeCursor();   

            $query2=$this->db->connect()->prepare("UPDATE tb_material join tb_entradas_material on tb_material.CODIGO_MATERIAL=tb_entradas_material.ID_MATERIAL set tb_material.ENTRADA_MATERIAl=(SELECT sum(cantidad_entrada)from tb_entradas_material where tb_material.CODIGO_MATERIAL=tb_entradas_material.ID_MATERIAL)");  

            $query2->execute();
            $query2->closeCursor();   
            
            return true;
        }catch(Exception $e){     
            return false;
        }
    }
}
?>  