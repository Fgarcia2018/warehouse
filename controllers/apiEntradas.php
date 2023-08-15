<?php
class ApiEntradas extends Controller{
    function __construct(){
        parent::__construct();  
    }
    function render(){        
            $this->view->render('apiEntradasMaterial/index');
    }
    function agrupada($dato){        
        $this->view->render('apiEntradasMaterial/index');
    }
   
}