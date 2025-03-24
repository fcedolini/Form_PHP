<?php
include 'conexion.php';

// Variables para formulario
$id = $nombre = $apellido = $email = $telefono = $direccion = $fecha_nacimiento = "";

// Si se quiere eliminar un empleado desde el enlace "Eliminar"
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];
    $sql = "DELETE FROM empleados WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: formulario1.php"); // Redirigir para actualizar la tabla
        exit();
    } else {
        echo "Error al eliminar: " . $conn->error;
    }
}

// Si se quiere editar un empleado desde el enlace "Editar"
if (isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'edit') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM empleados WHERE id='$id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $email = $row['email'];
        $telefono = $row['telefono'];
        $direccion = $row['direccion'];
        $fecha_nacimiento = $row['fecha_nacimiento'];
    }
}

// Procesamiento del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['insertar'])) {
        // Inserción
        $sql = "INSERT INTO empleados (nombre, apellido, email, telefono, direccion, fecha_nacimiento) 
                VALUES ('$_POST[nombre]', '$_POST[apellido]', '$_POST[email]', '$_POST[telefono]', '$_POST[direccion]', '$_POST[fecha_nacimiento]')";

        if ($conn->query($sql) === TRUE) {
            header("Location: formulario1.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }

    if (isset($_POST['actualizar'])) {
        // Actualización
        $id = $_POST['id'];
        $sql = "UPDATE empleados SET 
                nombre='$_POST[nombre]', apellido='$_POST[apellido]', email='$_POST[email]', 
                telefono='$_POST[telefono]', direccion='$_POST[direccion]', fecha_nacimiento='$_POST[fecha_nacimiento]' 
                WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            header("Location: formulario1.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

    <!-- Barra superior con botón Agregar -->
    <a href="tabla.php" class="btn btn-primary mt-3" style="margin-bottom: 20px;">Ir a Tabla de Estado</a>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Gestión de Empleados</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEmpleado">Agregar Empleado</button>
    </div>

    <!-- Tabla de empleados -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Fecha de Nacimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM empleados";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row["id"]}</td>
                        <td>{$row["nombre"]}</td>
                        <td>{$row["apellido"]}</td>
                        <td>{$row["email"]}</td>
                        <td>{$row["telefono"]}</td>
                        <td>{$row["direccion"]}</td>
                        <td>{$row["fecha_nacimiento"]}</td>
                        <td>
                            <a href='?id={$row["id"]}&action=edit' class='btn btn-warning btn-sm'>Editar</a>
                            <a href='?id={$row["id"]}&action=delete' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>No hay empleados registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Modal para formulario -->
    <div class="modal fade" id="modalEmpleado" tabindex="-1" aria-labelledby="modalEmpleadoLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEmpleadoLabel"><?php echo ($id) ? 'Editar Empleado' : 'Agregar Empleado'; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <label>Nombre:</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $nombre; ?>" required>

                        <label>Apellido:</label>
                        <input type="text" name="apellido" class="form-control" value="<?php echo $apellido; ?>" required>

                        <label>Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>

                        <label>Teléfono:</label>
                        <input type="text" name="telefono" class="form-control" value="<?php echo $telefono; ?>" required>

                        <label>Dirección:</label>
                        <input type="text" name="direccion" class="form-control" value="<?php echo $direccion; ?>">

                        <label>Fecha de Nacimiento:</label>
                        <input type="date" name="fecha_nacimiento" class="form-control" value="<?php echo $fecha_nacimiento; ?>">
                    </div>
                    <div class="modal-footer">
                        <?php if ($id): // Si $id tiene un valor, significa que estamos editando 
                        ?>
                            <button type="submit" name="actualizar" class="btn btn-warning">Actualizar</button>
                        <?php else: // Si $id está vacío, significa que estamos agregando 
                        ?>
                            <button type="submit" name="insertar" class="btn btn-success">Guardar</button>
                        <?php endif; ?>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>