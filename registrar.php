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
    $statement = $conexion->query("SELECT CORREO FROM lista WHERE NOMBRES LIKE '$nombres' and APELLIDOS LIKE '$apellidos'");
    $resultadolista = $statement->fetchAll();
    foreach ($resultadolista as $mail) {
      if (!empty($mail)) {
      $CORREO = $mail["CORREO"];
      $statement = $conexion->prepare('SELECT * FROM usuario WHERE USER LIKE :user and TIPOUSUARIO LIKE :type');
      $statement->execute(array(':user' => $user, ':type' => $tipo));
      $resultado = $statement->fetchAll();
      if (empty($resultado)) {
        if (!is_dir($carpeta)) {
          mkdir($carpeta, 0777, true);
        }
        $statement = $conexion->prepare('INSERT INTO usuario(CEDULAUSUARIO, NOMBRESUSUARIO, APELLIDOSUSUARIO, TIPOUSUARIO, USER, PASSWORD, RUTAUSUARIO, ESTADOUSUARIO) VALUES (:cedula,:nombres,:apellidos,:tipo,:user,:password,:carpeta,:estado)');
        $statement->execute(array(':cedula'=>$cedula,':nombres'=>$nombres,':apellidos'=>$apellidos,':tipo'=>$tipo,':user'=>$user,':password'=>$password,':carpeta'=>$carpeta,':estado'=>$estado));

        $destinatario = $CORREO;
        $asunto = 'credenciales P-DIRA';
        $carta = "Usuario: $user \n";
        $carta .= "Contraseña: $password";

        mail($destinatario, $asunto, $carta);
        header('Location: index.php');
      }
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

<body id="fondonuevorepositorio">
  <div class="containerLogininicio">

  <div class="panel panel-primary">
    <div class="panel-heading">
                <div style="text-align:center">
                    <h1>REGISTRO</h1>
                </div>
      </div>
    <div class="panel-body">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="inputCedula" style="all: unset;">Cedula</label>
        <input class="form-control" id="inputCedula" name="inputCedula" type="text" placeholder="Ingresar numero de cedula">
      </div>
      <div class="form-group">
        <label for="inputNombres" style="all: unset;">Nombres</label>
        <input class="form-control" id="inputNombres" name="inputNombres" type="text" placeholder="Ingresar nombres">
      </div>
      <div class="form-group">
        <label for="inputApellidos" style="all: unset;">Apellidos</label>
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
  </div>
    
  </div>
</body>

</html>