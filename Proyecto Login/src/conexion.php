<?php
// Datos de conexión
$host = "localhost";  // Nombre del host (si usas XAMPP, localhost es correcto)
$user = "root";       // Nombre de usuario de MySQL
$password = "";       // Contraseña (en XAMPP suele estar en blanco)
$dbname = "flask_login"; // Nombre de la base de datos

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
