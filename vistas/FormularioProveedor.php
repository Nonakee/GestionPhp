<?php
require_once '../modelos/Persona.php';
require_once '../modelos/Categoria.php';

$persona = new Persona();
$personas = $persona->listar();

$categoria = new Categoria();
$categorias = $categoria->listar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Proveedor</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../public/style.css">
</head>
<body class="d-flex">

<!-- Sidebar -->
<nav id="sidebar" class="bg-dark text-white p-3">
  <h4 class="text-center mb-4">Gestión</h4>
  <ul class="nav flex-column">
    <li class="nav-item mb-2"><a class="nav-link text-white" href="Proveedores.php"><i class="bi bi-truck"></i> Proveedores</a></li>
    <li class="nav-item mb-2 dropdown">
      <a class="nav-link text-white dropdown-toggle" href="#"><i class="bi bi-lock"></i> Accesos</a>
      <ul class="submenu list-unstyled ps-3">
        <li><a class="nav-link text-white" href="Persona.php"><i class="bi bi-person"></i> Personas</a></li>
        <li><a class="nav-link text-white" href="Usuarios.php"><i class="bi bi-people"></i> Usuarios</a></li>
        <li><a class="nav-link text-white" href="Roles.php"><i class="bi bi-shield-lock"></i> Roles</a></li>
      </ul>
    </li>
    <li class="nav-item mt-3"><a class="nav-link text-white" href="#"><i class="bi bi-question-circle"></i> Ayuda</a></li>
    <li class="nav-item mt-auto"><a class="nav-link text-white" href="#"><i class="bi bi-info-circle"></i> Acerca de...</a></li>
  </ul>
</nav>

<!-- Contenido principal -->
<div id="mainContent" class="main-content flex-grow-1 p-4">
  <nav class="navbar navbar-dark bg-dark mb-4 rounded">
    <div class="container-fluid">
      <button class="btn btn-outline-light me-2" id="toggleSidebar"><i class="bi bi-list"></i></button>
      <span class="navbar-brand mb-0 h1">Agregar Proveedor</span>
    </div>
  </nav>

  <div class="card shadow-sm p-4">
    <h2 class="mb-4">Nuevo Proveedor</h2>

    <form action="../ajax/GuardarProveedor.php" method="POST">
      <div class="mb-3">
        <label class="form-label">Nombre de la Empresa:</label>
        <input type="text" name="nombreEmpresa" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Persona de Contacto:</label>
        <select name="contacto" class="form-select" required>
          <option value="">Seleccione una persona</option>
          <?php foreach ($personas as $p): ?>
            <option value="<?= $p['idPersona'] ?>"><?= htmlspecialchars($p['nombre'] . ' ' . $p['apellido']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Categoría:</label>
        <select name="idCategoria" class="form-select" required>
          <option value="">Seleccione una categoría</option>
          <?php foreach ($categorias as $cat): ?>
            <option value="<?= $cat['idCategoria'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Teléfono:</label>
        <input type="text" name="telefono" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Dirección:</label>
        <textarea name="direccion" class="form-control" rows="3" required></textarea>
      </div>

      <button type="submit" class="btn btn-success">Guardar</button>
      <a href="Proveedores.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const toggleBtn = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('mainContent');
  toggleBtn?.addEventListener('click', function () {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('expanded');
  });
});
</script>
</body>
</html>
