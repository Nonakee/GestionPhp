<?php
require_once '../modelos/Proveedor.php';

if (!isset($_GET['id'])) {
    header("Location: ../vistas/Proveedores.php?error=1");
    exit;
}

$id = intval($_GET['id']);
$proveedor = new Proveedor();
$exito = $proveedor->eliminar($id);

// Redirigir a la lista con un mensaje opcional
header("Location: ../vistas/Proveedores.php?eliminado=" . ($exito ? "ok" : "error"));
exit;
