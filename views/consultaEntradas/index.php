    <?php require 'views/header.php'?>
<div id="main">
    <h1 class="center">Consulta Entradas De Material</h1>
    <p> 
        <fieldset id='tipo_consulta'>
            <legend>Generar reporte por: </legend>    
            <input type="radio"class="boton_radio" id="compra" name="tipo_consulta" value="compra">
            <label for="">Compra</label>
            <input type="radio"class="boton_radio" id="reintegro" name="tipo_consulta" value="reintegro">
            <label for="">Reintegro</label>
            <input type="radio" class="boton_radio"id="fecha" name="tipo_consulta" value="fecha">
            <label for="">Fecha</label>
            <input type="radio" class="boton_radio"id="documento" name="tipo_consulta" value="documento">
            <label for="">Documento</label>
        </fieldset>
    </p>
    <form  id='form-consulta-entrada' method="POST" enctype="multipart/fofechaenrm-data">        
        <P class="parrafo_datalist_num_entrada ocultar">
            <label for="num_entrada">Seleccione Num. Entrada:</label>
            <datalist id="lista_num_entrada" name="lista_num_entrada"  for="lista_num_entrada"  >           
            </datalist>           
            <input type="text" name="num_entrada" id="num_entrada" list="lista_num_entrada" required>
        </P> 
        <P class="parrafo_fecha_entrada ocultar">
        <label for="Fecha">
            <span>Seleccione un fecha</span>
            <input type="date" id="fecha_entrada" name="fecha_entrada">
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
                    <th class='proveedor ocultar'>PROVEDOR</th>
                    <th class='n_entrada ocultar'>NO. ENTRADA</th>
                    <th class='enc_codigo ocultar'>CODIGO</th>
                    <th class='enc_descripcion ocultar'>DESCRIPCION</th>
                    <th class='enc_unidad ocultar'>UNIDAD</th>                   
                    <th class='enc_cantidad ocultar'>CANTIDAD ENTRADA</th>  
                    <th class='idreintegrado ocultar'>IDENTIFICACION REINTEGRADO POR</th>
                    <th class='nomreintegrado ocultar'>NOMBRE REINTEGRADO POR </th>
                    <th>ALMACENISTA</th>     
                    <th class='enc_documento ocultar'>DOCUMENTO</th>             
                </tr>
            </thead>
            <tbody class="tabla_body_entrada"> 
            </tbody>
        </table>
    </section> 
</div>
   <?php require 'views/footer.php'?>
   <script src="public/js/consultaEntrada.js"></script>
</body>
</html>