<?php session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
}
	require 'conexion.php';
	$IDFORO=$_GET['idforo'];
	$IDUSUARIO=$_GET['idusuario'];
	$NOMBRECOMPLETO=$_GET['nombrecompleto'];
    $comentario=$_GET['comentario']
    
        if (!empty($comentario)) {
          $comentario = trim($comentario);
      
        } else {
          $errores .= 'ingrese el comentario <br />';
        }
      
        if (empty($errores)) {
          
          
          try {
            $timezone  = -5; //(GMT -5:00) 
            $fecha= gmdate("Y/m/j H:i:s", time() + 3600*($timezone)); 
                  $statement = $conexion->query("INSERT INTO comentario_foro (IDFORO,IDUSUARIO,NOMBREAUTORCOMENTARIO,CONTENIDO,FECHA) VALUES ('$IDFORO','$IDUSUARIO',$NOMBRECOMPLETO,'$comentario','$fecha')");
                  header('Location: verForo.php?no='.$IDFORO.'');
              } catch (Exception $e) {
                  echo "error: " . $e->getMessage();
                  
          }
          
        }
      
?>