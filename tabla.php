<?php
include 'conexion.php';  // Incluye tu archivo de conexión a la base de datos.

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>

<body class="container mt-4">
    <a href="formulario1.php" class="btn btn-primary mt-3" style="margin-bottom: 20px;">Agregar/Editar Empleados</a>
    <h2>Estado de los Empleados</h2>

    <!-- Búsqueda en la tabla -->
    <input type="text" id="search" class="form-control mb-3" placeholder="Buscar...">

    <!-- Tabla de empleados -->
    <h3 class="mt-4">Lista de Empleados</h3>
    <table class="table table-bordered" id="empleadosTable">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Fecha de Nacimiento</th>
            </tr>
        </thead>
        <tbody id="empleadosBody">
            <!-- Los datos de los empleados se cargarán aquí mediante AJAX -->
        </tbody>
    </table>

    <script>
        // Función para cargar la tabla de empleados
        function cargarEmpleados() {
            $.ajax({
                url: 'obtener_empleados.php', // Este archivo recupera la lista de empleados
                method: 'GET',
                success: function(response) {
                    $('#empleadosBody').html(response);
                    // Llamar a la función de filtrado después de que los empleados se carguen
                    aplicarFiltro();
                }
            });
        }

        // Función de filtro para la tabla
        function aplicarFiltro() {
            var searchTerm = $('#search').val().toLowerCase();
            $('#empleadosTable tbody tr').each(function() {
                var rowText = $(this).text().toLowerCase();
                $(this).toggle(rowText.indexOf(searchTerm) > -1);
            });
        }

        // Actualizar la tabla cada 4 segundos
        setInterval(cargarEmpleados, 4000);

        // Inicializar carga de empleados
        $(document).ready(function() {
            cargarEmpleados();

            // Filtrado de la tabla
            $('#search').keyup(function() {
                aplicarFiltro(); // Aplicar el filtro cuando el usuario escriba
            });
        });
    </script>
</body>

</html>