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

<body class="bg-dark">
  <div class="container">
    <div class="row">
      <div class="row" style="text-align: right;">
        <a class="btn btn-link" href="cerrarSesion.php" role="button">cerrar sesion</a>
      </div>
      <div class="col-sm-4">
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio personal</a>
        <br>
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio publico</a>
        <br>
        <a class="btn btn-primary" href="foro.php" role="button">Foro</a>
      </div>
      <div class="col-sm-8">
        <a class="btn btn-primary" href="nuevoForo.php" role="button">nuevo</a>
      </form>
      <table>
        <tr>
          <td><strong>Nombre</strong></td>
          <td><strong>Descripcion</strong></td>
          <td><strong>Opciones</strong></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td>              
            <a class="btn btn-primary" href="verForo.php" role="button">ver</a>
            <button type="button" class="btn btn-danger">eliminar</button>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
</body>

</html>