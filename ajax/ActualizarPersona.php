<?php
require_once '../modelos/Persona.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';

    if ($id) {
        $persona = new Persona();
        $persona->actualizar($id, $nombre, $apellido, $telefono, $email);
    }

    header("Location: ../vistas/Persona.php");
    exit;
}
