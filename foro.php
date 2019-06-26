<?php session_start();// Iniciar sesion 
if(!isset($_SESSION['usuario'])){// Si en la sesion no coincide con el usuario, nos redirige al index.php
  header('Location: index.php');
}
require 'conexion.php';
$usuario=$_SESSION['usuario'];
$statement = $conexion->query("SELECT IDUSUARIO FROM usuario WHERE USER LIKE '$usuario'");
foreach ($statement as $id) {
  $usuario=(integer)$id['IDUSUARIO'];
}
$statement = $conexion->query("SELECT IDFORO, NOMBREFORO, DESCRIPCIONFORO, IDAUTORFORO, NOMBREAUTORFORO FROM foro");

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
          <td width="20%"><strong>Autor</strong></td>
          <td width="60%"><strong>Título</strong></td>
          <td width="20%"><strong>Opciones</strong></td>
        </tr>
        <?php
        foreach ($statement as $id) {
          $NOMBREFORO = $id["NOMBREFORO"];
          $NOMBREAUTORFORO = $id["NOMBREAUTORFORO"];
          
          echo "<tr>";
          echo "<td>$NOMBREFORO</td>";
          echo "<td>$NOMBREAUTORFORO</td>";
          echo '<td>';  
            echo '<a class="btn btn-primary" href="verForo.php" role="button">ver</a>'; 
            echo '<button type="button" class="btn btn-danger">eliminar</button>' ;
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