<?php
require_once '../config/Conexion.php';

class Proveedor {
    public function listar() {
    $sql = "SELECT 
              p.idProveedores,
              p.nombreEmpresa,
              CONCAT(per.nombre, ' ', per.apellido) AS Contacto,
              c.nombre AS categoria,
              p.telefono,
              p.email,
              p.direccion
            FROM proveedores p
            JOIN personas per ON p.contacto = per.idPersona
            JOIN categorias c ON p.idCategoria = c.idCategoria
            ORDER BY p.idProveedores DESC";
    return ejecutarConsulta($sql)->fetch_all(MYSQLI_ASSOC);
}


public function insertar($nombreEmpresa, $contacto, $idCategoria, $telefono, $email, $direccion) {
    $sql = "INSERT INTO proveedores (nombreEmpresa, contacto, idCategoria, telefono, email, direccion)
            VALUES ('$nombreEmpresa', '$contacto', '$idCategoria', '$telefono', '$email', '$direccion')";
    return ejecutarConsulta($sql);
}

    public function obtener($id) {
        $sql = "SELECT * FROM proveedores WHERE idProveedores = $id";
        $res = ejecutarConsulta($sql);
        return $res->fetch_assoc();
    }

    public function actualizar($id, $nombreEmpresa, $contacto, $idCategoria, $telefono, $email, $direccion) {
    $sql = "UPDATE proveedores SET 
            nombreEmpresa = '$nombreEmpresa',
            contacto = '$contacto',
            idCategoria = '$idCategoria',
            telefono = '$telefono',
            email = '$email',
            direccion = '$direccion'
            WHERE idProveedores = $id";
    return ejecutarConsulta($sql);
}

    public function eliminar($id) {
        $sql = "DELETE FROM proveedores WHERE idProveedores = $id";
        return ejecutarConsulta($sql);
    }
}
