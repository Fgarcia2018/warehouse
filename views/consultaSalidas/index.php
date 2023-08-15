<?php require 'views/header.php'?>
<div id="main">
    <h1 class="center">Consulta Salidas De Material</h1>
    <p> 
        <fieldset id='tipo_consulta'>
            <legend>Generar reporte por: </legend>    
            <input type="radio"class="boton_radio" id="salida" name="tipo_consulta" value="salida">
            <label for="">Num. Salida</label>          
            <input type="radio" class="boton_radio"id="fecha" name="tipo_consulta" value="fecha">
            <label for="">Fecha</label>
            <input type="radio" class="boton_radio"id="documento" name="tipo_consulta" value="documento">
            <label for="">Documento</label>
        </fieldset>
    </p>
    <form  id='form-consulta-salida' method="POST" enctype="multipart/form-data">        
        <P class="parrafo_datalist_num_salida ocultar">
            <label for="num_salida">Seleccione Num. salida:</label>
            <datalist id="lista_num_salida" name="lista_num_salida"  for="lista_num_salida"  >           
            </datalist>           
            <input type="text" name="num_salida" id="num_salida" list="lista_num_salida" required>
        </P> 
        <P class="parrafo_fecha_salida ocultar">
        <label for="Fecha">
            <span>Seleccione un fecha</span>
            <input type="date" id="fecha_salida" name="fecha_salida">
        </label>
        </P>  
        <P class="parrafo_datalist_documento ocultar">
            <label for="num_documento">Seleccione Num. documento:</label>
            <datalist id="lista_num_documento" name="lista_num_documento"  for="lista_num_documento"  >           
            </datalist>           
            <input type="text" name="num_documento" id="num_documento" list="lista_num_documento" required>
        </P>          
    </form>
    <section class="resultado_consulta ocultar">
        <table width="100%" >
        <caption class='tabla_titulo ocultar'></caption>      
            <thead class='tabla_consulta_encabezados'>
                <tr>
                    <th>FECHA</th>
                    <th class='n_salida ocultar'>NO. SALIDA</th>
                    <th class='enc_codigo ocultar'>CODIGO</th>
                    <th class='enc_descripcion ocultar'>DESCRIPCION</th>
                    <th class='enc_unidad ocultar'>UNIDAD</th>                   
                    <th class='enc_cantidad ocultar'>CANTIDAD SALIDA</th>  
                    <th class='enc_id_trabajador'>ID TRABAJADOR ASIGNADO</th>
                    <th class='enc_nom_trabajador'>NOMBRE TRABAJADOR ASIGNADO</th>
                    <th>ALMACENISTA</th> 
                    <th class='n_documento ocultar'>DOCUMENTO</th>                 
                </tr>
            </thead>
            <tbody class="tabla_body_salida"> 
            </tbody>
        </table>
    </section> 
</div>
   <?php require 'views/footer.php'?>
   <script src="public/js/consultaSalida.js"></script>
</body>
</html>