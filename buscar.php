<?php session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
}
require "conexion.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require "head.php";
  ?>
</head>


<body id="fondonuevorepositorio">
  <div class="containerRepositorioNuevo">
   
   <form action="repositorio.php" method="post"> 

    <div class="form-group">
      <label for="inputAutor">Autor</label>
      <input type="text" class="form-control" id="inputAutor" name="autor" placeholder="ingrese autor">
    </div>
    <div class="form-group">
      <label for="inputAño">año</label>
      <input type="date" class="form-control" name="fecha" id="inputAño">
    </div>
    <div class="form-group">
      <label for="materia">Materia</label>
      <select class="form-control" id="materia" name="materia">
        <option value="">elija una opcion</option>
        <?php
        $statement = $conexion->prepare('SELECT IDMATERIA, NOMBREMATERIA FROM materia');
        $statement->execute();
        $resultado = $statement->fetchAll();
        foreach ($resultado as $id) {
          $IDMATERIA = $id["IDMATERIA"];
          $NOMBREMATERIA = $id["NOMBREMATERIA"];
          echo "<option value=$IDMATERIA>$NOMBREMATERIA</option>";
        }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label for="inputClave">Palabras clave</label>
      <input type="text" class="form-control" id="inputClave" name="clave" placeholder="ingrese Palabras clave">
    </div>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <button type="submit" class="btn btn-primary">Buscar</button>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="btn btn-danger" href="repositorio.php" role="button">Cancelar</a>
    
  </form>
</div>
</body>

</html>