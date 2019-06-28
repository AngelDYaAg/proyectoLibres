<?php session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
}
require 'conexion.php';
$usuario=$_SESSION['usuario'];
$RESPUESTA='';

function clearRespuesta()
    {
        // do stuff     
    }
$statement = $conexion->query("SELECT IDUSUARIO,NOMBRESUSUARIO,APELLIDOSUSUARIO FROM usuario WHERE USER LIKE '$usuario'");
foreach ($statement as $id) {
  $usuario=(integer)$id['IDUSUARIO'];
  $NOMBRECOMPLETO=$id["NOMBRESUSUARIO"] ." ". $id["APELLIDOSUSUARIO"];
}
$IDFORO=(integer)$_GET['no']; // obtener el id del foro
//$statement = $conexion->query("SELECT IDUSUARIO FROM usuario WHERE USER LIKE '$usuario'");
$statement = $conexion->query("SELECT  NOMBREFORO, DESCRIPCIONFORO, NOMBREAUTORFORO, FECHA, ARCHIVORUTA FROM foro WHERE IDFORO = $IDFORO");

foreach ($statement as $id) {
  $NOMBREFORO=$id['NOMBREFORO'];
  $DESCRIPCIONFORO=$id['DESCRIPCIONFORO'];
  $NOMBREAUTORFORO=$id['NOMBREAUTORFORO'];
  $ARCHIVORUTAFORO = $id["ARCHIVORUTA"];
  $FECHA=$id['FECHA'];
}


$statementComentarios = $conexion->query("SELECT  IDCOMENTARIO, IDFORO, IDUSUARIO,NOMBREAUTORCOMENTARIO, CONTENIDO, FECHA, ARCHIVORUTA FROM comentario_foro WHERE IDFORO = $IDFORO");
$errores = '';


if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['submit'])){
      $comentario = $_POST['inputComentario'];
      if (!empty($comentario)) {
        $comentario = trim($comentario);
    
      } else {
        $errores .= 'ingrese el comentario <br />';
      }
    
      if (empty($errores)) {
        
        $RESPUESTA='';
        
        try {
          $timezone  = -5; //(GMT -5:00) 
          $fecha= gmdate("Y/m/j H:i:s", time() + 3600*($timezone)); 
          $statement = $conexion->query("INSERT INTO comentario_foro (IDFORO,IDUSUARIO,NOMBREAUTORCOMENTARIO,CONTENIDO,FECHA) VALUES ($IDFORO,$usuario,'$NOMBRECOMPLETO','$comentario','$fecha')");
          
          $id_inserted=$conexion->lastInsertId();
          $carpeta = "archivos/foros/$IDFORO";
    
          if (!file_exists($_FILES['inputArchivo']['tmp_name']) || !is_uploaded_file($_FILES['inputArchivo']['tmp_name'])){
            // No hacer ninguna actualizacion si no hay archivo
    
          }else{
            //Copiar archivo subido a la carpeta del foro
            $RUTARECURSO=$carpeta.'/'.$_FILES['inputArchivo']['name'];
            copy($_FILES['inputArchivo']['tmp_name'], $RUTARECURSO);
            $TIPOARCHIVO=$_FILES['inputArchivo']['type'];
            //Actualizar en la base de datos la ubicacion del archivo del foro
            $sql = "UPDATE comentario_foro SET ARCHIVORUTA='$RUTARECURSO', TIPOARCHIVO='$TIPOARCHIVO' WHERE IDCOMENTARIO=$id_inserted";
            $statement = $conexion->prepare($sql);
            $statement->execute();
          }
          
          
          header('Location: verForo.php?no='.$IDFORO.'');
        
        
        } catch (Exception $e) {
          echo "error: " . $e->getMessage();
          
        }
        
      }
  }
  if(isset($_POST['clear'])){
    echo 'ENTRA CLEAR';
  }
  if(isset($_POST['respuesta'])){
    echo 'ENTRA RESPUESTA';
  }

}
?>

<!DOCTYPE html>
<html lang="sp">

<head>
  <?php
  require "cabecera.php";
  require "head.php";
  ?>
</head>

<body  id="fondorepositorio">
  <div class="container">
  <div class="panel panel-primary">
    <div class="panel-heading">
        <div style="text-align:center">
            <?php
            echo "<h1>$NOMBREFORO</h1>";
            ?>    
          </div>
    </div>
    <div class="panel-body">
      <div class="row">
      <div class="col-md-6" style="text-align:center">
        <?php
          echo "<h4>Publicado por: $NOMBREAUTORFORO</h4>";
        ?>  
      </div>
      <div class="col-md-6" style="text-align:center">
        <?php
          echo "<h4>Fecha publicación: $FECHA</h4>";
        ?>  
      </div>
      </div>
      <div class="row" style="text-align:center;border-top-style: solid;border-top-color: darkgray;">
        <h3 style="text-align:center;width:100%;">
        Contenido del foro:
        </h3>
      </div>
      <div class="row">
        <?php
          echo "<div style='margin: 20px; padding: 20px;border-style: dashed;border-color: darkgray; text-align: center;width:100%;'> <p>$DESCRIPCIONFORO</p></div>";
        ?>  
      
      </div>

      

      <?php
        if(!is_null($ARCHIVORUTAFORO)){
          echo '<div class="row">';
          echo    '<div class="col-sm-12">';
          echo      '<div class="text-center">';
          echo        '<a class="btn btn-success" href="descargar_archivo_foro.php?no='.$IDFORO.'">';
          echo          '<span class="glyphicon glyphicon-download"></span>';
          echo            'Descargar archivo: '.explode('/',$ARCHIVORUTAFORO)[3];
          echo        '</a>';
          echo      '</div>';
          echo    '</div>';
          echo  '</div>';
        }
      ?>

      <br>  

    
    <div class="panel-footer">
      <div class="row">
      <h4 style="text-align:center;width:100%;">
      Comentarios del foro:
      </h4>
      </div>
      <div class="row" style="padding:20px;">
        <table style="width:100%;" class="table table-striped">
            <tr class="bg-primary">
              <td width="20%"><strong>Autor</strong></td>
              <td width="40%"><strong>Comentario</strong></td>
              <td width="10%"><strong>Fecha y hora</strong></td>
              <td width="20%"><strong>Opciones</strong></td>
            </tr>

            <?php
            foreach ($statementComentarios as $id) {
              $IDCOMENTARIO=(integer) $id["IDCOMENTARIO"];
              $IDUSUARIO =(integer) $id["IDUSUARIO"];
              $NOMBREAUTORCOMENTARIO = $id["NOMBREAUTORCOMENTARIO"];
              $CONTENIDO = $id["CONTENIDO"];
              $FECHA = $id["FECHA"];
              $ARCHIVORUTACOMENTARIO=$id["ARCHIVORUTA"];
              

              echo "<tr>";
              echo "<td>$NOMBREAUTORCOMENTARIO</td>";
              echo "<td>$CONTENIDO</td>";
              echo "<td>$FECHA</td>";
              echo '<td>';  
              echo '<div style="padding:10px;">';  
              
              //echo  '<form action="verForo.php?no='.$IDFORO.'" method="post">';
                echo '<button class="btn btn-primary" data-toggle="modal" data-target="#respuestaModal">Responder</button>';
              //echo  '</form>';
                if($usuario==$IDUSUARIO||$usuario==1){
                  echo '<a type="button" class="btn btn-danger" href="eliminar_comentario_foro.php?idForo='.$IDFORO.'&idComentario='.$IDCOMENTARIO.'">Eliminar</a>' ;

                } 
              echo '</div>';
              if(!is_null($ARCHIVORUTACOMENTARIO)){
                echo '<div class="row">';
                echo    '<div class="col-sm-12">';
                echo      '<div class="text-center">';
                echo        '<a class="btn btn-success" href="descargar_archivo_comentario.php?no='.$IDCOMENTARIO.'">';
                echo          '<span class="glyphicon glyphicon-download"></span>';
                echo            'Descargar archivo';
                echo        '</a>';
                echo      '</div>';
                echo    '</div>';
                echo  '</div>';
              }  
              echo '</td>';
              echo "</tr>";

            }
            ?>
          </table>
      </div>
      <br>
      <div class="row " >
        <div class="col-sm-12">
          <div class="text-center">
              <button class="btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal">
              Nuevo Comentario
            </button>
          </div>
        </div>
        
      </div>
    </div>

  </div>
  </div>
</body>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <div class="row" style="width:100%;">
            <div class="col-md-10">
              <h4 class="modal-title" id="exampleModalLabel">Agregar comentario</h4>
            </div>
            <div class="col-md-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
          </div>
        </div>

        <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'].'?no='.$IDFORO.''); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="inputComentario" style="all: unset;">Comentario:</label>
              
              <textarea type="text" class="form-control" rows="3"  id="inputComentario" name="inputComentario" placeholder="Escriba su comentario.."></textarea>
              
            </div>
            <div class="form-group">
              <label for="inputArchivo" style="all: unset;">Agregar archivo: (opcional)</label>
              <input type="file" class="form-control" id="inputArchivo" name="inputArchivo" >
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Enviar comentario</button>
        </form>
        </div>

        <div class="modal-footer">
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
          <input class="btn btn-secondary" id='clear' name='clear' data-dismiss="modal" value="Cancelar">
        </form>
        </div>

    </div>
  </div>
</div>

<!-- Modal respuesta -->
<div class="modal fade" id="respuestaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

        <div class="modal-header">
          <div class="row" style="width:100%;">
            <div class="col-md-10">
              <h4 class="modal-title" id="exampleModalLabel">Agregar comentario</h4>
            </div>
            <div class="col-md-2">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
          </div>
        </div>

        <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'].'?no='.$IDFORO.''); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="inputComentario" style="all: unset;">Comentario:</label>
              <?php 
              echo '<textarea type="text" class="form-control" rows="3"  id="inputComentario" name="inputComentario" placeholder="Escriba su comentario..">';
              echo 'En respuesta a: "'.$CONTENIDO.' ('.$NOMBREAUTORCOMENTARIO .')" ';
              echo '</textarea>';
              ?>
            </div>
            <div class="form-group">
              <label for="inputArchivo" style="all: unset;">Agregar archivo: (opcional)</label>
              <input type="file" class="form-control" id="inputArchivo" name="inputArchivo" >
            </div>
            <button class="btn btn-primary" type="submit" name="submit">Enviar comentario</button>
        </form>
        </div>

        <div class="modal-footer">
        <form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
          <input class="btn btn-secondary" id='clear' name='clear' data-dismiss="modal" value="Cancelar">
        </form>
        </div>

    </div>
  </div>
</div>

</html>