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
      $fecha=date('Y-m-d');
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
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio personal</a><!-- entrada del boton Repositorio personal  -->
        <br>
        <br>
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio publico</a><!-- entrada del boton Repositorio publico  -->
        <br>
        <br>
        <a class="btn btn-primary" href="foro.php" role="button">Foro</a><!-- entrada del boton Foro  -->
      </div>


      <div class="col-sm-9">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"><!--enviar parametros por Post-->
          <div class="form-group">
            <label for="inputNombre">Nombre</label><!-- label Nombre -->
            <input type="text" class="form-control" id="inputNombre" name="inputNombre" placeholder="ingrese nombre"><!-- entrada del label Nombre -->
          </div>
          <div class="form-group">
            <label for="inputDescripcion">Descripcion</label><!-- label descripcion -->
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