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

  <div class="containerinicio">  
    <div class="card-body"  >
      <div class="text-center">
        <br>
        <a class="btn btn-success btn-block" href="usuarios.php">Usuarios</a>
        <br>
        <a class="btn btn-primary btn-block" href="repositorioPublicoAdministrador.php">Repositorio Publico</a>
      </div>
    </div>
  </div> 

</body>

</html>