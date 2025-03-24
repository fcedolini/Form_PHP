resa1<?php
$host = "localhost"; // Cambia si tu servidor es diferente
$usuario = "root"; // Tu usuario de MySQL
$contrasena = ""; // Tu contraseña de MySQL
$base_datos = "empresa1"; // El nombre de la base de datos

// Conexión
$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
