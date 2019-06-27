<?php session_start();// Iniciar sesion 
if(!isset($_SESSION['usuario'])){// Si en la sesion no coincide con el usuario, nos redirige al index.php
  header('Location: index.php');
}
require "conexion.php";
$errores = '';

$user=$_SESSION['usuario'];


if(isset($_POST['submit'])){//verificar informacion enviada por POST
	$IDUSUARIO;
  $nombre = $_POST['inputNombre'];//recibe informacion de nombre
  $descripcion = $_POST['inputDescripcion'];// recibe informacion de descripcion 

  if (!empty($nombre)) {//verifica que exista el parametro nobmre
    $nombre = trim($nombre);//elimina espacios al principio y al final del nombre
  } else {
    $errores .= 'ingrese el nombre del foro <br />';
  }
  if (!empty($descripcion)) {//verifica que exista el parametro descripcion
    $descripcion = trim($descripcion);//elimina espacios al principio y al final de descripcion
  } else {
    $errores .= 'ingrese la descripcion del foro';
  }

  if (empty($errores)) {
    $statement = $conexion->prepare('SELECT IDUSUARIO,NOMBRESUSUARIO,APELLIDOSUSUARIO FROM usuario WHERE USER LIKE :user');
    $statement->execute(array(':user'=>$user));
    $resultado = $statement->fetchAll();
    $NOMBRECOMPLETO='';
		foreach ($resultado as $id) {
      $IDUSUARIO = (integer)$id["IDUSUARIO"];
      $NOMBRECOMPLETO=$id["NOMBRESUSUARIO"] ." ". $id["APELLIDOSUSUARIO"];

    }
    
    try {
      $timezone  = -5; //(GMT -5:00) 
      $fecha= gmdate("Y/m/j H:i:s", time() + 3600*($timezone)); 
			$statement = $conexion->query("INSERT INTO foro (NOMBREFORO,DESCRIPCIONFORO,IDAUTORFORO,NOMBREAUTORFORO,FECHA) VALUES ('$nombre','$descripcion',$IDUSUARIO,'$NOMBRECOMPLETO','$fecha')");
			header('Location: foro.php');
		} catch (Exception $e) {
			echo "error: " . $e->getMessage();
			
    }
    
  }
}
?>

<!DOCTYPE html>
<html lang="en">
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
    


      <div class="col-sm-9">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"><!--enviar parametros por Post-->
          <div class="form-group">
            <label for="inputNombre">Nombre del nuevo foro</label><!-- label Nombre -->
            <input type="text" class="form-control" id="inputNombre" name="inputNombre" placeholder="Nombre del foro..."><!-- entrada del label Nombre -->
          </div>
          <div class="form-group">
            <label for="inputDescripcion">Descripcion del foro</label><!-- label descripcion -->
            <textarea class="form-control" rows="5" id="inputDescripcion" name="inputDescripcion"></textarea><!-- entrada del label descripcion -->
          </div>
          <?php if(!empty($errores)): ?><!-- leer errores de nombre o descripcion -->
            <div class="alert error">
              <?php echo $errores; ?>
            </div>
          <?php endif ?>
          <div class="text-center">
            <button class="btn btn-primary btn-lg" type="submit" name="submit" value="Crear">Crear</button><!-- entrada del boton crear -->
          </div>
          <br>
          <div class="text-center">
            <a class="btn btn-danger btn-lg" href="foro.php" role="button">Cancelar</a><!-- entrada del boton cancelar -->
          </div>
        </form>       
      </div>

    
  </div>
</body>

</html>