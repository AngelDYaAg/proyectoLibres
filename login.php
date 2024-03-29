<?php session_start(); // Iniciar sesion 
/**
* @mainpage
* \n pagina principal en la cual se encuentra iniciar sesion
*
*/

/**
 *  A login class.
 */

if(isset($_SESSION['usuario'])){ 
  header('Location: repositorio.php');
}
require "conexion.php"; // COnexion con la base de datos del proyecto
$statement = $conexion->prepare('SELECT * FROM usuario WHERE USER LIKE :user and TIPOUSUARIO LIKE :type'); // Sentencia de buscar el tipo de usuario
$errores = ''; //errores mensaje

if(isset($_POST['submit'])){
  $usuario = $_POST['inputUser'];
  $password = $_POST['inputPW'];
  $tipo = $_POST['userType'];
  $administrador = 'admin';
  $estadoactivo = 'activo';


  if (!empty($usuario)) { 
    $usuario = trim($usuario); //verifica si el usuario esta vacio
  } else {
    $errores .= 'Ingrese un usuario <br />'; // mensaje de error
  }

  if (!empty($password)) {
    $password = trim($password); // verifica si esta password esta vacio
  } else {
    $errores .= 'Ingrese una contraseña'; //mensaje de error
  }

  if(empty($errores)){ //si no hay errores verifica el usuario y tipo
    $statement->execute(array(':user' => $usuario, ':type' => $tipo));
    $resultado = $statement->fetchAll(); //busca al usuario con las credenciales correctas
    if (empty($resultado)) {
      $errores .='Usuario o contraseña incorrectas'; // error si no coincide el user y su contraseña
    }else{
      foreach ($resultado as $user) { // realiza un busqueda por cada usuario
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
        $errores .='Usuario o contraseña incorrectas'; // mensaje de error si no coincide el usuario y contraseña
      }
      }else {
        $errores .='Usuario bloqueado';
      }
    }
  }
}
?>

<!--Estilo de la pestaña de login.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <!--Cabecera de la página -->
  <?php
  require "head.php"; 
  ?>
</head>

<body id="fondologin">
  <!--Cuerpo de la página -->
  <div class="containerLogininicio"> <!-- Contenedor de la página de login -->

  <div class="panel panel-primary">
    <div class="panel-heading">
                <div style="text-align:center">
                    <h1>INICIAR SESIÓN</h1>
                </div>
    </div>
    <div class="panel-body">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"> <!-- método POST -->
      <div class="form-group">
        <select class="form-control" id="userType" name="userType"> <!-- Genera un combobox con las opciones de Administrador, Profesor, Estudiante -->
          <option value="admin">Administrador</option>
          <option value="profesor">Profesor</option>
          <option value="estudiante">Estudiante</option>
        </select>
      </div>
      <div class="form-group">
        <br>
        <label for="inputUser" class="usuarioLogin" style="all: unset;">Usuario</label> <!-- Etiqueta de entrada para el texto de usuario -->
        <input class="form-control" id="inputUser" name="inputUser" type="text" placeholder="Ingresar Usuario"> <!-- Entrada del label de usuario -->
      </div>
      <div class="form-group">
        <br>
        <label for="inputPW" class="usuarioLogin" style="all: unset;">Contraseña</label> <!-- Etiqueta de entrada para el texto de password -->
        <input class="form-control" id="inputPW" name="inputPW" type="password" placeholder="Ingresar Contraseña"><!-- Entrada del label de password -->
      </div>

      <?php if(!empty($errores)): ?> <!-- Si existen errores mostrara un mensaje -->

      <div class="alert-error">
        <?php echo $errores; ?>
      </div>
    <?php endif ?>

    <br>
    <br>
    <div class="containerLogininicio2">
      <!-- Botones de login -->
      <input type="submit" class="btn btn-success btn-block" name="submit" value="Iniciar Sesion"> <!-- Boton iniciar sesion -->
      <br>
      <a class="btn btn-danger btn-block" href="index.php">Cancelar</a> <!-- Boton de Cancelar -->

    </form> <!-- Cerrar formulario -->
    </div>
  </div>
    

  </div>
</div> <!-- cerrar contenedor -->
</body> <!-- cerrar el cuerpo de la página -->

</html>