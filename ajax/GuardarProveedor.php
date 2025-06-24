<?php
require_once '../modelos/Proveedor.php';

// Validación de campos
if (
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

// Obtener y limpiar datos del formulario
$nombreEmpresa = trim($_POST['nombreEmpresa']);
$contacto = intval($_POST['contacto']);
$idCategoria = intval($_POST['idCategoria']);
$telefono = trim($_POST['telefono']);
$email = trim($_POST['email']);
$direccion = trim($_POST['direccion']);

// Crear objeto proveedor y guardar
$proveedor = new Proveedor();
$exito = $proveedor->insertar($nombreEmpresa, $contacto, $idCategoria, $telefono, $email, $direccion);

// Redireccionar o mostrar error
if ($exito) {
    header("Location: ../vistas/Proveedores.php");
    exit;
} else {
    echo "Error al guardar el proveedor.";
}
