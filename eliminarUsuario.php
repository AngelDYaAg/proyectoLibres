<?php session_start(); // iniciar sesión
if(!isset($_SESSION['usuario'])){ // Si en la sesion coincide con el usuario, nos redirige al index.php
  header('Location: index.php');
}
	require 'conexion.php';
	$id=(integer)$_GET['no']; // obtener el id del recurso

	$statement = $conexion->query("SELECT RUTARECURSO FROM recurso WHERE IDUSUARIO = $id"); // buscar el id del recurso en la base de datos
	foreach ($statement as $key) {
		unlink($key['RUTARECURSO']); // eliminar el recurso
	}
	$statement = $conexion->query("DELETE FROM recurso WHERE IDUSUARIO = $id"); // eliminar de la base de datos del recurso
	$statement = $conexion->query("DELETE FROM comentario_foro WHERE IDUSUARIO = $id");
	$statement = $conexion->query("DELETE FROM foro WHERE IDAUTORFORO = $id");
	$statement = $conexion->query("DELETE FROM usuario WHERE IDUSUARIO = $id");
	header('Location: usuarios.php'); // redirige a la página de repositorio.php
?>