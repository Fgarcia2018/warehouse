<?php
class OutMatModel extends Model{
    function __construct(){
        parent::__construct();        
    }   
    public function insertMaterial($datos){
        // Se inserta nuevo registro de material y se actualiza el inventario. Se creo un trigger en la BD para realizar esta actualización automatica, pero el servicio de hosting gratuito habilita permiso para realizarlo, entonces se realiza por medio de esta funcion.
        try{
            $query=$this->db->connect()->prepare("INSERT INTO tb_salidas_material (NO_SALIDA,ID_MATERIAL,CANTIDAD_SALIDA,ID_RESPONSABLE,ID_ALMACENISTA) VALUES (:num_salida,:codigo,:cantidad,:idresponsable,:idalmacenista)");       
            $query->execute(['num_salida'=>$datos['num_salida'],'codigo'=>$datos['codigo'],'cantidad'=>$datos['cantidad'],'idresponsable'=>$datos['idresponsable'],'idalmacenista'=>$datos['idalmacenista']]);
            $query->closeCursor();   

            $query2=$this->db->connect()->prepare("UPDATE tb_material JOIN tb_salidas_material on tb_material.CODIGO_MATERIAL=tb_salidas_material.ID_MATERIAL set tb_material.SALIDA_MATERIAL=(select sum(cantidad_salida)from tb_salidas_material where tb_material.CODIGO_MATERIAL=tb_salidas_material.ID_MATERIAL)");       
            $query2->execute();
            $query2->closeCursor();   

            return true;
        }catch(Exception $e){     
            return false;
        }
    }
}
?>  