<?php session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
}
$errores = '';


if(isset($_POST['submit'])){
  $comentario = $_POST['inputComentario'];

  if (!empty($comentario)) {
    $comentario = trim($comentario);
  } else {
    $errores .= 'ingrese el comentario <br />';
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
        <table>
          <tr>
            <td><strong>usuario</strong></td>
            <td><strong>comentario</strong></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
          </tr>
        </table>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
          <div class="form-group">
            <label for="inputComentario">comentario</label>
            <textarea class="form-control" rows="5" id="inputComentario" name="inputComentario"></textarea>
          </div>
          <?php if(!empty($errores)): ?>
            <div class="alert error">
              <?php echo $errores; ?>
            </div>
          <?php endif ?>
          <input class="btn btn-primary btn-block" type="submit" name="submit" value="Comentar">
          <a class="btn btn-danger" href="foro.php" role="button">cerrar</a>
        </form>
      </div>
    </div>
  </div>
</body>

</html>