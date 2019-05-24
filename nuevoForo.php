<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  require "head.php";
  ?>
</head>

<body class="bg-dark">
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio personal</a>
        <br>
        <a class="btn btn-primary" href="repositorio.php" role="button">Repositorio publico</a>
        <br>
        <a class="btn btn-primary" href="foro.php" role="button">Foro</a>
      </div>
      <div class="col-sm-8">
        <form>
          <div class="form-group">
            <label for="inputNombre">Nombre</label>
            <input type="text" class="form-control" id="inputNombre" placeholder="ingrese nombre" required>
          </div>
          <div class="form-group">
            <label for="inputDescripcion">Descripcion</label>
            <textarea class="form-control" rows="5" id="inputDescripcion" required></textarea>
          </div>
          <button type="submit">crear</button>
          <a class="btn btn-danger" href="foro.php" role="button">cancelar</a>
        </form>       
      </div>
    </div>
  </div>
</body>

</html>