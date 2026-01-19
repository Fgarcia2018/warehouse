    <?php require 'views/header.php'?>
<div id="main">
    <h1 class="center">Cargue de Documentos</h1>
    <p> 
        <fieldset id='tipo_documento'>
            <legend>Tipo De Documento a cargar: </legend>    
            <input type="radio"class="boton_radio" id="entrada" name="tipo_documento" value="entrada">
            <label for="">Entrada De Materiales</label>
            <input type="radio"class="boton_radio" id="salida" name="tipo_documento" value="salida">
            <label for="">Salida De Materiales</label>            
        </fieldset>
    </p>
    <form  class="form_documentos ocultar" method="POST" enctype="multipart/form-data">        
        <P class="parrafo_datalist_num_documento ">
            <label for="num_documento">Seleccione Num. Documento:</label>
            <datalist id="lista_num_documento" name="lista_num_documento"  for="lista_num_documento"  >           
            </datalist>           
            <input type="text" name="num_documento" id="num_documento" list="lista_num_documento" required>
            <input type="file" name="archivo" id="archivo" required>
            <input type="button" id="subir_archivo" name="subir_archivo" onclick="enviarDatos()" value="Guardar">
        </P>  
             
    </form>
    <section class="resultado_documento ocultar center">
    </section> 
</div>
   <?php require 'views/footer.php'?>
   <script src="public/js/cargueDocumentos.js"></script>
</body>
</html>