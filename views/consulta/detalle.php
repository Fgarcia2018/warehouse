<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php require 'views/header.php'?>
   <div id="main">
    <h1 class="center">Detalle de <?php echo $this->persona->identificacion;?></h1>
    <div class="center"><?php echo $this->mensaje;?></div>
    <form action="<?php echo constant('URL');?>consulta/actualizarPersona" method="POST">
        <P>
            <label for="identificacion">Identificacion:</label><br>
            <input type="text" name="identificacion" disabled value=<?php echo $this->persona->identificacion;?> required>
        </P>
        <P>
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" value=<?php echo $this->persona->nombre;?> required>
        </P>
        <P>
            <label for="apellidos">apellidos:</label><br>
            <input type="text" name="apellidos" value=<?php echo $this->persona->apellidos;?> required>
        </P>
        <P>
            <label for="cargo">Cargo:</label><br>
            <input type="text" name="cargo" value=<?php echo $this->persona->cargo;?> required>
        </P>   
        <p>
            <input type="submit" value="Actualizar Persona">
        </p>   
    </form>
   </div>
   <?php require 'views/footer.php'?>
</body>
</html>