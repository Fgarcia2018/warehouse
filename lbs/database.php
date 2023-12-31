<?php
class Database{
    private $host;
    // la propiedad $port no es necesaria para el despliegue en infinityfree, pero si para el despliegue local con wamp
    // private $port;  
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct(){
        $this->host=constant('HOST');
        // $this->port=constant('PORT');
        $this->db=constant('DB');
        $this->user=constant('USER');
        $this->password=constant('PASSWORD');
        $this->charset=constant('CHARSET');
    }
    public function connect(){
        try{
            $connection="mysql:host=".$this->host.";dbname=".$this->db.";charset=".$this->charset;
            $options=[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_EMULATE_PREPARES=>false,];
            $pdo=new PDO($connection,$this->user,$this->password,$options); 
            return $pdo;
        }catch(Exception $e){
            die("error ".$e->getMessage());
            echo "linea del error ".$e->getLine();
        }      
    }
}
?>