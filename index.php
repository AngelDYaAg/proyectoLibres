<?php session_start(); // Iniciar sesion 
if (isset($_SESSION['usuario'])) { // Si en la sesion coincide con el usuario, nos redirige al repositorio.php
  header('Location: repositorio.php');
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

<body id="fondoindex">
  <!-- cuerpo de la pagina de index.php -->
  <div id="imagen" class="container">
    <!-- contenedor de la página de index.php -->
    <img id="estirada" src="EPN.png" /> <!-- Imagen de la EPN -->

    <br>
    <br>

  </div>

  <div class="container">
    <!-- contendero de la pagina de index -->
    <div class="card card-login mx-auto mt-5">
      <h1 class="text-center"><b>CENTRO DE APRENDIZAJE COLABORATIVO – EPN</b></h1> <!-- Alinear al centro el título 1 de la página -->


      <br>
      <p class="texto"   align="justify"> Este proyecto tiene como finalidad crear una aplicación web que agrupe a recursos didácticos     de varios tipos: objetos de aprendizaje, archivos y librerías de software, documentos en .pdf, presentaciones,  gráficos, etc... organizados por  carreras  y  por materias, al que estudiantes y profesores puedan acceder como fuente de consulta y para intercambiar información.</p> <!-- Párrafo sobre la información de la página -->

    </div>
  </div>
  

  <div class="containerinicio">  
    <!-- Contenedor para los botones de la página -->
    <div class="card-body"  >
      <div class="text-center"> <!-- Alineación del texto centrado -->
        <br>
        <a class="btn btn-success btn-block" href="login.php">Iniciar Sesion</a> <!-- Boton de Iniciar sesión -->
        <br>
        <a class="btn btn-primary btn-block" href="registrar.php">Registrarse</a> <!-- Boton de Registrarse -->
      </div>
    </div> <!-- cerrar contenedor de los botones -->
  </div>  <!-- cerrar contenedor principal -->

</body> <!-- cerrar cuerpo de la página -->

</html>