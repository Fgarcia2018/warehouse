   <?php require 'views/header.php'?>
   <div id="main">
    <h1 class="center">Salidas de material</h1>
    <div class="center" id='mensaje'></div>
    <form method="POST" id="form_salidas" enctype="multipart/form-data">     
        <P>
            <label for="num_salida">No. salida:</label>
            <input type="text" name="num_salida" id="num_salida" readonly style='background:none; border:none;font-size: x-large;
                color: red;'>
        </P>   
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
                        <th>Stock</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
            </table>  
        <P>
            <label for="idresponsable">Asignado a:</label><br>
            <datalist id="list_employee" name="list_employee"  for="list_employee"  >               
            </datalist>
            <input type="text" name="idresponsable" id="idresponsable" list="list_employee" requiredrequired>
        </P> 
        <P>
            <label for="idalmacenista">Entregado por:</label><br>
            <input type="text" name="idalmacenista" id="idalmacenista" required>
        </P>
       
        <p>
            <input type="button" value="Registrar" id='boton_registrar' onclick="enviarDatos()"> 
            <input type="button" value="Generar PDF" onclick="generarPdf()">                       
        </p>   
          
    </form>
   </div>
   <?php require 'views/footer.php'?>
   <script src='public/js/jspdf.min.js'></script>
    <script src='public/js/salidaMaterial.js'></script> 
</body>
</html>