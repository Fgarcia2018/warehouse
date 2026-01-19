<?php
class ApiPersonal extends Controller{
    function __construct(){
        parent::__construct();   
    
    }
    function render(){        
            $this->view->render('apiPersonal/index');
    }  
    
}