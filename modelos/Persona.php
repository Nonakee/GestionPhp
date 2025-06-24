<?php
require_once '../config/Conexion.php';

class Persona {

    public function listar() {
    $sql = "SELECT * FROM personas ORDER BY idPersona DESC";
    $query = ejecutarConsulta($sql);
    return $query->fetch_all(MYSQLI_ASSOC);
}

    public function guardar($nombre, $apellido, $telefono, $email) {
        $sql = "INSERT INTO personas(nombre, apellido, telefono, email) VALUES ('$nombre', '$apellido', '$telefono', '$email')";
        return ejecutarConsulta($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM personas WHERE idPersona = '$id'";
        return ejecutarConsulta($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function obtener($id) {
        $sql = "SELECT * FROM personas WHERE idPersona = '$id'";
        return ejecutarConsultaSimpleFila($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function actualizar($id, $nombre, $apellido, $telefono, $email) {
        $sql = "UPDATE personas SET nombre='$nombre', apellido='$apellido', telefono='$telefono', email='$email' WHERE idPersona='$id'";
        return ejecutarConsulta($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
    }
}
?>

