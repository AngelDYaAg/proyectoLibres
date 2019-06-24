<?php session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
}
	require 'conexion.php';
	$id=(integer)$_GET['no'];

	$statement = $conexion->query("UPDATE usuario set ESTADOUSUARIO='activo' WHERE IDUSUARIO = $id");
	foreach ($statement as $key) {
		unlink($key['ESTADOUSUARIO']);
	}
	header('Location: usuarios.php');
?>