<?php
require_once '../modelos/Usuario.php';

if (!empty($_POST['id'])) {
    $usuario = new Usuario();
    $exito = $usuario->eliminar(intval($_POST['id']));
    
    if ($exito) {
        header("Location: ../vistas/Usuarios.php");
        exit;
    } else {
        echo "❌ Error al eliminar usuario.";
    }
} else {
    echo "⚠️ ID no enviado.";
}
