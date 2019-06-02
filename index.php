<?php session_start();
if (isset($_SESSION['usuario'])) {
  header('Location: repositorio.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require "head.php";

  ?>
</head>

<body id="fondoindex">

  <div id="imagen" class="container">
    <img id="estirada" src="EPN.png" />

    <br>
    <br>

  </div>

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <h1 class="text-center"><b>CENTRO DE APRENDIZAJE COLABORATIVO – EPN</b></h1>


      <br>
      <p class="texto"   align="justify"> Este proyecto tiene como finalidad crear una aplicación web que agrupe a recursos didácticos     de varios tipos: objetos de aprendizaje, archivos y librerías de software, documentos en .pdf, presentaciones,  gráficos, etc... organizados por  carreras  y  por materias, al que estudiantes y profesores puedan acceder como fuente de consulta y para intercambiar información.</p>

    </div>
</div>
  

  <div class="containerinicio">  
    <div class="card-body"  >
      <div class="text-center">
        <br>
        <a class="btn btn-success btn-block" href="login.php">Iniciar Sesion</a>
        <br>
        <a class="btn btn-primary btn-block" href="registrar.php">Registrarse</a>
      </div>
    </div>
  </div> 

</body>

</html>