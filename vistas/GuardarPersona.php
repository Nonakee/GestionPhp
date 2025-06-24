<?php
require_once '../modelos/Persona.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';

    $persona = new Persona();
    $persona->guardar($nombre, $apellido, $telefono, $email);

    header("Location: ../vistas/persona.php");
    exit;
}
