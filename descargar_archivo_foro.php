<?php session_start(); // iniciar sesión
if(!isset($_SESSION['usuario'])){ // Si en la sesion coincide con el usuario, nos redirige al repositorio.php
	header('Location: index.php');
}
require 'conexion.php'; // conexión con la base de datos
$IDFORO=(integer)$_GET['no'];

$statement = $conexion->query("SELECT ARCHIVORUTA,TIPOARCHIVO FROM foro WHERE IDFORO = $IDFORO"); // busca el id de la ruta y tipo de archivo
foreach ($statement as $key) { // buscar el id
	$ruta=$key['ARCHIVORUTA']; // guardar la ruta del recurso en la varibale de ruta
	$tipo=$key['TIPOARCHIVO']; // guardar el tipo de archivo en la variable de tipo
}
$nombre=substr($ruta,strripos($ruta,"/")+1); // separar al primer / mas un caracter
$fileName = basename($nombre); // obtener el nombre del archivo

$filePath = $ruta;
if(!empty($fileName) && file_exists($filePath)){ // si existe el archivo descarga el archivo
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=$fileName");
	header("Content-Type: $tipo");
	header("Content-Transfer-Encoding: binary");
	readfile($filePath);
	exit;
}else{ 
	echo 'The file does not exist.'; // si no existe nos muestra un mensaje de error 
}

header('Location: verForo.php?no='.$IDFORO.''); // nos redirige a la página del foro
?>