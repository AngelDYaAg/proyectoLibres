<?php session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
}
	require 'conexion.php';
	$id=(integer)$_GET['idpublicar'];

	$statement = $conexion->query("UPDATE recurso SET ESTADORECURSO='publico' WHERE IDREPOSITORIO = $id");
	header('Location: repositorio.php');
?>