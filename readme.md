# Que no se me olvide:
SITENAME = "Sitio de ejemplo"  # Nombre del sitio
LANG= "es"  # Idioma del sitio
titulo()= va a definir el título y si no lo encuentra lo pondrá por defecto.


# Consulta SQL para crear la base de datos 
-- Crear la base de datos xperience
CREATE DATABASE xperience;
USE xperience;

-- Crear la tabla ciudad
CREATE TABLE ciudad (
    id INT PRIMARY KEY AUTO_INCREMENT,
    ciudad VARCHAR(255) NOT NULL,
    gps NUMERIC NOT NULL
);

-- Crear la tabla direcciones
CREATE TABLE direcciones (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    cp NUMERIC NOT NULL,
    id_ciudad INT NOT NULL,
    FOREIGN KEY (id_ciudad) REFERENCES ciudad(id) ON DELETE CASCADE
);

-- Crear la tabla organizadores
CREATE TABLE organizadores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,
    telefono INTEGER NOT NULL,
    direccion TEXT NOT NULL
);

-- Crear la tabla tipo_eventos
CREATE TABLE tipo_eventos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(255) NOT NULL
);

-- Crear la tabla eventos
CREATE TABLE eventos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    img VARCHAR(255) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    descripcion LONGTEXT NOT NULL,
    fecha_inicio DATETIME NOT NULL,
    fecha_fin DATETIME NOT NULL,
    id_direccion INT NOT NULL,
    precio_min INT NOT NULL,
    precio_max INT NOT NULL,
    FOREIGN KEY (id_direccion) REFERENCES direcciones(id) ON DELETE CASCADE
);

-- Crear la tabla evento_tipo
CREATE TABLE evento_tipo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_evento INT NOT NULL,
    id_tipo INT NOT NULL,
    FOREIGN KEY (id_evento) REFERENCES eventos(id) ON DELETE CASCADE,
    FOREIGN KEY (id_tipo) REFERENCES tipo_eventos(id) ON DELETE CASCADE
);

-- Crear la tabla eventos_organizadores
CREATE TABLE eventos_organizadores (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_evento INT NOT NULL,
    id_organiza INT NOT NULL,
    FOREIGN KEY (id_evento) REFERENCES eventos(id) ON DELETE CASCADE,
    FOREIGN KEY (id_organiza) REFERENCES organizadores(id) ON DELETE CASCADE
);
