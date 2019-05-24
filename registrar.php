<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    require "head.php";
  ?>
</head>

<body class="bg-dark">
  <div class="container">
    <form method="post">
          <div class="form-group">
            <label for="inputCedula">Cedula</label>
            <input class="form-control" id="inputCedula" name="inputCedula" type="text" placeholder="Ingresar numero de cedula" required>
          </div>
          <div class="form-group">
            <label for="inputNombres">Nombres</label>
            <input class="form-control" id="inputNombres" name="inputNombres" type="text" placeholder="Ingresar nombres" required>
          </div>
          <div class="form-group">
            <label for="inputApellidos">Apellidos</label>
            <input class="form-control" id="inputApellidos" name="inputApellidos" type="text" placeholder="Ingresar apellidos" required>
          </div>
          <div class="form-group">
            <select class="form-control" id="userType" name="userType" required>
              <option value="prof">Profesor</option>
              <option value="est">Estudiante</option>
            </select>
          </div>
          <input class="btn btn-primary btn-block" type="submit" value="Registrarse">
          <a class="btn btn-danger btn-block" href="index.php">Cancelar</a>
    </form>
  </div>
</body>

</html>