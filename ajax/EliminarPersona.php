<?php
require_once '../modelos/Persona.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;

    if ($id) {
        $persona = new Persona();
        $persona->eliminar($id);
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'ID no recibido']);
    }
}
