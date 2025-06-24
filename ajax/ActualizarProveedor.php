<?php
require_once '../modelos/Proveedor.php';

// Validar todos los campos obligatorios (incluyendo categoría)
if (
    empty($_POST['id']) ||
    empty($_POST['nombreEmpresa']) ||
    empty($_POST['contacto']) ||
    empty($_POST['idCategoria']) ||
    empty($_POST['telefono']) ||
    empty($_POST['email']) ||
    empty($_POST['direccion'])
) {
    echo "Todos los campos son obligatorios.";
    exit;
}

// Sanitizar entradas
$id = intval($_POST['id']);
$nombreEmpresa = trim($_POST['nombreEmpresa']);
$contacto = intval($_POST['contacto']);
$idCategoria = intval($_POST['idCategoria']);
$telefono = trim($_POST['telefono']);
$email = trim($_POST['email']);
$direccion = trim($_POST['direccion']);

$proveedor = new Proveedor();

// Llamar al método que debe aceptar también idCategoria
$exito = $proveedor->actualizar($id, $nombreEmpresa, $contacto, $idCategoria, $telefono, $email, $direccion);

if ($exito) {
    header("Location: ../vistas/Proveedores.php");
    exit;
} else {
    echo "Error al actualizar el proveedor.";
}
