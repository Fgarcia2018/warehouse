<?php require 'views/header.php';?>
   <div id="main">
    <h1 class="center">Registro de material</h1>
    <div class="center" id='mensaje'></div>
    <form  id='form-nueva-entrada' method="POST" enctype="multipart/form-data">
        <P>
            <label for="num_entrada">No. Entrada :</label>
            <input type="text" name="num_entrada" id="num_entrada" readonly style='background:none; border:none;font-size: x-large;
                color: red;'>
        </P>
        <p>
            <fieldset>
                <legend> Tipo De Entrada: </legend>         
                <input type="radio"class="boton_radio" id="compra" name="tipo_entrada" value="compra">
                <label for="">Compra</label>
                <input type="radio" class="boton_radio"id="reintegro" name="tipo_entrada" value="reintegro">
                <label for="">Reintegro</label>
           </fieldset>
        </p>
        <P class="parrafo_proveedor ocultar">
            <label for="proveedor">Proveedor:</label>
            <datalist id="list_supplier" name="list_supplier"  for="list_supplier"  >
                <option value="sup-1" label="ELEMENTOS ELÉCTRICOS"></option>
                <option value="sup-2" label="ELÉCTRICOS DEL VALLE"></option>
                <option value="sup-3" label="DON ELÉCTRICO"></option>
                <option value="sup-4" label="PROCABLES"></option>
                <option value="sup-5" label="CENTELSA"></option>                
            </datalist>           
            <input type="text" name="proveedor" id="proveedor" list="list_supplier" required>
        </P>   
        <div class="seccion_materiales ocultar">
        <p>
            <input type="button" id='btn-adicionar-material' value="Adicionar Material">
        </p>   
        <p>
            <table class="tablas">
                <thead class='encabezados ocultar'>
                    <tr>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Unidad</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
            </table>  
            <p class="parrafo_trabajador ocultar">
           <label for="trabajador">Reintegrado Por:</label>
            <datalist id="list_employee" name="list_employee"  for="list_employee"  >               
            </datalist>
            <input type="text" name="id_trabajador_reintegro" id="trabajador" list="list_employee" required>
           </p>
        <P>
            <label for="idresponsable">Recibe:</label><br>
            <input type="text" name="idresponsable" id="responsable" required>
        </P> 
        <p>
            <input type="button" value="Registrar" id='boton_registrar' onclick="enviarDatos()"> 
            <input type="button" value="Generar PDF" onclick="generarPdf()">                       
        </p>  
        </div>
    </form>
   </div>
   <?php require 'views/footer.php'?>  
   <script src='public/js/jspdf.min.js'></script>
    <script src='public/js/main.js'></script> 
</body>
</html>