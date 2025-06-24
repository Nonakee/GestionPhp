<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Personas</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- Botones DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

    <!-- Tu CSS personalizado -->
    <link rel="stylesheet" href="../public/style.css">

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

</head>
<body class="d-flex">

    <!-- Sidebar -->
    <nav id="sidebar" class="bg-dark text-white p-3">
        <h4 class="text-center mb-4">Gestión</h4>
       <ul class="nav flex-column">

  <!-- Opción: Proveedores -->
  <li class="nav-item mb-2">
    <a class="nav-link text-white" href="#">
      <i class="bi bi-truck"></i> Proveedores
    </a>
  </li>

  <!-- Menú desplegable: Accesos -->
  <li class="nav-item mb-2 dropdown">
    <a class="nav-link text-white dropdown-toggle" href="#" role="button">
      <i class="bi bi-lock"></i> Accesos
    </a>
    <ul class="submenu list-unstyled ps-3">
      <li><a class="nav-link text-white" href="Persona.php"><i class="bi bi-person"></i> Personas</a></li>
      <li><a class="nav-link text-white" href="Usuarios.php"><i class="bi bi-people"></i> Usuarios</a></li>
      <li><a class="nav-link text-white" href="Roles.php"><i class="bi bi-shield-lock"></i> Roles</a></li>
    </ul>
  </li>

  <!-- Ayuda -->
  <li class="nav-item mt-3">
    <a class="nav-link text-white" href="#">
      <i class="bi bi-question-circle"></i> Ayuda
    </a>
  </li>

  <!-- Acerca de -->
  <li class="nav-item mt-auto">
    <a class="nav-link text-white" href="#">
      <i class="bi bi-info-circle"></i> Acerca de...
    </a>
  </li>

</ul>

    </nav>

    <!-- Contenido principal -->
      <div id="main" class="flex-grow-1 p-4">
        <nav class="navbar navbar-dark bg-dark mb-4 rounded">
  <div class="container-fluid">
    <button class="btn btn-outline-light me-2" id="toggleSidebar">
      <i class="bi bi-list"></i>
    </button>
    <span class="navbar-brand mb-0 h1">Panel de Gestión - Personas</span>
          </div>
         </nav>
        <div class="card shadow-sm p-4">
<h2 class="mb-4">Agregar Persona</h2>

<form action="../ajax/GuardarPersona.php" method="POST">
  <div class="mb-3">
    <label for="nombre" class="form-label">Nombre:</label>
    <input type="text" class="form-control" name="nombre" required>
  </div>

  <div class="mb-3">
    <label for="apellido" class="form-label">Apellido:</label>
    <input type="text" class="form-control" name="apellido" required>
  </div>

  <div class="mb-3">
    <label for="telefono" class="form-label">Teléfono:</label>
    <input type="text" class="form-control" name="telefono" required>
  </div>

  <div class="mb-3">
    <label for="email" class="form-label">Correo electrónico:</label>
    <input type="email" class="form-control" name="email" required>
  </div>

  <button type="submit" class="btn btn-success">Guardar</button>
  <a href="Persona.php" class="btn btn-secondary">Cancelar</a>
</form>
</body>
</html>
