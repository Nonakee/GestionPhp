<?php
require_once '../config/Conexion.php';

class Categoria {
    public function listar() {
        $sql = "SELECT * FROM categorias ORDER BY nombre ASC";
        return ejecutarConsulta($sql)->fetch_all(MYSQLI_ASSOC);
    }
}
