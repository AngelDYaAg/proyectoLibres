<?php
$errores = '';
$noPermitidos = "0123456789";

if(isset($_POST['submit'])){
  $cedula = $_POST['inputCedula'];
  $nombres = $_POST['inputNombres'];
  $apellidos = $_POST['inputApellidos'];
  $tipo = $_POST['userType'];

  if (!empty($cedula)) {
    $cedula = trim($cedula);
    if(!is_numeric($cedula)) {
      $errores .= 'solo se permiten numeros en la cedula <br />';
    } 
  } else {
    $errores .= 'ingrese su numero de cedula <br />';
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
    $errores .= 'ingrese los nombres <br />';
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
    $errores .= 'ingrese los apellidos';
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
          <option value="prof">Profesor</option>
          <option value="est">Estudiante</option>
        </select>
      </div>
      <?php if(!empty($errores)): ?>
        <div class="alert error">
          <?php echo $errores; ?>
        </div>
      <?php endif ?>
      <input class="btn btn-primary btn-block" type="submit" name="submit" value="Registrarse">
      <a class="btn btn-danger btn-block" href="index.php">Cancelar</a>
    </form>
  </div>
</body>

</html>