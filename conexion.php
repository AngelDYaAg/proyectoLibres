<?php
  $server = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'proyecto';
  try 
  {
    $conexion = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
  } catch (PDOException $e)
  {
    die('Conexión fallida con la base de datos <br>Error:<br>' . $e->getmessage());
  }
?>




