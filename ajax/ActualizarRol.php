<?php
require_once '../modelos/Rol.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    if ($id && $nombre && $descripcion) {
        $rol = new Rol();
        $rol->actualizar($id, $nombre, $descripcion);
        header('Location: ../vistas/roles.php');
        exit;
    } else {
        echo "Faltan datos.";
    }
} else {
    echo "Acceso no permitido.";
}
