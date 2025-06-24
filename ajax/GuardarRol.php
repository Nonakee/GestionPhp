<?php
require_once '../modelos/Rol.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';

    if (!empty($nombre) && !empty($descripcion)) {
        $rol = new Rol();
        $rol->insertar($nombre, $descripcion);
        header('Location: ../vistas/roles.php');
        exit;
    } else {
        echo "Faltan datos.";
    }
} else {
    echo "Acceso no permitido.";
}
