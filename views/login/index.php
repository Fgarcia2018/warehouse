<!DOCTYPE html>
<html lang="en">
<head>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>::::WAREHOUSE🛠:::::</title>    
    <link rel="stylesheet" href="<?php echo constant('URL');?>public/css/styles.css">
</head>
<body>
      <h1 class='title-login center'>WAREHOUSE🛠</h1> 
      <section id='section-login'>
            <section class='section-message-login center'>
                  <?php            
                        if(!isset($_GET['mensaje'])){
                          echo '<h1></h1>';
                        }else{
                          echo '<h2>'.$_GET['mensaje'].'</h2>';
                        }               
                    ?>
              </section>  
              <section class="section_formulario_login">
                    <h2 class="center">Iniciar Sesión</h1>              
                    <form name="form_login" action="<?php echo constant('URL');?>login/validar" method="POST">
                          <table id="tabla_login">
                            <tr>
                              <td>Usuario</td>
                              <td><label for="usuario"></label>
                              <input type="text" name="usuario" id="usuario" required></td>
                            </tr>
                            <tr>
                              <td>Contraseña</td>
                              <td><label for="password"></label>
                              <input type="password" name="password" id="password" required></td>
                            </tr>   
                      
                            <tr>
                              <td colspan="2" align="center" class="g-recaptcha" data-sitekey="6Lf8-v8mAAAAANZFu1y4X5OoIMdhyHjdDr9RM-6j"></td>
                              
                            </tr>
                              <tr>   
                            
                              <td colspan="2" align="center"><input type="submit" name="enviar" id="enviar" value="Ingresar"></td>                
                            </tr>
                        </table>
                    </form>
            </section>
      </section> 
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>   
</body>
</html> 
