<?php session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
}
	require 'conexion.php';
	$id=(integer)$_GET['no'];

	$statement = $conexion->query("SELECT RUTARECURSO FROM recurso WHERE IDREPOSITORIO = $id");
	foreach ($statement as $key) {
		unlink($key['RUTARECURSO']);
	}
	$statement = $conexion->query("DELETE FROM recurso WHERE IDREPOSITORIO = $id");
	header('Location: repositorio.php');
?>