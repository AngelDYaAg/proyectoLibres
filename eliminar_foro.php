
<?php session_start(); // iniciar sesión
if(!isset($_SESSION['usuario'])){ // Si en la sesion coincide con el usuario, nos redirige al index.php
  header('Location: index.php');
}
	require 'conexion.php';
	$id=(integer)$_GET['no']; // obtener el id del recurso


	$statement = $conexion->query("DELETE FROM foro WHERE IDFORO = $id"); // eliminar de la base de datos del recurso
	header('Location: foro.php'); // redirige a la página de repositorio.php
?>