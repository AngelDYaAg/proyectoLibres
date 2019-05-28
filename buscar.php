<?php session_start();
if(!isset($_SESSION['usuario'])){
  header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require "head.php";
  ?>
</head>

<body class="bg-dark">
  <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="inputAutor">Autor</label>
        <input type="text" class="form-control" id="inputAutor" placeholder="ingrese autor">
      </div>
      <div class="form-group">
        <label for="inputAño">año</label>
        <input type="date" class="form-control" id="inputAño">
      </div>
      <div class="form-group">
        <label for="materia">Materia</label>
        <select class="form-control" id="materia" name="materia">
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
        <input type="text" class="form-control" id="inputClave" placeholder="ingrese Palabras clave">
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <a class="btn btn-danger" href="repositorio.php" role="button">Cancelar</a>
      
    </form>
  </div>
</body>

</html>