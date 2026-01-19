<?php
class DocsModel extends Model{
    function __construct(){
        parent::__construct();        
    }   
    public function updateEntrada($item){
        $query=$this->db->connect()->prepare("UPDATE tb_entradas_material_responsable SET DOCUMENTO_ENTRADA=:documento WHERE NUM_ENTRADA=:no_entrada"); 
        try{
            $query->execute(['no_entrada'=>$item['num_documento'],'documento'=>$item['documento']]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
    public function updateSalida($item){
        $query=$this->db->connect()->prepare("UPDATE tb_salidas_material_responsable SET DOCUMENTO_SALIDA=:documento WHERE NUM_SALIDA=:no_salida"); 
        try{
            $query->execute(['no_salida'=>$item['num_documento'],'documento'=>$item['documento']]);
            return true;
        }catch(PDOException $e){
            return false;
        }
    }
}
?>  