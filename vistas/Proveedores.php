<?php
session_start();
if (!isset($_SESSION['usuario'])) {
  header("Location: login.php");
  exit;
}

require_once '../modelos/Proveedor.php';
$proveedor = new Proveedor();
$datos = $proveedor->listar();

// Contar proveedores por categoría
$conteoCategorias = [];
foreach ($datos as $row) {
  $categoria = $row['categoria'];
  if (!isset($conteoCategorias[$categoria])) {
    $conteoCategorias[$categoria] = 0;
  }
  $conteoCategorias[$categoria]++;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Proveedores</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="../public/style.css">
</head>
<body class="d-flex">

<!-- Sidebar -->
<div id="sidebar" class="sidebar bg-dark text-white p-3">
  <h4 class="text-center mb-4">Gestión</h4>
  <ul class="nav flex-column">

  <!-- Usuario -->
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
<div id="mainContent" class="flex-grow-1 p-4">
  <nav class="navbar navbar-dark bg-dark mb-4 rounded">
    <div class="container-fluid">
      <button class="btn btn-outline-light me-2" id="toggleSidebar"><i class="bi bi-list"></i></button>
      <span class="navbar-brand mb-0 h1">Panel de Gestión - Proveedores</span>
    </div>
  </nav>

  <div class="card shadow-sm p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
  <h2 class="mb-0">Proveedores</h2>
  <div>
    <a href="FormularioProveedor.php" class="btn btn-success me-2">Agregar Proveedor</a>
    <a href="../reportes/ReporteProveedores.php" target="_blank" class="btn btn-outline-secondary">Generar PDF</a>
    <button id="btnEnviarCorreo" class="btn btn-outline-success">
    Enviar PDF al Correo
  </button>
  </div>
</div>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>Opciones</th>
            <th>Empresa</th>
            <th>Contacto</th>
            <th>Categoría</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Dirección</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($datos as $row): ?>
            <tr>
              <td>
                <a href="EditarProveedor.php?id=<?= $row['idProveedores'] ?>" class="btn btn-warning btn-sm">✏️</a>
                <a href="../ajax/EliminarProveedor.php?id=<?= $row['idProveedores'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">🗑️</a>
              </td>
              <td><?= $row['nombreEmpresa'] ?></td>
              <td><?= $row['Contacto'] ?></td>
              <td><?= $row['categoria'] ?></td>
              <td><?= $row['telefono'] ?></td>
              <td><?= $row['email'] ?></td>
              <td><?= $row['direccion'] ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <!-- GRÁFICO DE CATEGORÍAS -->
    <div class="mt-5">
      <h4 class="text-center">Gráfico de Proveedores por Categoría</h4>
      <canvas id="graficoCategorias" height="100"></canvas>
    </div>
  </div>
</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const toggleBtn = document.getElementById('toggleSidebar');
  const sidebar = document.getElementById('sidebar');
  const mainContent = document.getElementById('mainContent');
  toggleBtn?.addEventListener('click', function () {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('expanded');
  });

  // Cargar gráfico
  const ctx = document.getElementById('graficoCategorias').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: <?= json_encode(array_keys($conteoCategorias)) ?>,
      datasets: [{
        label: 'Cantidad de Proveedores',
        data: <?= json_encode(array_values($conteoCategorias)) ?>,
        backgroundColor: 'rgba(54, 162, 235, 0.6)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          precision: 0
        }
      }
    }
  });
});
</script>
<script>
document.getElementById("btnEnviarCorreo").addEventListener("click", function () {
  const btn = this;
  btn.disabled = true;
  btn.textContent = "Enviando...";

  fetch("../reportes/EnviarReporte.php")
    .then(res => res.text())
    .then(data => {
      if (data.includes("Correo enviado")) {
    alert("Correo enviado correctamente.");
} else {
    alert("Error al enviar el correo.");
}
    })
    .catch(error => {
      alert("Error de red.");
      console.error(error);
    })
    .finally(() => {
      btn.disabled = false;
      btn.textContent = "Enviar PDF al Correo";
    });
});
</script>
</body>
</html>
