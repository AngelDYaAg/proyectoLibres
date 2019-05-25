<?php
$errores = '';


if(isset($_POST['submit'])){
  $nombre = $_POST['inputNombre'];
  $descripcion = $_POST['inputDescripcion'];

  if (!empty($nombre)) {
    $nombre = trim($nombre);
  } else {
    $errores .= 'ingrese el nombre del foro <br />';
  }
  if (!empty($descripcion)) {
    $descripcion = trim($descripcion);
  } else {
    $errores .= 'ingrese la descripcion del foro';
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require "head.php";
  ?>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio personal</a>
        <br>
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio publico</a>
        <br>
        <a class="btn btn-primary" href="foro.php" role="button">Foro</a>
      </div>
      <div class="col-sm-8">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <div class="form-group">
            <label for="inputNombre">Nombre</label>
            <input type="text" class="form-control" id="inputNombre" name="inputNombre" placeholder="ingrese nombre">
          </div>
          <div class="form-group">
            <label for="inputDescripcion">Descripcion</label>
            <textarea class="form-control" rows="5" id="inputDescripcion" name="inputDescripcion"></textarea>
          </div>
          <?php if(!empty($errores)): ?>
            <div class="alert error">
              <?php echo $errores; ?>
            </div>
          <?php endif ?>
          <input class="btn btn-primary btn-block" type="submit" name="submit" value="crear">
          <a class="btn btn-danger" href="foro.php" role="button">cancelar</a>
        </form>       
      </div>
    </div>
  </div>
</body>

</html>