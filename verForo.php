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
        <table>
          <tr>
            <td><strong>usuario</strong></td>
            <td><strong>comentario</strong></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
          </tr>
        </table>
        <div class="form-group">
            <label for="inputComentario">comentario</label>
            <textarea class="form-control" rows="5" id="inputComentario" required></textarea>
          </div>
        <button type="button">comentar</button>
        <a class="btn btn-danger" href="foro.php" role="button">cerrar</a>
      </div>
    </div>
  </div>
</body>

</html>