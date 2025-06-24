<?php
require_once '../modelos/Usuario.php';

// Validación de campos obligatorios
if (
    empty($_POST['id']) ||
    empty($_POST['nombre']) ||
    empty($_POST['email']) ||
    empty($_POST['idPersona']) ||
    empty($_POST['idRol'])
) {
    echo "Todos los campos excepto la contraseña son obligatorios.";
    exit;
}

$id = intval($_POST['id']);
$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$idPersona = intval($_POST['idPersona']);
$idRol = intval($_POST['idRol']);

$contrasena = trim($_POST['contrasena'] ?? '');

$usuario = new Usuario();

if ($contrasena !== '') {
    $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
    $exito = $usuario->actualizarConContrasena($id, $nombre, $email, $contrasenaHash, $idPersona, $idRol);
} else {
    $exito = $usuario->actualizarSinContrasena($id, $nombre, $email, $idPersona, $idRol);
}

if ($exito) {
    header("Location: ../vistas/Usuarios.php");
    exit;
} else {
    echo "Error al actualizar el usuario.";
}
