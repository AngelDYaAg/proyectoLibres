<?php session_start(); // iniciar sesion

session_destroy(); // cerrar sesion
$_SESSION = array();

header('Location: index.php'); // redirigir a la página de index.php

 ?>