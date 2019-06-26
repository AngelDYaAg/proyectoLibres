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
$statement = $conexion->query("SELECT IDFORO, NOMBREFORO, DESCRIPCIONFORO, IDAUTORFORO, NOMBREAUTORFORO, FECHA FROM foro ORDER BY FECHA DESC");

?>
<!DOCTYPE html>
<html lang="sp">
<!-- cabecera de la página -->
<head>
  <?php
  require "head.php";
  ?>
</head>
 <!-- cuerpo del la página -->




<body id="fondorepositorio">
  <div class="container">
      <div class="row" style="text-align: right;">
        <a class="btn btn-link" href="cerrarSesion.php" role="button">Cerrar Sesión</a><!-- entrada del boton cerrar sesion  -->
      </div>
  </div>
  <div class="containerRepositorio1">
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

      <div class="row" style="text-align:center;margin:10px;">
        <a class="btn btn-primary btn-lg" href="nuevoForo.php" role="button">Nuevo Tema</a>
      </div><!-- entrada del boton nuevo  -->
      <div class="row">
        <table style="width:100%;">
          <tr>
            <td width="20%"><strong>Autor</strong></td>
            <td width="40%"><strong>Título</strong></td>
            <td width="10%"><strong>Fecha</strong></td>
            <td width="20%"><strong>Opciones</strong></td>
          </tr>
          <?php
          foreach ($statement as $id) {
            $IDFORO = $id["IDFORO"];
            $NOMBREFORO = $id["NOMBREFORO"];
            $NOMBREAUTORFORO = $id["NOMBREAUTORFORO"];
            $FECHA = $id["FECHA"];
            
            echo "<tr>";
            echo "<td>$NOMBREAUTORFORO</td>";
            echo "<td>$NOMBREFORO</td>";
            echo "<td>$FECHA</td>";
            echo '<td>';  
              echo '<a class="btn btn-primary" href="verForo.php?no=" role="button">Ver</a>';
              if($usuario==2||$usuario==1){
                echo '<a type="button" class="btn btn-danger" href="eliminar_foro.php?no='.$IDFORO.'">Eliminar</a>' ;

              } 
            echo '</td>';
            echo "</tr>";

          }
          ?>
        </table>
      </div>
     
    </div>
  </div>
</div>
</body>

</html>