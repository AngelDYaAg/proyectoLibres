<?php session_start();
if(!isset($_SESSION['usuario'])){
	header('Location: index.php');
}
require 'conexion.php';
$id=(integer)$_GET['iddescargar'];

$statement = $conexion->query("SELECT RUTARECURSO,TIPOARCHIVO FROM recurso WHERE IDREPOSITORIO = $id");
foreach ($statement as $key) {
	$ruta=$key['RUTARECURSO'];
	$tipo=$key['TIPOARCHIVO'];
}
$nombre=substr($ruta,strripos($ruta,"/")+1);
$fileName = basename($nombre);
$filePath = $ruta;
if(!empty($fileName) && file_exists($filePath)){
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=$fileName");
	header("Content-Type: $tipo");
	header("Content-Transfer-Encoding: binary");
	readfile($filePath);
	exit;
}else{
	echo 'The file does not exist.';
}

header('Location: repositorio.php');
?>