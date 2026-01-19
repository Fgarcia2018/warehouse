<?php
class ConsultaInformes extends Controller{
        function __construct(){
        parent::__construct();  
        }
        function render(){                
                $this->view->render('consultaInformes/index');
        }
}
?>