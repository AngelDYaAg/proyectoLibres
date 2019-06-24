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
  $statement = $conexion->query("SELECT IDUSUARIO,NOMBRESUSUARIO,APELLIDOSUSUARIO,ESTADOUSUARIO FROM usuario");
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
        <br>
       
      </div>
      <div class="col-sm-9">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <br>
        <br>

      </form>
      <table>

        <tr>
          <td width="10%"><strong>Nombre</strong></td>
          <td width="10%"><strong>Apellido</strong></td>
          <td width="10%"><strong>Estado</strong></td>
          <td width="10%"><strong>Opciones</strong></td>
        </tr>
        <?php
        foreach ($statement as $id) {
          $IDUSUARIO = $id["IDUSUARIO"];
          $NOMBRE = $id["NOMBRESUSUARIO"];
          $APELLIDO = $id["APELLIDOSUSUARIO"];
          $ESTADO = $id["ESTADOUSUARIO"];
          
          echo "<tr>";
          echo "<td>$NOMBRE</td>";
          echo "<td>$APELLIDO</td>";
          echo "<td>$ESTADO</td>";
        
          echo '<td>';             
          echo '<div class="dropdown">';
          echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Estado';
          echo '<span class="caret"></span>';
          echo '</button>';
          echo '<ul class="dropdown-menu">';
          echo '<li><a href="activar.php?no='.$IDUSUARIO.'">Activo</a></li>';
          echo '<li><a href="bloquear.php?no='.$IDUSUARIO.'">Bloqueado</a></li>';
          echo '</ul>';
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