<?php
session_start();             // Inicia o continúa la sesión
session_unset();             // Elimina todas las variables de sesión
session_destroy();           // Destruye la sesión actual

// Redirige al formulario de login
header("Location: login.php");
exit;
