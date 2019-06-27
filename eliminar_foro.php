
<?php session_start(); // iniciar sesión
if(!isset($_SESSION['usuario'])){ // Si en la sesion coincide con el usuario, nos redirige al index.php
  header('Location: index.php');
}
	require 'conexion.php';
	$id=(integer)$_GET['no']; // obtener el id del foro


	$statement = $conexion->query("DELETE FROM foro WHERE IDFORO = $id"); // eliminar de la base de datos 
	header('Location: foro.php'); // redirige a la página de foro.php
?>