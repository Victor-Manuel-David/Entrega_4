<?php
// Datos de conexión
$servername = "localhost";
$username = "root"; // Cambia esto si tu configuración es diferente
$password = ""; // Cambia esto si tienes una contraseña configurada

// Crear conexión
$conn = new mysqli($servername, $username, $password);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Crear la base de datos
$sql = "CREATE DATABASE IF NOT EXISTS investigacion";
if ($conn->query($sql) === TRUE) {
    echo "Base de datos creada exitosamente<br>";
} else {
    echo "Error al crear la base de datos: " . $conn->error;
}

// Conectar a la base de datos recién creada
$conn->select_db("investigacion");

// Crear tabla objetivo_desarrollo_sostenible
$sql = "CREATE TABLE IF NOT EXISTS objetivo_desarrollo_sostenible (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    categoria VARCHAR(45)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'objetivo_desarrollo_sostenible' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'objetivo_desarrollo_sostenible': " . $conn->error;
}

// Crear tabla area_conocimiento
$sql = "CREATE TABLE IF NOT EXISTS area_conocimiento (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gran_area VARCHAR(60),
    area VARCHAR(60),
    disciplina VARCHAR(60)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'area_conocimiento' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'area_conocimiento': " . $conn->error;
}

// Crear tabla area_aplicacion
$sql = "CREATE TABLE IF NOT EXISTS area_aplicacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'area_aplicacion' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'area_aplicacion': " . $conn->error;
}

// Crear tabla docente
$sql = "CREATE TABLE IF NOT EXISTS docente (
    cedula INT PRIMARY KEY,
    nombres VARCHAR(255) NOT NULL,
    apellidos VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'docente' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'docente': " . $conn->error;
}

// Crear tabla grupo_investigacion
$sql = "CREATE TABLE IF NOT EXISTS grupo_investigacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    url_grupal VARCHAR(255),
    categoria VARCHAR(255),
    convocatoria VARCHAR(255),
    fecha_fundacion DATE,
    universidad VARCHAR(255),
    interno BOOLEAN,
    ambito VARCHAR(255)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'grupo_investigacion' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'grupo_investigacion': " . $conn->error;
}

// Crear tabla linea_investigacion
$sql = "CREATE TABLE IF NOT EXISTS linea_investigacion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    descripcion VARCHAR(255) NOT NULL
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'linea_investigacion' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'linea_investigacion': " . $conn->error;
}

// Crear tabla ods_linea
$sql = "CREATE TABLE IF NOT EXISTS ods_linea (
    linea_investigacion INT(10),
    ods INT(10),
    PRIMARY KEY (linea_investigacion, ods),
    FOREIGN KEY (linea_investigacion) REFERENCES linea_investigacion(id),
    FOREIGN KEY (ods) REFERENCES objetivo_desarrollo_sostenible(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'ods_linea' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'ods_linea': " . $conn->error;
}

// Crear tabla ac_linea
$sql = "CREATE TABLE IF NOT EXISTS ac_linea (
    linea_investigacion INT(10),
    area_conocimiento INT(10),
    PRIMARY KEY (linea_investigacion, area_conocimiento),
    FOREIGN KEY (linea_investigacion) REFERENCES linea_investigacion(id),
    FOREIGN KEY (area_conocimiento) REFERENCES area_conocimiento(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'ac_linea' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'ac_linea': " . $conn->error;
}

// Crear tabla aa_linea
$sql = "CREATE TABLE IF NOT EXISTS aa_linea (
    area_aplicacion INT(10),
    linea_investigacion INT(10),
    PRIMARY KEY (area_aplicacion, linea_investigacion),
    FOREIGN KEY (area_aplicacion) REFERENCES area_aplicacion(id),
    FOREIGN KEY (linea_investigacion) REFERENCES linea_investigacion(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'aa_linea' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'aa_linea': " . $conn->error;
}




// Crear tabla semillero
$sql = "CREATE TABLE IF NOT EXISTS semillero (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    fecha_fundacion DATE,
    grupo_investigacion_id INT,
    FOREIGN KEY (grupo_investigacion_id) REFERENCES grupo_investigacion(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'semillero' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'semillero': " . $conn->error;
}

// Crear tabla semillero_linea
$sql = "CREATE TABLE IF NOT EXISTS semillero_linea (
    semillero INT(10),
    linea_investigacion INT(10),
    PRIMARY KEY (semillero, linea_investigacion),
    FOREIGN KEY (semillero) REFERENCES semillero(id),
    FOREIGN KEY (linea_investigacion) REFERENCES linea_investigacion(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'semillero_linea' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'semillero_linea': " . $conn->error;
}

// Crear tabla grupo_linea
$sql = "CREATE TABLE IF NOT EXISTS grupo_linea (
    grupo_investigacion INT(10),
    linea_investigacion INT(10),
    PRIMARY KEY (grupo_investigacion, linea_investigacion),
    FOREIGN KEY (grupo_investigacion) REFERENCES grupo_investigacion(id),
    FOREIGN KEY (linea_investigacion) REFERENCES linea_investigacion(id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'grupo_linea' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'grupo_linea': " . $conn->error;
}

// Crear tabla participa_grupo
$sql = "CREATE TABLE IF NOT EXISTS participa_grupo (
    docente_cedula INT(10),
    grupo_investigacion_id INT(10),
    rol VARCHAR(15),
    fecha_inicio DATE,
    fecha_fin DATE,
    PRIMARY KEY (docente_cedula, grupo_investigacion_id),
    FOREIGN KEY (grupo_investigacion_id) REFERENCES grupo_investigacion(id),
    FOREIGN KEY (docente_cedula) REFERENCES docente(cedula)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'participa_grupo' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'participa_grupo': " . $conn->error;
}

// Crear tabla participa_semillero
$sql = "CREATE TABLE IF NOT EXISTS participa_semillero (
    docente INT(10),
    semillero INT(10),
    rol VARCHAR(15),
    fecha_inicio DATE,
    fecha_fin DATE,
    PRIMARY KEY (docente, semillero),
    FOREIGN KEY (semillero) REFERENCES semillero(id),
    FOREIGN KEY (docente) REFERENCES docente(cedula)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tabla 'participa_semillero' creada exitosamente<br>";
} else {
    echo "Error al crear la tabla 'participa_semillero': " . $conn->error;
}
// Cerrar conexión
$conn->close();
?>
