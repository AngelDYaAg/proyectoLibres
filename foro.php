<?php session_start();// Iniciar sesion 
if(!isset($_SESSION['usuario'])){// Si en la sesion no coincide con el usuario, nos redirige al index.php
  header('Location: index.php');
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
<body class="bg-dark">
  <div class="container">
    <div class="row">
      <div class="row" style="text-align: right;">
        <a class="btn btn-link" href="cerrarSesion.php" role="button">cerrar sesion</a><!-- entrada del boton cerrar sesion  -->
      </div>
      <div class="col-sm-4">
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio personal</a><!-- entrada del boton Repositorio personal  -->
        <br>
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio publico</a><!-- entrada del boton Repositorio publico  -->
        <br>
        <a class="btn btn-primary" href="foro.php" role="button">Foro</a><!-- entrada del boton Foro  -->
      </div>
      <div class="col-sm-8">
        <a class="btn btn-primary" href="nuevoForo.php" role="button">nuevo</a><!-- entrada del boton nuevo  -->
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
            <a class="btn btn-primary" href="verForo.php" role="button">ver</a><!-- entrada del boton ver  -->
            <button type="button" class="btn btn-danger">eliminar</button><!-- entrada del boton eliminar  -->
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
</body>

</html>