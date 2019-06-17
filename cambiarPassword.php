<?php session_start(); // Iniciar sesión
if(!isset($_SESSION['usuario'])){ // Si en la sesion no coincide con el usuario, nos redirie al index.php
  header('Location: index.php');
}

$user = $_SESSION['usuario']; // guardamos en la variable user al usuario
require "conexion.php"; // conexión con la BD
$statement = $conexion->prepare('SELECT IDUSUARIO AS id FROM usuario WHERE USER LIKE :user');  // Buscamos en la BD al usuario
$errores = ''; // mensaje de errores

if(isset($_POST['submit'])){ // enviamos las nueva contraseña con el metodo POST a la base de datos
  $password = $_POST['inputPW']; // nueva contraseña
  $password1 = $_POST['inputPW1']; // confirmar nueva contraseña

  if (!empty($password)) { // Si la contraseña esta vacia imprime un mensaje de error
    $password = trim($password);
  } else {
    $errores .= 'Ingrese una contraseña <br />'; // mensaje de error
  }

  if (!empty($password1)) { // si esta vacio el confirmar la nueva contraseña muestra un mensaje de error
    $password1 = trim($password1);
  } else {
    $errores .= 'Ingrese una contraseña'; // mensaje de error
  }

  if(empty($errores)){ // si no hay errores
    $statement->execute(array(':user' => $user)); // busca al usuario
    $resultado = $statement->fetchAll();
    if (empty($resultado)) { // verifica que exista el usuario
      $errores .='No existe el usuario'; //mensaje de error
    }else{
      foreach ($resultado as $user) { 
        $id = (integer)$user["id"]; // busca a todos los usuario y cuando coincida nos extrae el id
      }
      if(strcmp ($password1 , $password ) == 0){
        $statement = $conexion->prepare('UPDATE usuario SET PASSWORD=:pass WHERE IDUSUARIO=:id'); // actualiza la contraseña del usuario en la base de datos USUARIO
        $statement->execute(array(':pass' => $password, ':id'=>$id)); //ejecuta la contraseña y el id del usuario
        header('Location: repositorio.php'); // redirige a la página de repositorio
      }else{
        $errores .='Las contraseñas no coinciden'; // mensaje de error si las contraseña nos coinciden
      }
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- cabecera de la página -->
  <?php
  require "head.php";
  ?>
</head>

<body id="fondonuevorepositorio">
  <!-- cuerpo de la página -->
  <div class="containerLogininicio">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"> <!-- metodo post del form -->
      <div class="form-group">
        <h1 align="center">Cambio de Contraseña</h1> <!-- titulo principal -->
      </div>
      <br>
      <div class="form-group">
        <label for="inputPW">Nueva contraseña</label> <!--etiqueta de nueva contraseña -->
        <input class="form-control" id="inputPW" name="inputPW" type="password" placeholder="Ingresar Contraseña"> <!-- entrada para la entrada de ingresar contraseña -->
      </div>
      <div class="form-group">
        <label for="inputPW">Repita la contraseña</label>  <!--etiqueta de repita contraseña -->
        <input class="form-control" id="inputPW1" name="inputPW1" type="password" placeholder="Repetir Contraseña"> <!-- entrada para la entrada de confirmar contraseña -->
      </div>

      <?php if(!empty($errores)): ?> <!-- mensaje de error -->
        <div class="alert-error">
          <?php echo $errores; ?>
        </div>
      <?php endif ?>
      <br>
      <div class="containerLogininicio2">
      <input type="submit" class="btn btn-success btn-block" name="submit" value="Cambiar Contraseña"> <!-- boton de cambiar contraseña -->
      </div>
    </form>
  </div> <!-- cerrar contenedor -->
</body> <!-- cerrar cuerpo de la página -->

</html>