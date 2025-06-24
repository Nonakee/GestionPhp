<?php
// Incluir modelo
require_once '../modelos/Persona.php';

// Instanciar la clase
$persona = new Persona();

// Obtener los datos
$datos = $persona->listar(); // devuelve array asociativo

// Formato compatible con DataTables
$resultado = [
    "data" => []
];

// Llenar el array con cada fila de datos
foreach ($datos as $row) {
    $resultado['data'][] = [
        '<button class="btn btn-warning btn-sm editar" data-id="'.$row['idPersona'].'">✏️</button>
         <button class="btn btn-danger btn-sm eliminar" data-id="'.$row['idPersona'].'">🗑️</button>',
        $row['nombre'],
        $row['apellido'],
        $row['telefono'],
        $row['email']
    ];
}

// Enviar resultado como JSON
header('Content-Type: application/json');
echo json_encode($resultado);
