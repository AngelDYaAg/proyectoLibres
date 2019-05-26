<?php session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
}

$user = $_SESSION['usuario'];
require "conexion.php";
$statement = $conexion->prepare('SELECT IDUSUARIO AS id FROM usuario WHERE USER LIKE :user'); 
$errores = '';

if(isset($_POST['submit'])){
  $password = $_POST['inputPW'];
  $password1 = $_POST['inputPW1'];

  if (!empty($password)) {
    $password = trim($password);
  } else {
    $errores .= 'ingrese una contraseña <br />';
  }

  if (!empty($password1)) {
    $password1 = trim($password1);
  } else {
    $errores .= 'ingrese una contraseña';
  }

  if(empty($errores)){
    $statement->execute(array(':user' => $user));
    $resultado = $statement->fetchAll();
    if (empty($resultado)) {
      $errores .='no existe el usuario';
    }else{
      foreach ($resultado as $user) {
        $id = (integer)$user["id"];
      }
      if(strcmp ($password1 , $password ) == 0){
        $statement = $conexion->prepare('UPDATE usuario SET PASSWORD=:pass WHERE IDUSUARIO=:id');
        $statement->execute(array(':pass' => $password, ':id'=>$id));
        header('Location: repositorio.php');
      }else{
        $errores .='las contraseñas no coinciden';
      }
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require "head.php";
  ?>
</head>

<body>
  <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <h1>cambio de Contraseña</h1>
      </div>
      <div class="form-group">
        <label for="inputPW">Nueva contraseña</label>
        <input class="form-control" id="inputPW" name="inputPW" type="password" placeholder="Ingresar Contraseña">
      </div>
      <div class="form-group">
        <label for="inputPW">Repita la contraseña</label>
        <input class="form-control" id="inputPW1" name="inputPW1" type="password" placeholder="Repetir Contraseña">
      </div>

      <?php if(!empty($errores)): ?>
      <div class="alert error">
        <?php echo $errores; ?>
      </div>
      <?php endif ?>

      <input type="submit" class="btn btn-success btn-block" name="submit" value="Cambiar Contraseña">
    </form>
  </div>
</body>

</html>