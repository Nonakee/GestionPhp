<?php
session_start();

$nombreUsuario = $_SESSION['usuario'] ?? 'Usuario';
$emailUsuario = $_SESSION['email'] ?? 'sin email';

require_once '../modelos/Usuario.php';
require_once '../modelos/Rol.php';
require_once '../modelos/Persona.php';
$usuario = new Usuario();
$datos = $usuario->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Usuarios</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../public/style.css">
</head>
<body class="d-flex">

<!-- Sidebar -->
<div id="sidebar" class="sidebar bg-dark text-white p-3">
  <h4 class="text-center mb-4">Gestión</h4>
  <!-- Bloque de usuario en sidebar -->
<div class="mb-3">
  <input type="checkbox" id="toggleUsuario" hidden>
  
  <label for="toggleUsuario" class="btn btn-outline-light w-100 mb-2">
    <i class="bi bi-person-circle"></i> Usuario
  </label>

  <div class="user-info collapse-box bg-secondary text-white rounded p-3">
    <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
    <p class="mb-0 fw-bold"><?= $_SESSION['usuario'] ?? 'Invitado' ?></p>
    <small class="text-light"><?= $_SESSION['email'] ?? 'Sin email' ?></small>
    <div class="mt-2">
      <a href="logout.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
    </div>
  </div>
</div>

  <ul class="nav flex-column">
    <li class="nav-item mb-2"><a class="nav-link text-white" href="Proveedores.php"><i class="bi bi-truck"></i> Proveedores</a></li>
    <li class="nav-item mb-2 dropdown">
      <a class="nav-link text-white dropdown-toggle" href="#"><i class="bi bi-lock"></i> Accesos</a>
      <ul class="submenu list-unstyled ps-3">
        <li><a class="nav-link text-white" href="persona.php"><i class="bi bi-person"></i> Personas</a></li>
        <li><a class="nav-link text-white" href="usuarios.php"><i class="bi bi-people"></i> Usuarios</a></li>
        <li><a class="nav-link text-white" href="roles.php"><i class="bi bi-shield-lock"></i> Roles</a></li>
      </ul>
    </li>
    <li class="nav-item mt-3"><a class="nav-link text-white" href="#"><i class="bi bi-question-circle"></i> Ayuda</a></li>
    <li class="nav-item mt-auto"><a class="nav-link text-white" href="#"><i class="bi bi-info-circle"></i> Acerca de</a></li>
  </ul>
</div>

<!-- Contenido principal -->
<div id="mainContent" class="main-content flex-grow-1 p-4">
  <nav class="navbar navbar-dark bg-dark mb-4 rounded">
    <div class="container-fluid">
      <button class="btn btn-outline-light me-2" id="toggleSidebar">
        <i class="bi bi-list"></i>
      </button>
      <span class="navbar-brand mb-0 h1">Panel de Gestión - Usuarios</span>
    </div>
  </nav>

  <div class="card shadow-sm p-4">
    <h2 class="mb-4">Usuarios</h2>
    <a href="FormularioUsuario.php" class="btn btn-success mb-3">Agregar Usuario</a>

    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Usuario</th>
          <th>Email</th>
          <th>Persona</th>
          <th>Rol</th>
          <th>Opciones</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = $datos->fetch_assoc()): ?>
          <tr>
            <td><?= $row['idUsuarios'] ?></td>
            <td><?= $row['nombre'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['persona'] ?></td>
            <td><?= $row['rol'] ?></td>
            <td>
              <a href="EditarUsuario.php?id=<?= $row['idUsuarios'] ?>" class="btn btn-warning btn-sm">✏️</a>
              <form action="../ajax/EliminarUsuario.php" method="POST" style="display:inline;">
  <input type="hidden" name="id" value="<?= $row['idUsuarios'] ?>">
  <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
</form>

            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const toggleBtn = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('mainContent');
  toggleBtn.addEventListener('click', function () {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('expanded');
  });
});
</script>
</body>
</html>