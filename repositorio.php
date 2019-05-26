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
    <div class="row" style="text-align: right;">
      <a class="btn btn-link" href="cerrarSesion.php" role="button">cerrar sesion</a>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio personal</a>
        <br>
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio publico</a>
        <br>
        <a class="btn btn-primary" href="foro.php" role="button">Foro</a>
      </div>
      <div class="col-sm-8">
        <a class="btn btn-primary" href="buscar.php" role="button">Buscar</a>
      </form>
      <table>
        <tr>
          <td><strong>Nombre</strong></td>
          <td><strong>Descripcion</strong></td>
          <td><strong>Tipo</strong></td>
          <td><strong>Autor</strong></td>
          <td><strong>institucion</strong></td>
          <td><strong>Fecha creacion</strong></td>
          <td><strong>tamaño archivo</strong></td>
          <td><strong>tipo archivo</strong></td>
          <td><strong>Fecha ingreso</strong></td>
          <td><strong>Opciones</strong></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td>              
            <div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Calificar
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu">
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
              </ul>
              <button type="button" class="btn btn-success">Publicar</button>
              <button type="button" class="btn btn-danger">Eliminar</button>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </div>
</div>
</body>

</html>