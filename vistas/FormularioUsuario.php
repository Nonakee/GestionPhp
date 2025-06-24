<?php
require_once '../modelos/Persona.php';
require_once '../modelos/Rol.php';

$persona = new Persona();
$personasArray = $persona->listar();

$rol = new Rol();
$rolesResult = $rol->listar(); // También devuelve mysqli_result
$rolesArray = [];

if ($rolesResult && $rolesResult instanceof mysqli_result) {
    while ($row = $rolesResult->fetch_assoc()) {
        $rolesArray[] = $row;
    }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Usuario</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../public/style.css">
</head>
<body class="d-flex">

<!-- Sidebar -->
<div id="sidebar" class="sidebar bg-dark text-white p-3">
  <h4 class="text-center mb-4">Gestión</h4>
  <ul class="nav flex-column">
    <li class="nav-item mb-2"><a class="nav-link text-white" href="#"><i class="bi bi-truck"></i> Proveedores</a></li>
    <li class="nav-item mb-2 dropdown">
      <a class="nav-link text-white dropdown-toggle" href="#"><i class="bi bi-lock"></i> Accesos</a>
      <ul class="submenu list-unstyled ps-3">
        <li><a class="nav-link text-white" href="persona.php"><i class="bi bi-person"></i> Personas</a></li>
        <li><a class="nav-link text-white" href="Usuarios.php"><i class="bi bi-people"></i> Usuarios</a></li>
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
      <span class="navbar-brand mb-0 h1">Agregar Usuario</span>
    </div>
  </nav>

  <div class="card shadow-sm p-4">
    <h2 class="mb-4">Nuevo Usuario</h2>

    <!-- Mostrar advertencias si no hay datos -->
    <?php
    if (count($personasArray) === 0) echo "<p class='text-danger'>⚠️ No hay personas registradas.</p>";
    if (count($rolesArray) === 0) echo "<p class='text-danger'>⚠️ No hay roles registrados.</p>";
    ?>

    <form action="../ajax/GuardarUsuario.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Nombre de Usuario:</label>
        <input type="text" name="nombre" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Correo electrónico:</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Contraseña:</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Persona asociada:</label>
        <select name="idPersona" class="form-select" required>
          <option value="">Seleccione una persona</option>
          <?php foreach ($personasArray as $p): ?>
            <option value="<?= $p['idPersona'] ?>"><?= $p['nombre'] ?> <?= $p['apellido'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Rol:</label>
        <select name="idRol" class="form-select" required>
          <option value="">Seleccione un rol</option>
          <?php foreach ($rolesArray as $r): ?>
            <option value="<?= $r['idRol'] ?>"><?= $r['nombre'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <button type="submit" class="btn btn-success">Guardar</button>
      <a href="usuarios.php" class="btn btn-secondary">Cancelar</a>
    </form>
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
