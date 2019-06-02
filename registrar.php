<?php session_start();
if(isset($_SESSION['usuario'])){
  header('Location: repositorio.php');
}
require "conexion.php";
$errores = '';
$noPermitidos = "0123456789";

if(isset($_POST['submit'])){
  $cedula = $_POST['inputCedula'];
  $nombres = $_POST['inputNombres'];
  $apellidos = $_POST['inputApellidos'];
  $tipo = $_POST['userType'];
  $user = str_replace(' ', '', $nombres);
  $user .= str_replace(' ', '', $apellidos);
  $password = substr($cedula, -4);
  $carpeta = "archivos/$user";
  $estado = 'activo';

  if (!empty($cedula)) {
    $cedula = trim($cedula);
    if(!is_numeric($cedula)) {
      $errores .= 'solo se permiten numeros en la cedula <br />';
    } 
  } else {
    $errores .= 'Ingrese su numero de cedula <br />';
  }

  if (!empty($nombres)) {
    $nombres = trim($nombres);
    for ($i=0; $i<strlen($nombres); $i++){
      if (strpos($noPermitidos, substr($nombres,$i,1))){
        $errores .='solo se permiten letras en los nombres <br />';
        break;
      }
    } 
  } else {
    $errores .= 'Ingrese los nombres <br />';
  }
  if (!empty($apellidos)) {
    $apellidos = trim($apellidos);
    for ($i=0; $i<strlen($apellidos); $i++){
      if (strpos($noPermitidos, substr($apellidos,$i,1))){
        $errores .='solo se permiten letras en los apellidos <br />';
        break;
      }
    } 
  } else {
    $errores .= 'Ingrese los apellidos';
  }

  if (empty($errores)) {
    $statement = $conexion->prepare('SELECT * FROM usuario WHERE USER LIKE :user and TIPOUSUARIO LIKE :type');
    $statement->execute(array(':user' => $user, ':type' => $tipo));
    $resultado = $statement->fetchAll();
    if (empty($resultado)) {
      if (!is_dir($carpeta)) {
        mkdir($carpeta, 0777, true);
      }
      $statement = $conexion->prepare('SELECT COUNT(IDUSUARIO) AS id FROM usuario');
      $statement->execute();
      $resultado = $statement->fetchAll();
      foreach ($resultado as $id) {
        $idusuario = (integer)$id["id"];
      }
      $idusuario ++;
      $statement = $conexion->prepare('INSERT INTO usuario(IDUSUARIO, CEDULAUSUARIO, NOMBRESUSUARIO, APELLIDOSUSUARIO, TIPOUSUARIO, USER, PASSWORD, RUTAUSUARIO, ESTADOUSUARIO) VALUES (:idusuario,:cedula,:nombres,:apellidos,:tipo,:user,:password,:carpeta,:estado)');
      $statement->execute(array(':idusuario'=>$idusuario,':cedula'=>$cedula,':nombres'=>$nombres,':apellidos'=>$apellidos,':tipo'=>$tipo,':user'=>$user,':password'=>$password,':carpeta'=>$carpeta,':estado'=>$estado));

      $destinatario = 'angel_0930@hotmail.es';
      $asunto = 'credenciales P-DIRA';
      $carta = "Usuario: $user \n";
      $carta .= "Contraseña: $password";

      mail($destinatario, $asunto, $carta);
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

<body id="fondonuevorepositorio">
  <div class="containerLogininicio">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="inputCedula">Cedula</label>
        <input class="form-control" id="inputCedula" name="inputCedula" type="text" placeholder="Ingresar numero de cedula">
      </div>
      <div class="form-group">
        <label for="inputNombres">Nombres</label>
        <input class="form-control" id="inputNombres" name="inputNombres" type="text" placeholder="Ingresar nombres">
      </div>
      <div class="form-group">
        <label for="inputApellidos">Apellidos</label>
        <input class="form-control" id="inputApellidos" name="inputApellidos" type="text" placeholder="Ingresar apellidos">
      </div>
      <div class="form-group">
        <select class="form-control" id="userType" name="userType">
          <option value="profesor">Profesor</option>
          <option value="estudiante">Estudiante</option>
        </select>
      </div>
      <?php if(!empty($errores)): ?>
        <div class="alert-error">
          <?php echo $errores; ?>
        </div>
      <?php endif ?>
      <br>
      <div class="containerLogininicio2">
      <input class="btn btn-primary btn-block" type="submit" name="submit" value="Registrarse">
      <br>
      <a class="btn btn-danger btn-block" href="index.php">Cancelar</a>
      </div>
    </form>
  </div>
</body>

</html>