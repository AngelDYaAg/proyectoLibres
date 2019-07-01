<?php session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require "head.php";

  ?>
</head>

<body id="fondoindex">
  <div class="container">
    <div class="row" style="text-align: right;">
      <a class="btn btn-link" href="cerrarSesion.php" role="button">Cerrar Sesión</a>
    </div>
  </div>
  <div class="containerinicio">  
    <div class="card-body"  >
      <div class="text-center">
        <br>
        <a class="btn btn-success btn-block" href="usuarios.php">Usuarios</a>
        <br>
        <a class="btn btn-primary btn-block" href="repositorioPublico.php">Repositorio Publico</a>
        <br>
        <a class="btn btn-primary btn-block" href="foro.php">Foro</a>
      </div>
    </div>
  </div> 

</body>

</html>