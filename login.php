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
            <select class="form-control" id="userType" name="userType">
              <option value="admin">Administrador</option>
              <option value="prof">Profesor</option>
              <option value="est">Estudiante</option>
            </select>
          </div>
          <div class="form-group">
            <label for="inputUser">Usuario</label>
            <input class="form-control" id="inputUser" name="inputUser" type="text" placeholder="Ingresar Usuario" required>
          </div>
          <div class="form-group">
            <label for="inputPW">Contraseña</label>
            <input class="form-control" id="inputPW" name="inputPW" type="password" placeholder="Ingresar Contraseña" required>
          </div>
          <input class="btn btn-success btn-block" type="submit" value="Iniciar Sesion">
          <a class="btn btn-danger btn-block" href="index.php">Cancelar</a>
        </form>
  </div>
</body>

</html>