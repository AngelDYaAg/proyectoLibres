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
  require "cabecera.php";
  require "head.php";
  ?>
</head>
<!-- cuerpo del la página -->




<body id="fondorepositorio">

    <div class="container">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div style="text-align:center">
                    <h1>FORO GENERAL</h1>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <a class="btn btn-primary btn-lg" href="nuevoForo.php" role="button">Nuevo Foro</a>
                        </div>
                        <div class="row" style="padding:20px;">
                            <table style="width:100%;" class="table table-striped">
                                <tr class="bg-primary">
                                    <td width="20%"><strong>Autor</strong></td>
                                    <td width="40%"><strong>Título</strong></td>
                                    <td width="10%"><strong>Fecha y hora</strong></td>
                                    <td width="20%"><strong>Opciones</strong></td>
                                </tr>
                                <?php
          foreach ($statement as $id) {
            $IDFORO = $id["IDFORO"];
            $IDAUTORFORO = (int) $id["IDAUTORFORO"];
            $NOMBREFORO = $id["NOMBREFORO"];
            $NOMBREAUTORFORO = $id["NOMBREAUTORFORO"];
            $FECHA = $id["FECHA"];
            
            echo "<tr>";
            echo "<td>$NOMBREAUTORFORO</td>";
            echo "<td>$NOMBREFORO</td>";
            echo "<td>$FECHA</td>";
            echo '<td>';  
            echo '<div style="padding:10px;">';  
              echo '<a class="btn btn-primary" href="verForo.php?no='.$IDFORO.'" role="button">Ver</a>';
              if($usuario==$IDAUTORFORO||$usuario==1){
                echo '<a type="button" class="btn btn-danger" href="eliminar_foro.php?no='.$IDFORO.'">Eliminar</a>' ;

              } 
            echo '</div>';  
            echo '</td>';
            echo "</tr>";

          }
          ?>
                            </table>
                        </div>

                    </div>
                </div>
            </div>



        </div>
    </div>

    </div>
</body>

</html>