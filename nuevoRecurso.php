<?php session_start();// Iniciar sesion 
if(!isset($_SESSION['usuario'])){// Si en la sesion no coincide con el usuario, nos redirige al index.php
	header('Location: index.php');
}
require "conexion.php";
$errores = '';

$user=$_SESSION['usuario'];

if(isset($_POST['submit'])){//verificar informacion enviada por POST
	$IDUSUARIO;
	$IDCALIFICACION='NULL';
	$IDMATERIA=(integer)$_POST['materia'];//recibe informacion de materia
	$NOMBRERECURSO=$_POST['nombre'];//recibe informacion de nombre
	$DESCRIPCIONRECURSO=$_POST['descripcion'];//recibe informacion de descripcion
	$TIPORECURSO=$_POST['tipo'];//recibe informacion de tipo
	$AUTORRECURSO=$_POST['autor'];//recibe informacion de autor
	$INSTAUTORRECURSO=$_POST['institucion'];//recibe informacion de institucion
	$FECHACREACIONRECURSO=$_POST['fecha'];//recibe informacion de fecha
	$PALABRASCLAVERECURSO=$_POST['palabras'];//recibe informacion de palabras
	$ESTADORECURSO='privado';
	$RUTARECURSO;
	$LINKRECURSO;
	$TIPOARCHIVO;
	$SIZERECURSO;

	if (!empty($NOMBRERECURSO)) {//verifica que exista el parametro nombre del recurso
		$NOMBRERECURSO = trim($NOMBRERECURSO);//elimina espacios al principio y al final del nombre del recurso
	} else {
		$errores .= 'ingrese el nombre del recurso <br />';
	}

	if (!empty($DESCRIPCIONRECURSO)) {//verifica que exista el parametro de descripcion del recurso
		$DESCRIPCIONRECURSO = trim($DESCRIPCIONRECURSO);//elimina espacios al principio y al final de la descripcion del recurso
	} else {
		$errores .= 'ingrese la descripcion del recurso <br />';
	}

	if (!empty($TIPORECURSO)) {//verifica que exista el parametro tipo recurso
		$TIPORECURSO = trim($TIPORECURSO);//elimina espacios al principio y al final del tipo de recurso
	} else {
		$errores .= 'ingrese el tipo del recurso <br />';
	}

	if (!empty($AUTORRECURSO)) {//verifica que exista el parametro autor de recurso
		$AUTORRECURSO = trim($AUTORRECURSO);//elimina espacios al principio y al final del autor del recurso
	} else {
		$errores .= 'ingrese el autor del recurso <br />';
	}

	if (!empty($INSTAUTORRECURSO)) {//verifica que exista el parametro institucion del recurso
		$INSTAUTORRECURSO = trim($INSTAUTORRECURSO);//elimina espacios al principio y al final de la institucion del autor recurso
	} else {
		$errores .= 'ingrese la institucion del autor del recurso <br />';
	}

	if (!empty($FECHACREACIONRECURSO)) {//verifica que exista el parametro fecha de creacion de recurso
		$FECHACREACIONRECURSO = trim($FECHACREACIONRECURSO);//elimina espacios al principio y al final de la fecha de creacion del recurso
	} else {
		$errores .= 'ingrese la fecha de creacion del recurso <br />';
	}

	if (!empty($PALABRASCLAVERECURSO)) {//verifica que exista el parametro palabras claves del recurso
		$PALABRASCLAVERECURSO = trim($PALABRASCLAVERECURSO);//elimina espacios al principio y al final de las palabras claves
	} else {
		$errores .= 'ingrese las palabras clave del recurso <br />';
	}


	if (empty($errores)) {

		$statement = $conexion->prepare('SELECT IDUSUARIO, RUTAUSUARIO FROM usuario WHERE USER LIKE :user');//recuperar id y ruta del usuario actual
		$statement->execute(array(':user'=>$user));
		$resultado = $statement->fetchAll();
		foreach ($resultado as $id) {
			$IDUSUARIO = (integer)$id["IDUSUARIO"];
			$RUTAUSUARIO=$id["RUTAUSUARIO"];
		}

		if (strcmp ($TIPORECURSO , 'archivo' ) == 0) {
			$RUTAUSUARIO.='/';
			opendir($RUTAUSUARIO);
			$RUTARECURSO=$RUTAUSUARIO.$_FILES['inputArchivo']['name'];
			copy($_FILES['inputArchivo']['tmp_name'], $RUTARECURSO);
			$TIPOARCHIVO=$_FILES['inputArchivo']['type'];
			$SIZERECURSO=$_FILES['inputArchivo']['size'];
			$LINKRECURSO='NULL';
		}else{
			$LINKRECURSO=$_POST['inputLink'];
			$RUTARECURSO='NULL';
		}

		$IDUSUARIO=(integer)$IDUSUARIO;
		$IDMATERIA=(integer)$IDMATERIA;
		$SIZERECURSO=(integer)$SIZERECURSO;

		try {
			$statement = $conexion->query("INSERT INTO recurso (IDUSUARIO,IDCALIFICACION,IDMATERIA,NOMBRERECURSO,DESCRIPCIONRECURSO,TIPORECURSO,AUTORRECURSO,INSTAUTORRECURSO, FECHACREACIONRECURSO,PALABRASCLAVERECURSO,ESTADORECURSO,RUTARECURSO,LINKRECURSO,TIPOARCHIVO,SIZERECURSO) VALUES ($IDUSUARIO,$IDCALIFICACION,$IDMATERIA,'$NOMBRERECURSO','$DESCRIPCIONRECURSO','$TIPORECURSO','$AUTORRECURSO','$INSTAUTORRECURSO','$FECHACREACIONRECURSO','$PALABRASCLAVERECURSO',
				'$ESTADORECURSO','$RUTARECURSO','$LINKRECURSO','$TIPOARCHIVO',$SIZERECURSO)");

			header('Location: repositorio.php');
		} catch (Exception $e) {
			echo "error: " . $e->getMessage();
			
		}
		

	}

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<?php
  	require "cabecera.php";
	require "head.php";
	?>
</head>

<body id="fondonuevorepositorio">
	<div class="containerRepositorioNuevo">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input class="form-control" id="nombre" name="nombre" type="text" placeholder="Ingresar nombre">
			</div>
			<div class="form-group">
				<label for="descripcion">Descripcion</label>
				<textarea class="form-control" rows="5" id="descripcion" name="descripcion"></textarea>
			</div>
			<div class="form-group">
				<label for="autor">Autor</label>
				<input class="form-control" id="autor" name="autor" type="text" placeholder="Ingresar autor">
			</div>
			<div class="form-group">
				<label for="institucion">Institucion del autor</label>
				<input class="form-control" id="institucion" name="institucion" type="text" placeholder="Ingresar institucion">
			</div>
			<div class="form-group">
				<label for="palabras">Palabras claves</label>
				<input class="form-control" id="palabras" name="palabras" type="text" placeholder="Ingresar palabras">
			</div>
			<div class="form-group">
				<label for="fecha">Fecha de creación</label>
				<input type="date" class="form-control" id="fecha" name="fecha">
			</div>
			<div class="form-group">
				<label for="tipo">Tipo de recurso</label>
				<select class="form-control" id="tipo" name="tipo">
					<option value="archivo">Archivo</option>
					<option value="link">Link</option>
				</select>
			</div>
			<div class="form-group">
				<label for="materia">Materia</label>
				<select class="form-control" id="materia" name="materia">
					<?php
					$statement = $conexion->prepare('SELECT IDMATERIA, NOMBREMATERIA FROM materia');
					$statement->execute();
					$resultado = $statement->fetchAll();
					foreach ($resultado as $id) {
						$IDMATERIA = $id["IDMATERIA"];
						$NOMBREMATERIA = $id["NOMBREMATERIA"];
						echo "<option value=$IDMATERIA>$NOMBREMATERIA</option>";
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<input class="form-control" id="inputArchivo" name="inputArchivo" type="file" size=4>
			</div>
			<br>
			<div class="form-group">
				<input class="form-control" id="inputLink" name="inputLink" type="text" placeholder="Ingresar link">
			</div>

			<?php if(!empty($errores)): ?>
				<div class="alert-error2">
					<?php echo $errores; ?>
				</div>
			<?php endif ?>

			<div class="containerRepositorioNuevo2">
				<br>
			<input class="btn btn-primary btn-block" type="submit" name="submit" value="Crear">
			<br>
			<a class="btn btn-danger btn-block" href="index.php">Cancelar</a>
			</div>
		</form>
	</div>
</body>

</html>

