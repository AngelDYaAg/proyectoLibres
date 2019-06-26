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
if(isset($_POST['autor'])&&!empty($_POST['autor'])) { 
  $AUTOR = $_POST['autor'];
  echo "autor: $AUTOR";
  $statement = $conexion->query("SELECT IDREPOSITORIO,NOMBRERECURSO,DESCRIPCIONRECURSO,TIPORECURSO,AUTORRECURSO,INSTAUTORRECURSO,FECHACREACIONRECURSO,TIPOARCHIVO,SIZERECURSO FROM recurso WHERE ESTADORECURSO LIKE 'privado' AND AUTORRECURSO LIKE '$AUTOR' AND IDUSUARIO = $usuario");
}else if(isset($_POST['fecha'])&&!empty($_POST['fecha'])){
  $FECHA = $_POST['fecha'];
  echo "fecha: $FECHA";
  $statement = $conexion->query("SELECT IDREPOSITORIO,NOMBRERECURSO,DESCRIPCIONRECURSO,TIPORECURSO,AUTORRECURSO,INSTAUTORRECURSO,FECHACREACIONRECURSO,TIPOARCHIVO,SIZERECURSO FROM recurso WHERE ESTADORECURSO LIKE 'privado' AND FECHACREACIONRECURSO LIKE '$FECHA' AND IDUSUARIO = $usuario");
}else if(isset($_POST['materia'])&&!empty($_POST['materia'])){
  $MATERIA = $_POST['materia'];
  echo "MATERIA: $MATERIA";
  $statement = $conexion->query("SELECT IDREPOSITORIO,NOMBRERECURSO,DESCRIPCIONRECURSO,TIPORECURSO,AUTORRECURSO,INSTAUTORRECURSO,FECHACREACIONRECURSO,TIPOARCHIVO,SIZERECURSO FROM recurso WHERE ESTADORECURSO LIKE 'privado' AND IDMATERIA = $MATERIA AND IDUSUARIO = $usuario");
}else if(isset($_POST['clave'])&&!empty($_POST['clave'])){
  $CLAVE = $_POST['clave'];
  echo "CLAVE: $CLAVE";
  $statement = $conexion->query("SELECT IDREPOSITORIO,NOMBRERECURSO,DESCRIPCIONRECURSO,TIPORECURSO,AUTORRECURSO,INSTAUTORRECURSO,FECHACREACIONRECURSO,TIPOARCHIVO,SIZERECURSO FROM recurso WHERE ESTADORECURSO LIKE 'privado' AND PALABRASCLAVERECURSO = '$CLAVE' AND IDUSUARIO = $usuario");
}else{
  $statement = $conexion->query("SELECT IDREPOSITORIO,NOMBRERECURSO,DESCRIPCIONRECURSO,TIPORECURSO,AUTORRECURSO,INSTAUTORRECURSO,FECHACREACIONRECURSO,TIPOARCHIVO,SIZERECURSO FROM recurso WHERE ESTADORECURSO LIKE 'privado' AND IDUSUARIO = $usuario");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require "head.php";
  ?>
</head>

<body id="fondorepositorio">
  <div class="container">
    <div class="row" style="text-align: right;">
      <a class="btn btn-link" href="cerrarSesion.php" role="button">Cerrar Sesión</a>
    </div>
  </div>
  <div class="containerRepositorio1">

    <div class="row">
      <div class="col-sm-1">
        <br>

        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio personal</a>
        <br>
        <br>
        <a class="btn btn-primary" href="repositorioPublico.php" role="button">Repositorio público</a>
        <br>
        <br>
        <a class="btn btn-primary" href="foro.php" role="button">Foro</a>
      </div>
      <div class="col-sm-9">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="btn btn-primary" href="buscar.php" role="button">Buscar</a>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a class="btn btn-primary" href="nuevoRecurso.php" role="button">Nuevo recurso</a>
        <br>
        <br>

      </form>
      <table>

        <tr>
          <td width="10%"><strong>Nombre</strong></td>
          <td width="10%"><strong>Descripcion</strong></td>
          <td width="10%"><strong>Tipo</strong></td>
          <td width="10%"><strong>Autor</strong></td>
          <td width="10%"><strong>institucion</strong></td>
          <td width="10%"><strong>Fecha creacion</strong></td>
          <td width="10%"><strong>tamaño archivo</strong></td>
          <td width="10%"><strong>tipo archivo</strong></td>
          <td width="10%"><strong>Fecha ingreso</strong></td>
          <td width="20%"><strong>Opciones</strong></td>
        </tr>
        <?php
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
          // echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Calificar';
          // echo '<span class="caret"></span>';
          // echo '</button>';
          // echo '<ul class="dropdown-menu">';
          // echo '<li><a href="#">1</a></li>';
          // echo '<li><a href="#">2</a></li>';
          // echo '<li><a href="#">3</a></li>';
          // echo '<li><a href="#">4</a></li>';
          // echo '<li><a href="#">5</a></li>';
          // echo '</ul>';
          echo '<a class="btn btn-success" href="publicar.php?idpublicar='.$IDREPOSITORIO.'">Publicar</a>';
          echo " ";
          echo '<a class="btn btn-warning" href="descargar.php?iddescargar='.$IDREPOSITORIO.'">Descargar</a>';

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