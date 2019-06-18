<?php session_start();// Iniciar sesion 
if(!isset($_SESSION['usuario'])){// Si en la sesion no coincide con el usuario, nos redirige al index.php
  header('Location: index.php');
}
$errores = '';


if(isset($_POST['submit'])){//verificar informacion enviada por POST
  $nombre = $_POST['inputNombre'];//recibe informacion de nombre
  $descripcion = $_POST['inputDescripcion'];// recibe informacion de descripcion 

  if (!empty($nombre)) {//verifica que exista el parametro nobmre
    $nombre = trim($nombre);//elimina espacios al principio y al final del nombre
  } else {
    $errores .= 'ingrese el nombre del foro <br />';
  }
  if (!empty($descripcion)) {//verifica que exista el parametro descripcion
    $descripcion = trim($descripcion);//elimina espacios al principio y al final de descripcion
  } else {
    $errores .= 'ingrese la descripcion del foro';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<!-- cabecera de la página -->
<head>
  <?php
  require "head.php";
  ?>
</head>
<!-- cuerpo del la página -->
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio personal</a><!-- entrada del boton Repositorio personal  -->
        <br>
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio publico</a><!-- entrada del boton Repositorio publico  -->
        <br>
        <a class="btn btn-primary" href="foro.php" role="button">Foro</a><!-- entrada del boton Foro  -->
      </div>
      <div class="col-sm-8">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"><!--enviar parametros por Post-->
          <div class="form-group">
            <label for="inputNombre">Nombre</label><!-- label Nombre -->
            <input type="text" class="form-control" id="inputNombre" name="inputNombre" placeholder="ingrese nombre"><!-- entrada del label Nombre -->
          </div>
          <div class="form-group">
            <label for="inputDescripcion">Descripcion</label><!-- label descripcion -->
            <textarea class="form-control" rows="5" id="inputDescripcion" name="inputDescripcion"></textarea><!-- entrada del label descripcion -->
          </div>
          <?php if(!empty($errores)): ?><!-- leer errores de nombre o descripcion -->
            <div class="alert error">
              <?php echo $errores; ?>
            </div>
          <?php endif ?>
          <input class="btn btn-primary btn-block" type="submit" name="submit" value="crear"><!-- entrada del boton crear -->
          <a class="btn btn-danger" href="foro.php" role="button">cancelar</a><!-- entrada del boton cancelar -->
        </form>       
      </div>
    </div>
  </div>
</body>

</html>