<?php session_start(); // Iniciar sesion 
if(!isset($_SESSION['usuario'])){ // Si en la sesion no coincide con el usuario, nos redirie al index.php
  header('Location: index.php');
}
require "conexion.php"; // conexión con la BD
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
  <!-- cuerpo del la página -->
  <div class="containerRepositorioNuevo">
   
   <form action="repositorio.php" method="post"> <!-- método POST de la página -->

    <div class="form-group">
      <label for="inputAutor">Autor</label> <!-- etiqueta de entrada para buscar por Autor -->
      <input type="text" class="form-control" id="inputAutor" name="autor" placeholder="ingrese autor"> <!-- formato del label Autor  -->
    </div>
    <div class="form-group">
      <label for="inputAño">año</label> <!-- etiqueta de entrada para buscar por Año -->
      <input type="date" class="form-control" name="fecha" id="inputAño"> <!-- formato del label Año  -->
    </div>
    <div class="form-group">
      <label for="materia">Materia</label> <!-- etiqueta de entrada para buscar por Materia -->
      <select class="form-control" id="materia" name="materia"> <!-- formato del label Materia  -->
        <option value="">elija una opcion</option> <!-- genera un combobox para seleccionar la materia -->
        <?php
        $statement = $conexion->prepare('SELECT IDMATERIA, NOMBREMATERIA FROM materia'); // Sentencia para buscar la materias y cargar al combobox
        $statement->execute();
        $resultado = $statement->fetchAll(); // Encontrar todas la materia
        foreach ($resultado as $id) { // buscar por cada ID su respectiva materia
          $IDMATERIA = $id["IDMATERIA"]; // la variable IDMATERIA sera igual al id de la base de datos de materia
          $NOMBREMATERIA = $id["NOMBREMATERIA"]; // la variable NOMBREMATERIA sera igual al nombre de la materia de la base de datos de materia
          echo "<option value=$IDMATERIA>$NOMBREMATERIA</option>"; // imprimir el nombre de la materia
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="inputClave">Palabras clave</label> <!-- etiqueta de entrada para buscar por Palabras clave -->
      <input type="text" class="form-control" id="inputClave" name="clave" placeholder="ingrese Palabras clave"> <!-- formato del label Palabras clave  -->
    </div>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="submit" class="btn btn-primary">Buscar</button> <!-- Boton de Buscar -->
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="btn btn-danger" href="repositorio.php" role="button">Cancelar</a> <!-- Boton de Cancelar -->
    
  </form>
</div> <!-- Cerrar contenedor -->
</body> <!-- cerrar cuerpo de la página -->

</html>