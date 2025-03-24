----Creación de la Base de Datos-------------
CREATE DATABASE atento_arg;
USE atento_arg;

----Creación de la Tabla de empleados-------
CREATE TABLE empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(20) NOT NULL,
    direccion VARCHAR(255),
    fecha_nacimiento DATE
);

----Creación de la consulta para ver los datos guardados en la tabla empleados
SELECT * FROM empleados;
