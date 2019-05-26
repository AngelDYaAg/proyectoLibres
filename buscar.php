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
    <form>
      <div class="form-group">
        <label for="inputAutor">Autor</label>
        <input type="text" class="form-control" id="inputAutor" placeholder="ingrese autor">
      </div>
      <div class="form-group">
        <label for="inputAño">año</label>
        <input type="date" class="form-control" id="inputAño">
      </div>
      <div class="form-group">
        <label for="inputMateria">Materia</label>
        <select class="form-control" id="inputMateria" name="inputMateria">
          <option value="admin"></option>
          <option value="prof">Profesor</option>
          <option value="est">Estudiante</option>
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