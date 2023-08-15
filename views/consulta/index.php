<?php require 'views/header.php'?>
<div id="main">
    <h1 class="center">Consulta Stock</h1>
    <p> 
    <fieldset id='tipo_consulta'>
            <legend>Generar reporte por: </legend>    
            <input type="radio"class="boton_radio" id="general" name="tipo_consulta" value="general">
            <label for="">General</label>
            <input type="radio"class="boton_radio" id="cantidad" name="tipo_consulta" value="cantidad">
            <label for="">Cantidad</label>
            <input type="radio" class="boton_radio"id="categoria" name="tipo_consulta" value="categoria">
            <label for="">Categoria</label>
        </fieldset>
    </p>
    <form  id='form-consulta-entrada' method="POST" enctype="multipart/form-data">        
        <P class="parrafo_cantidad ocultar">
            <label for="cantidad">Cantidad en stock menor a:</label>                  
            <input type="number" name="cantidad_stock" id="cantidad_stock" min="0" max="2000" required>
        </P> 
          
    </form>
    <section class="resultado_consulta ocultar">
  
        <table width="100%" class='tabla_consulta'>
        <caption class='tabla_titulo ocultar'></caption>
            <thead class='tabla_consulta_encabezados'>
                <tr>
                    <th>CODIGO</th>
                    <th>DESCRIPCION</th>
                    <th>UNIDAD</th>
                    <th>CANTIDAD ENTRADA</th> 
                    <th>CANTIDAD SALIDA</th> 
                    <th>STOCK</th> 
                </tr>
            </thead>
            <tbody class="tabla_body_stock" >            
            </tbody>
        </table>
    </section>
</div>
   <?php require 'views/footer.php'?>
   <script src="public/js/consultaStock.js"></script>
</body>
</html>