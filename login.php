<?php session_start();
if(isset($_SESSION['usuario'])){
  header('Location: repositorio.php');
}
require "conexion.php";
$statement = $conexion->prepare('SELECT * FROM usuario WHERE USER LIKE :user and TIPOUSUARIO LIKE :type'); 
$errores = '';

if(isset($_POST['submit'])){
  $usuario = $_POST['inputUser'];
  $password = $_POST['inputPW'];
  $tipo = $_POST['userType'];
  $administrador = 'admin';
  $estadoactivo = 'activo';


  if (!empty($usuario)) {
    $usuario = trim($usuario);
  } else {
    $errores .= 'Ingrese un usuario <br />';
  }

  if (!empty($password)) {
    $password = trim($password);
  } else {
    $errores .= 'Ingrese una contraseña';
  }

  if(empty($errores)){
    $statement->execute(array(':user' => $usuario, ':type' => $tipo));
    $resultado = $statement->fetchAll();
    if (empty($resultado)) {
      $errores .='Usuario o contraseña incorrectas';
    }else{
      foreach ($resultado as $user) {
        $pass = $user["PASSWORD"];
        $cedula = $user["CEDULAUSUARIO"];
        $estado = $user["ESTADOUSUARIO"];
        
      }
      if(strcmp ($estado , $estadoactivo ) == 0){

      if(strcmp ($pass , $password ) == 0){
        $_SESSION['usuario']=$usuario;
        $cedula = substr($cedula, -4);
        if(strcmp ($cedula , $password ) == 0){
          header('Location: cambiarPassword.php');
        }else if(strcmp ($usuario, $administrador)==0){
          
            header('Location: Administrador.php');
          }else{
            header('Location: repositorio.php');
          }
          

        
      }else{
        $errores .='Usuario o contraseña incorrectas';
      }
      }else {
        $errores .='Usuario bloqueado';
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

<body id="fondologin">
  <div class="containerLogininicio">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <select class="form-control" id="userType" name="userType">
          <option value="admin">Administrador</option>
          <option value="profesor">Profesor</option>
          <option value="estudiante">Estudiante</option>
        </select>
      </div>
      <div class="form-group">
        <br>
        <label for="inputUser" class="usuarioLogin">Usuario</label>
        <input class="form-control" id="inputUser" name="inputUser" type="text" placeholder="Ingresar Usuario">
      </div>
      <div class="form-group">
        <br>
        <label for="inputPW" class="usuarioLogin">Contraseña</label>
        <input class="form-control" id="inputPW" name="inputPW" type="password" placeholder="Ingresar Contraseña">
      </div>

      <?php if(!empty($errores)): ?>

          <div class="alert-error">
            <?php echo $errores; ?>
          </div>
        <?php endif ?>
      
      <br>
      <br>
      <div class="containerLogininicio2">
        <input type="submit" class="btn btn-success btn-block" name="submit" value="Iniciar Sesion">
        <br>
        <a class="btn btn-danger btn-block" href="index.php">Cancelar</a>

      </form>

    </div>
  </div>
</body>

</html>