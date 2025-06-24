<?php
require_once '../modelos/Usuario.php';

echo "<pre>";
print_r($_POST);
echo "</pre>";

// Validación básica
if (
    empty($_POST['nombre']) ||
    empty($_POST['email']) ||
    empty($_POST['password']) ||
    empty($_POST['idPersona']) ||
    empty($_POST['idRol'])
) {
    echo "Todos los campos son obligatorios.";
    exit;
}

$nombre = trim($_POST['nombre']);
$email = trim($_POST['email']);
$password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT); // Encriptar
$idPersona = intval($_POST['idPersona']);
$idRol = intval($_POST['idRol']);

$usuario = new Usuario();
$exito = $usuario->insertar($nombre, $email, $password, $idPersona, $idRol);

if ($exito) {
    header("Location: ../vistas/Usuarios.php");
    exit;
} else {
    echo "Error al guardar el usuario.";
}
