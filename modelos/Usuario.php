<?php
require_once '../config/Conexion.php';

class Usuario {
    public function listar() {
    $sql = "SELECT 
                usuarios.idUsuarios,
                usuarios.nombre,
                usuarios.email,
                personas.nombre AS persona,
                roles.nombre AS rol
            FROM usuarios
            JOIN personas ON usuarios.idPersona = personas.idPersona
            JOIN roles ON usuarios.idRol = roles.idRol";
    return ejecutarConsulta($sql);
}

    public function obtener($id) {
        $sql = "SELECT * FROM usuarios WHERE idUsuarios = '$id'";
        $query = ejecutarConsulta($sql);
        return $query->fetch_assoc();
    }

    public function insertar($nombre, $email, $contrasena, $idPersona, $idRol) {
    $contrasenaHash = password_hash($contrasena, PASSWORD_DEFAULT);
    $sql = "INSERT INTO usuarios (nombre, email, contrasena, idPersona, idRol)
            VALUES ('$nombre', '$email', '$contrasenaHash', '$idPersona', '$idRol')";
    return ejecutarConsulta($sql);
}

    public function actualizar($id, $nombre, $email, $contraseña, $idPersona, $idRol) {
        $PasswordHash = Password_hash($contrasena, Password_DEFAULT);
        $sql = "UPDATE usuarios SET 
                    nombre = '$nombre',
                    email = '$email',
                    contrasena = '$PasswordHash',
                    idPersona = '$idPersona',
                    idRol = '$idRol'
                WHERE idUsuarios = '$id'";
        return ejecutarConsulta($sql);
    }

    public function actualizarConContrasena($idUsuarios, $nombre, $email, $contrasena, $idPersona, $idRol) {
    $sql = "UPDATE usuarios 
            SET Nombre = '$nombre', email = '$email', contrasena = '$contrasena', idPersona = $idPersona, idRol = $idRol 
            WHERE idUsuarios = $idUsuarios";
    return ejecutarConsulta($sql);
}

public function actualizarSinContrasena($idUsuarios, $nombre, $email, $idPersona, $idRol) {
    $sql = "UPDATE usuarios 
            SET Nombre = '$nombre', email = '$email', idPersona = $idPersona, idRol = $idRol 
            WHERE idUsuarios = $idUsuarios";
    return ejecutarConsulta($sql);
    return $query->fetch_all(MYSQLI_ASSOC);
}


    public function eliminar($id) {
        $sql = "DELETE FROM usuarios WHERE idUsuarios = '$id'";
        return ejecutarConsulta($sql);
    }

    public function buscarPorEmail($email) {
    $sql = "SELECT idUsuarios, nombre AS nombre, email, contrasena, idPersona, idRol FROM usuarios WHERE email = '$email' LIMIT 1";
    $res = ejecutarConsulta($sql);
    return $res->fetch_assoc();
}
}
