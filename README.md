Proyecto Formularios en PHP

La idea de este proyecto es mostarar los conocimientos en PHP y SQL, consta de una tabla y un formulario modal generado con Bootstrap donde se puede hacer un CRUD, luego cuenta con otra Tabla dinámica que se actualiza en tiempo real cada 4s con AJAX y JQuery mostarndo todos los cambios

Instalación:

*Copiar los archivos PHP a una carpeta nueva (por ej: mi_app) en el directorio htdocs de xampp. Ejemplo: "C:\xampp\htdocs\mi_app"

*Correr Apache y SQL local con xampp-control

*Abrir en el navegador tu phpMyAdmin, ej:
http://localhost:8012/phpmyadmin/index.php (cambiar el localhost de éstas direcciones si el tuyo no es 8012)

*En la pestaña SQL puedés pegar el código que dejé en el archivo "Script.sql" y ejecutarlo.
Ésto creará la BD de ejemplo "empresa1" y la tabla "empleados"

-------------------------
Uso:

*Ahora ya podés entrar en el navegador a la web:
http://localhost:8012/mi_app/formulario1.php

Ahí tenemos una tabla para hacer CRUD donde puedes:
	-Agregar empleados con el botón "Agregar Empleado"
	-Eliminar empleados con el botón rojo "Eliminar" en cada fila
	-Actualizar los datos haciendo primero click a "Editar" (esto solo carga los datos en el form) ahora click en "Agregar Empleado" para que se abra el form con los datos del empleado, solo modifica lo que quieras y dale a "Actualizar"
	-Ir a Tabla Estado, en este botón de la parte superior puedes ir a otra web donde tenemos la Tabla que actualiza online cada 4s mostrando el estado de los empleados.También tiene una Barra de "Buscar"

