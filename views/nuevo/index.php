<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
   <?php require 'views/header.php'?>
   <div id="main">
    <h1 class="center">Esta es la sección de nuevo</h1>
    <div class="center"><?php echo $this->mensaje;?></div>
    <form action="<?php echo constant('URL');?>nuevo/registrarPersona" method="POST">
        <P>
            <label for="identificacion">Identificacion:</label><br>
            <input type="text" name="identificacion" id="" required>
        </P>
        <P>
            <label for="nombre">Nombre:</label><br>
            <input type="text" name="nombre" id="" required>
        </P>
        <P>
            <label for="apellidos">apellidos:</label><br>
            <input type="text" name="apellidos" id="" required>
        </P>
        <P>
            <label for="cargo">Cargo:</label><br>
            <input type="text" name="cargo" id="" required>
        </P>   
        <p>
            <input type="submit" value="Registrar Persona">
        </p>   
    </form>
   </div>
   <?php require 'views/footer.php'?>
</body>
</html>