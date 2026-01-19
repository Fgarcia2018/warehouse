<?php


class ApiMaterial extends Controller{

    function __construct(){
        parent::__construct();   
    
    }
    function render(){   
          
            $this->view->render('apiMaterial/index');
    }
    // API para consultar material por ID de material
    function id($id){        
        $this->view->render('apiMaterial/index');
    }
    // API para verificar numeros de entrada y generar un nuevo consecutivo
    function num_entrada(){        
        $this->view->render('apiMaterial/index');
    }
     // API para verificar numeros de salida y generar un nuevo consecutivo
    function num_salida(){        
        $this->view->render('apiMaterial/index');
    }
}
