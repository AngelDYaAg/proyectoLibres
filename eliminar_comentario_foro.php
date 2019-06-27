
<?php session_start(); // iniciar sesión
if(!isset($_SESSION['usuario'])){ // Si en la sesion coincide con el usuario, nos redirige al index.php
  header('Location: index.php');
}
	require 'conexion.php';
    $idForo=(integer)$_GET['idForo']; // obtener el id del foro
    $idComentario=(integer)$_GET['idComentario'];


	$statement = $conexion->query("DELETE FROM comentario_foro WHERE IDCOMENTARIO = $idComentario"); // eliminar de la base de datos 
	header('Location: verForo.php?no='.$idForo.''); // redirige a la página de foro.php
?>