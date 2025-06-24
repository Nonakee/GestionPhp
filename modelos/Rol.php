<?php
require_once '../config/Conexion.php';

class Rol {
    public function listar() {
        $sql = "SELECT * FROM roles";
        return ejecutarConsulta($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function obtener($id) {
        $sql = "SELECT * FROM roles WHERE idRol = '$id'";
        $query = ejecutarConsulta($sql);
        return $query->fetch_assoc();
    }

    public function insertar($nombre, $descripcion) {
        $sql = "INSERT INTO roles (nombre, descripcion) VALUES ('$nombre', '$descripcion')";
        return ejecutarConsulta($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function actualizar($id, $nombre, $descripcion) {
        $sql = "UPDATE roles SET nombre='$nombre', descripcion='$descripcion' WHERE idRol='$id'";
        return ejecutarConsulta($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM roles WHERE idRol='$id'";
        return ejecutarConsulta($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
    }
}
