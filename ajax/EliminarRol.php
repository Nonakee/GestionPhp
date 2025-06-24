<?php
require_once '../modelos/Rol.php';

$id = $_GET['idRol'] ?? null;

if ($id) {
    $rol = new Rol();
    $rol->eliminar($id);
}

// Redirigir de vuelta a la vista de roles
header('Location: ../vistas/roles.php');
exit;
