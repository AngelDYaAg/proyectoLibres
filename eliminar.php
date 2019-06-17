<?php session_start(); // iniciar sesión
if(!isset($_SESSION['usuario'])){ // Si en la sesion coincide con el usuario, nos redirige al index.php
  header('Location: index.php');
}
	require 'conexion.php';
	$id=(integer)$_GET['no']; // obtener el id del recurso

	$statement = $conexion->query("SELECT RUTARECURSO FROM recurso WHERE IDREPOSITORIO = $id"); // buscar el id del recurso en la base de datos
	foreach ($statement as $key) {
		unlink($key['RUTARECURSO']); // eliminar el recurso
	}
	$statement = $conexion->query("DELETE FROM recurso WHERE IDREPOSITORIO = $id"); // eliminar de la base de datos del recurso
	header('Location: repositorio.php'); // redirige a la página de repositorio.php
?>