<?php
class ConsultaSalida extends Controller{
        function __construct(){
        parent::__construct();  
        }
        function render(){                
                $this->view->render('consultaSalidas/index');
        }
}
?>