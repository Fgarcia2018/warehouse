<?php
class NuevoModel extends Model{
    function __construct(){
        parent::__construct();        
    }
    public function insert($datos){
        try{
            $query=$this->db->connect()->prepare("INSERT INTO tbpersonas (IDENTIFICACION,NOMBRE,APELLIDOS,CARGO) VALUES (:identificacion,:nombre,:apellidos,:cargo)");       
            $query->execute(['identificacion'=>$datos['identificacion'],'nombre'=>$datos['nombre'],'apellidos'=>$datos['apellidos'],'cargo'=>$datos['cargo']]);
            $query->closeCursor();          
            return true;
        }catch(Exception $e){     
            return false;
        }
    }
   
}
?>  