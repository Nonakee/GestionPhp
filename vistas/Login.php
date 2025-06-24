<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Iniciar Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

<div class="card p-4 shadow" style="min-width: 350px;">
  <h4 class="text-center mb-4">Iniciar Sesión</h4>

  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
  <?php endif; ?>

  <form action="../ajax/LoginUsuario.php" method="POST">
    <div class="mb-3">
      <label>Email:</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Contraseña:</label>
      <input type="password" name="contrasena" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-primary w-100">Ingresar</button>
  </form>
</div>

</body>
</html>
