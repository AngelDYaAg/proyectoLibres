<?php session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
}

require 'conexion.php';
$usuario=$_SESSION['usuario'];
$statement = $conexion->query("SELECT IDUSUARIO FROM usuario WHERE USER LIKE '$usuario'");
foreach ($statement as $id) {
$usuario=(integer)$id['IDUSUARIO'];
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
        <a class="btn btn-primary" href="nuevoRecurso.php" role="button">Nuevo recurso</a>
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
        <?php
          $statement = $conexion->query("SELECT IDREPOSITORIO,NOMBRERECURSO,DESCRIPCIONRECURSO,TIPORECURSO,AUTORRECURSO,INSTAUTORRECURSO,FECHACREACIONRECURSO,TIPOARCHIVO,SIZERECURSO FROM recurso WHERE ESTADORECURSO LIKE 'privado' AND IDUSUARIO = $usuario");
          foreach ($statement as $id) {
            $IDREPOSITORIO = $id["IDREPOSITORIO"];
            $NOMBRERECURSO = $id["NOMBRERECURSO"];
            $DESCRIPCIONRECURSO = $id["DESCRIPCIONRECURSO"];
            $TIPORECURSO = $id["TIPORECURSO"];
            $AUTORRECURSO = $id["AUTORRECURSO"];
            $INSTAUTORRECURSO = $id["INSTAUTORRECURSO"];
            $FECHACREACIONRECURSO = $id["FECHACREACIONRECURSO"];
            $SIZERECURSO = $id["SIZERECURSO"];
            $TIPOARCHIVO = $id["TIPOARCHIVO"];
            $FECHACREACIONRECURSO = $id["FECHACREACIONRECURSO"];


            echo "<tr>";
            echo "<td>$NOMBRERECURSO</td>";
            echo "<td>$DESCRIPCIONRECURSO</td>";
            echo "<td>$TIPORECURSO</td>";
            echo "<td>$AUTORRECURSO</td>";
            echo "<td>$INSTAUTORRECURSO</td>";
            echo "<td>$FECHACREACIONRECURSO</td>";
            echo "<td>$SIZERECURSO</td>";
            echo "<td>$TIPOARCHIVO</td>";
            echo "<td>$FECHACREACIONRECURSO</td>";
            echo '<td>';             
            echo '<div class="dropdown">';
            echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Calificar';
            echo '<span class="caret"></span>';
            echo '</button>';
            echo '<ul class="dropdown-menu">';
            echo '<li><a href="#">1</a></li>';
            echo '<li><a href="#">2</a></li>';
            echo '<li><a href="#">3</a></li>';
            echo '<li><a href="#">4</a></li>';
            echo '<li><a href="#">5</a></li>';
            echo '</ul>';
            echo '<a class="btn btn-success" href="publicar.php?idpublicar='.$IDREPOSITORIO.'">Publicar</a>';
            echo '<a class="btn btn-danger" href="eliminar.php?no='.$IDREPOSITORIO.'">Eliminar</a>';
            echo '</div>';
            echo '</td>';
            echo "</tr>";

          }
          ?>
      </table>
    </div>
  </div>
</div>
</body>

</html>