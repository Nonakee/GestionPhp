<?php
session_start();
require_once '../modelos/Usuario.php';

if (empty($_POST['email']) || empty($_POST['contrasena'])) {
  $_SESSION['error'] = "Todos los campos son obligatorios.";
  header("Location: ../vistas/login.php");
  exit;
}

$email = trim($_POST['email']);
$contrasena = $_POST['contrasena'];

$usuario = new Usuario();
$datos = $usuario->buscarPorEmail($email);

if ($datos) {
  echo "<pre>";
  print_r($datos); // Verifica qué llega
  echo "Ingresada: $contrasena\n";
  echo "Hash BD: " . $datos['contrasena'];
  echo "</pre>";

  if (password_verify($contrasena, $datos['contrasena'])) {
    $_SESSION['usuario'] = $datos['nombre'];
    $_SESSION['rol'] = $datos['idRol'];
    $_SESSION['id'] = $datos['idUsuarios'];
    $_SESSION['email'] = $datos['email'];
    header("Location: ../vistas/persona.php");
    exit;
  } else {
    $_SESSION['error'] = "La contraseña no coincide.";
  }
} else {
  $_SESSION['error'] = "El correo no está registrado.";
}

header("Location: ../vistas/login.php");
