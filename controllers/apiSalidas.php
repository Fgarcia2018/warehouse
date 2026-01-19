<?php
class ApiSalidas extends Controller{
    function __construct(){
        parent::__construct();  
    }
    function render(){        
            $this->view->render('apiSalidasMaterial/index');
    }
    function agrupada($dato){        
        $this->view->render('apiSalidasMaterial/index');
    }
}