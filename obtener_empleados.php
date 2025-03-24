<?php
include 'conexion.php';

$sql = "SELECT * FROM empleados";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nombre']}</td>
            <td>{$row['apellido']}</td>
            <td>{$row['email']}</td>
            <td>{$row['telefono']}</td>
            <td>{$row['direccion']}</td>
            <td>{$row['fecha_nacimiento']}</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='8' class='text-center'>No hay empleados registrados.</td></tr>";
}
