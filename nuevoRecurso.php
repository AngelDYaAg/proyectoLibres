<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: index.php');
}
require "conexion.php";
$errores = '';

$user=$_SESSION['usuario'];

if(isset($_POST['submit'])){
	$IDREPOSITORIO;
	$IDUSUARIO;
	$IDCALIFICACION='NULL';
	$IDMATERIA=(integer)$_POST['materia'];
	$NOMBRERECURSO=$_POST['nombre'];
	$DESCRIPCIONRECURSO=$_POST['descripcion'];
	$TIPORECURSO=$_POST['tipo'];
	$AUTORRECURSO=$_POST['autor'];
	$INSTAUTORRECURSO=$_POST['institucion'];
	$FECHACREACIONRECURSO=$_POST['fecha'];
	$PALABRASCLAVERECURSO=$_POST['palabras'];
	$ESTADORECURSO='privado';
	$RUTARECURSO;
	$LINKRECURSO;
	$TIPOARCHIVO;
	$SIZERECURSO;

	if (!empty($NOMBRERECURSO)) {
		$NOMBRERECURSO = trim($NOMBRERECURSO);
	} else {
		$errores .= 'ingrese el nombre del recurso <br />';
	}

	if (!empty($DESCRIPCIONRECURSO)) {
		$DESCRIPCIONRECURSO = trim($DESCRIPCIONRECURSO);
	} else {
		$errores .= 'ingrese la descripcion del recurso <br />';
	}

	if (!empty($TIPORECURSO)) {
		$TIPORECURSO = trim($TIPORECURSO);
	} else {
		$errores .= 'ingrese el tipo del recurso <br />';
	}

	if (!empty($AUTORRECURSO)) {
		$AUTORRECURSO = trim($AUTORRECURSO);
	} else {
		$errores .= 'ingrese el autor del recurso <br />';
	}

	if (!empty($INSTAUTORRECURSO)) {
		$INSTAUTORRECURSO = trim($INSTAUTORRECURSO);
	} else {
		$errores .= 'ingrese la institucion del autor del recurso <br />';
	}

	if (!empty($FECHACREACIONRECURSO)) {
		$FECHACREACIONRECURSO = trim($FECHACREACIONRECURSO);
	} else {
		$errores .= 'ingrese la fecha de creacion del recurso <br />';
	}

	if (!empty($PALABRASCLAVERECURSO)) {
		$PALABRASCLAVERECURSO = trim($PALABRASCLAVERECURSO);
	} else {
		$errores .= 'ingrese las palabras clave del recurso <br />';
	}


	if (empty($errores)) {
		$statement = $conexion->prepare('SELECT COUNT(IDREPOSITORIO) AS id  FROM recurso');
		$statement->execute();
		$resultado = $statement->fetchAll();
		foreach ($resultado as $id) {
			$IDREPOSITORIO = (integer)$id["id"];
		}
		$IDREPOSITORIO ++;

		$statement = $conexion->prepare('SELECT IDUSUARIO, RUTAUSUARIO FROM usuario WHERE USER LIKE :user');
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

		$IDREPOSITORIO =(integer)$IDREPOSITORIO;
		$IDUSUARIO=(integer)$IDUSUARIO;
		$IDMATERIA=(integer)$IDMATERIA;
		$SIZERECURSO=(integer)$SIZERECURSO;

		try {
			$statement = $conexion->query("INSERT INTO recurso VALUES ($IDREPOSITORIO,$IDUSUARIO,$IDCALIFICACION,$IDMATERIA,'$NOMBRERECURSO','$DESCRIPCIONRECURSO','$TIPORECURSO','$AUTORRECURSO','$INSTAUTORRECURSO','$FECHACREACIONRECURSO','$PALABRASCLAVERECURSO',
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
	require "head.php";
	?>
</head>

<body>
	<div class="container">
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
				<label for="palabras">palabras claves</label>
				<input class="form-control" id="palabras" name="palabras" type="text" placeholder="Ingresar palabras">
			</div>
			<div class="form-group">
				<label for="fecha">fecha de creacion</label>
				<input type="date" class="form-control" id="fecha" name="fecha">
			</div>
			<div class="form-group">
				<label for="tipo">tipo de recurso</label>
				<select class="form-control" id="tipo" name="tipo">
					<option value="archivo">archivo</option>
					<option value="link">link</option>
				</select>
			</div>
			<div class="form-group">
				<label for="materia">materia</label>
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
				<input class="form-control" id="inputArchivo" name="inputArchivo" type="file">
			</div>
			<div class="form-group">
				<input class="form-control" id="inputLink" name="inputLink" type="text" placeholder="Ingresar link">
			</div>
			<?php if(!empty($errores)): ?>
				<div class="alert error">
					<?php echo $errores; ?>
				</div>
			<?php endif ?>
			<input class="btn btn-primary btn-block" type="submit" name="submit" value="Crear">
			<a class="btn btn-danger btn-block" href="index.php">Cancelar</a>
		</form>
	</div>
</body>

</html>

