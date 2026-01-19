<?php
// Cabeceras para permitir las peticiones desde el dominio en github y evitar bloqueos de politica CORS (Intercambio de Recursos de Origen Cruzado)
header("Access-Control-Allow-Origin: https://fgarcia2018.github.io");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");



/*define('URL','https://warehouseproject.wuaze.com/');
define('HOST','sql300.infinityfree.com');
// define('PORT','3308');
define('DB','if0_39395807_warehouse');
define('USER','if0_39395807');
define('PASSWORD','C4dr0fyBcB');
define('CHARSET','utf8mb4');*/



class conexion{
    public static function conectar() {
        try{
            $conexion=new PDO("mysql:host=sql300.infinityfree.com;dbname=if0_39395807_warehouse",'if0_39395807','C4dr0fyBcB');
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES,FALSE);
            $conexion->exec("set character set utf8");
        }catch(Exception $e){
            die("error ".$e->getMessage());
            echo "linea del error ".$e->getLine();
        }
        return $conexion;
    }
}

    class articulo{
        private $db;
        private $articulo;
        public function __construct(){
            //se guarda en la propiedad db se llama al metodo est�tico conectar(), de la clase conexion
            $this->db=Conexion::conectar();            
            //se indica que articulo ser� un array
            $this->articulo=array(); 
        }
       
        // metodo que genera lista de articulos ordenados alfabéticamente.
        public function get_articulo(){
            $listaArticulos=array();
            // $listaArticulos["items"]=array();
            $consulta=$this->db->query("SELECT * from TB_ARTICULOS order by DESCRIPCION asc");   
            while($fila=$consulta->fetch(PDO::FETCH_ASSOC)){                
                // $this->articulo[]=$fila; 
                $item=array(
                    'id'=>$fila['ID'],
                    'descripcion'=>$fila['DESCRIPCION'],
                    'unidad'=>$fila['UNIDAD'],
                    'categoria'=>$fila['CATEGORIA'],
                    'comprar'=>$fila['COMPRAR'],
                    'estado'=>$fila['ESTADO']
                );  
                array_push($listaArticulos,$item);
            }
           echo json_encode($listaArticulos);
        }
        // public  function delete_articulo($cod_articulo){            
        //     $consulta=$this->db->query("delete from tb_consumo_articulo where CODIGO_articulo=$cod_articulo"); 
        // }
        
        //metodo para guardar articulo consumido de acuerdo a la orden de trabajo 
        public function set_articulo($descripcion,$unidad,$categoria){                        
            
            $resultado=$this->db->prepare("insert into TB_ARTICULOS values (NULL,?,?,?,0,'Pendiente')");
            
            $resultado->bindvalue(1,$descripcion,PDO::PARAM_STR);
            $resultado->bindvalue(2,$unidad,PDO::PARAM_STR);
            $resultado->bindvalue(3,$categoria,PDO::PARAM_INT);           
            $resultado->execute();                        
            $resultado->closeCursor();         
            echo json_encode('¡Registro insertado!');
        }
        
        // // metodo para editar el articulo consumido de acuerdo a la orden trabajo
        // public function edit_articulo($orden_trab,$cod_articulo,$unidad_articulo,$observacion,$cantidad){
        //     $resultado=$this->db->prepare("update tb_consumo_articulo set CODIGO_articulo=:codmat,UNIDAD_articulo=:un_articulo,OBSERVACION=:obs,CANTIDAD_CONSUMO=:can_consumo
        //                                     where CODIGO_articulo=:cod_mat and NO_ORDEN_TRABAJO=:ot");
        //     $resultado->bindparam(':codmat',$cod_articulo,PDO::PARAM_INT);
        //     $resultado->bindparam(':un_articulo',$unidad_articulo,PDO::PARAM_STR);
        //     $resultado->bindparam(':obs',$observacion,PDO::PARAM_STR);
        //     $resultado->bindparam(':can_consumo',$cantidad,PDO::PARAM_INT);
        //     $resultado->bindparam(':cod_mat',$cod_articulo,PDO::PARAM_INT);
        //     $resultado->bindparam(':ot',$orden_trab,PDO::PARAM_STR);
        //     $resultado->execute();
        //     echo"Registro Modificado";
        //     $resultado->closeCursor();
        // }  
    }  
      
?><?php
// Cabeceras para permitir las peticiones desde el dominio en github y evitar bloqueos de politica CORS (Intercambio de Recursos de Origen Cruzado)
header("Access-Control-Allow-Origin: https://fgarcia2018.github.io");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

class conexion{
    public static function conectar() {
        try{
            $conexion=new PDO("mysql:host=localhost;dbname=id21007044_mercadoapp",'id21007044_mercadoappuser','Mercadoapp_user2023');
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES,FALSE);
            $conexion->exec("set character set utf8");
        }catch(Exception $e){
            die("error ".$e->getMessage());
            echo "linea del error ".$e->getLine();
        }
        return $conexion;
    }
}

    class articulo{
        private $db;
        private $articulo;
        public function __construct(){
            //se guarda en la propiedad db se llama al metodo est�tico conectar(), de la clase conexion
            $this->db=Conexion::conectar();            
            //se indica que articulo ser� un array
            $this->articulo=array(); 
        }
       
        // metodo que genera lista de articulos ordenados alfabéticamente.
        public function get_articulo(){
            $listaArticulos=array();
            // $listaArticulos["items"]=array();
            $consulta=$this->db->query("SELECT * from TB_ARTICULOS order by DESCRIPCION asc");   
            while($fila=$consulta->fetch(PDO::FETCH_ASSOC)){                
                // $this->articulo[]=$fila; 
                $item=array(
                    'id'=>$fila['ID'],
                    'descripcion'=>$fila['DESCRIPCION'],
                    'unidad'=>$fila['UNIDAD'],
                    'categoria'=>$fila['CATEGORIA'],
                    'comprar'=>$fila['COMPRAR'],
                    'estado'=>$fila['ESTADO']
                );  
                array_push($listaArticulos,$item);
            }
           echo json_encode($listaArticulos);
        }
        // public  function delete_articulo($cod_articulo){            
        //     $consulta=$this->db->query("delete from tb_consumo_articulo where CODIGO_articulo=$cod_articulo"); 
        // }
        
        //metodo para guardar articulo consumido de acuerdo a la orden de trabajo 
        public function set_articulo($descripcion,$unidad,$categoria){                        
            
            $resultado=$this->db->prepare("insert into TB_ARTICULOS values (NULL,?,?,?,0,'Pendiente')");
            
            $resultado->bindvalue(1,$descripcion,PDO::PARAM_STR);
            $resultado->bindvalue(2,$unidad,PDO::PARAM_STR);
            $resultado->bindvalue(3,$categoria,PDO::PARAM_INT);           
            $resultado->execute();                        
            $resultado->closeCursor();         
            echo json_encode('¡Registro insertado!');
        }
        
        // // metodo para editar el articulo consumido de acuerdo a la orden trabajo
        // public function edit_articulo($orden_trab,$cod_articulo,$unidad_articulo,$observacion,$cantidad){
        //     $resultado=$this->db->prepare("update tb_consumo_articulo set CODIGO_articulo=:codmat,UNIDAD_articulo=:un_articulo,OBSERVACION=:obs,CANTIDAD_CONSUMO=:can_consumo
        //                                     where CODIGO_articulo=:cod_mat and NO_ORDEN_TRABAJO=:ot");
        //     $resultado->bindparam(':codmat',$cod_articulo,PDO::PARAM_INT);
        //     $resultado->bindparam(':un_articulo',$unidad_articulo,PDO::PARAM_STR);
        //     $resultado->bindparam(':obs',$observacion,PDO::PARAM_STR);
        //     $resultado->bindparam(':can_consumo',$cantidad,PDO::PARAM_INT);
        //     $resultado->bindparam(':cod_mat',$cod_articulo,PDO::PARAM_INT);
        //     $resultado->bindparam(':ot',$orden_trab,PDO::PARAM_STR);
        //     $resultado->execute();
        //     echo"Registro Modificado";
        //     $resultado->closeCursor();
        // }  
    }  
      
?>