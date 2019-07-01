<?php 
  $server = 'localhost'; // servidor local
  $username = 'root'; // username de la base de datos
  $password = ''; // contraseña de la base de datos
  $database = 'proyecto'; // nombre de la base de datos
  try 
  {
    $conexion = new PDO("mysql:host=$server;dbname=$database;", $username, $password); // conexión con la base de datos segun el usuario y contraseña
  } catch (PDOException $e)
  {
    die('Conexión fallida con la base de datos <br>Error:<br>' . $e->getmessage()); // mensaje de error, de una conexión fallida con la base de datos
  }
?>




