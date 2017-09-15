<?php
//Definimos la codificación de la cabecera.
header('Content-Type: text/html; charset=utf-8');
//Importamos el archivo con las validaciones.
require_once 'validaciones.php';

//Guarda los valores de los campos en variables, siempre y cuando se haya enviado el formulario, sino se guardará null.
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$edad = isset($_POST['edad']) ? $_POST['edad'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
//Este array guardará los errores de validación que surjan.
$errores = array();
//Pregunta si está llegando una petición por POST, lo que significa que el usuario envió el formulario.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   //Valida que el campo nombre no esté vacío.
   if (!validaRequerido($nombre)) {
      $errores[] = 'El campo nombre es incorrecto.';
   }
   //Valida la edad con un rango de 3 a 130 años.
   $opciones_edad = array(
      'options' => array(
         //Definimos el rango de edad entre 3 a 130.
         'min_range' => 3,
         'max_range' => 130
      )
   );
   if (!validarEntero($edad, $opciones_edad)) {
      $errores[] = 'El campo edad es incorrecto.';
   }
   //Valida que el campo email sea correcto.
   if (!validaEmail($email)) {
      $errores[] = 'El campo email es incorrecto.';
   }
   //Verifica si ha encontrado errores y de no haber redirige a la página con el mensaje de que pasó la validación.
   if(!$errores){
      header('Location: validado.php');
      exit;
   }
}
?>

<!DOCTYPE html>
<html lang="es">
 <head>
    <title> WebApp </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="UTF-8">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
 </head>
 <body>
  <header>
    <div class="container">
			<h3>Trabajo Práctico 1 | Programacion Avanzada 2017</h3>
		</div>
   </header>

   <!-- Contenido principal -->
   <div class="container">
     <div class="col-sm-6" style="margin: 0 auto;">
      <div class="jumbotron">
        <div class="form-group">
          <h1>Bienvenido a WebApp!</h1>
        </div>
         <?php if ($errores): ?>
            <ul style="color: #f00;">
               <?php foreach ($errores as $error): ?>
                  <li> <?php echo $error ?> </li>
               <?php endforeach; ?>
            </ul>
         <?php endif; ?>

         <form method="post" action="index.php" class="form-horizontal">
           <div class="form-group input-group">
             <span class="input-group-addon">
               <span class="glyphicon glyphicon-user"></span>
             </span>
              <input type="text" name="nombre" class="form-control" placeholder="usuario" />
           </div>
           <div class="form-group input-group">
              <input type="password" name="password" class="form-control" placeholder="contraseña" />
           </div>
           <div class="form-group">
              <input type="submit" class="btn btn-large btn-primary" value="Entrar" />
           </div>

         </form>
       </div>
     </div>
   </div>

    <footer>
      <div class="container">
        <div class="center_div">
          <p>&copy; Todos los derechos reservados al Gupo 1: Perezlindo, Prinsich y Francesconi. 2017</p>
        </div>
      </div>
    </footer>

    <!-- Incluimos los Jquerys -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
 </body>
</html>
