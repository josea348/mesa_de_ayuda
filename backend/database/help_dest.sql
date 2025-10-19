CREATE DATABASE IF NOT EXISTS Mesa_of_help;
DROP DATABASE IF EXISTS Mesa_of_help;

USE Mesa_of_help;

CREATE TABLE IF NOT EXISTS usuarios (
    identificacion INT NOT NULL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    Telefono CHAR(20) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(60) NOT NULL,
    rol ENUM('Administrador', 'Operario', 'Instructor', 'Aprendiz') NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS areas (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripción TEXT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS ambiente (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    ubicación VARCHAR(100) NOT NULL,
    capacidad INT NOT NULL,
    estado ENUM('disponible', 'ocupado', 'mantenimiento') DEFAULT 'disponible',
    area_id INT,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE equipos(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripcion TEXT NOT NULL,
    tipo VARCHAR(100) NOT NULL,
    id_ambiente INT NOT NULL
);

-- Se require definir la estructura de la tabla reservas para equipos y ambientes
CREATE TABLE IF NOT EXISTS reservas(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    ambiente_id INT NOT NULL,
    fecha_inicio DATETIME NOT NULL,
    fecha_fin DATETIME NOT NULL,
    estado ENUM('pendiente', 'confirmada', 'cancelada', 'completada') DEFAULT 'pendiente',
    tipo_objetivo ENUM('ambiente', 'equipo') NOT NULL,
    id_objetivo INT NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualización TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS categorías (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    descripción TEXT
);

-- Se crea la tabla tickets para los abientes y equipos
CREATE TABLE IF NOT EXISTS tickets (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    título VARCHAR(100) NOT NULL,
    descripción TEXT NOT NULL,
    categoría INT NOT NULL,
    prioridad ENUM('baja', 'media', 'alta') DEFAULT 'media',
    estado ENUM('abierto', 'en progreso', 'En espera', 'Resuelto', 'cerrado') DEFAULT 'abierto',    
    solicitante INT NOT NULL,
    asignado INT,
    tipo_objetivo ENUM('ambiente', 'equipo') NOT NULL,
    id_objetivo INT NOT NULL,
    fechas TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_actualización TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS comentarios (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    usuario_id INT NOT NULL,
    comentario TEXT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS archivos_adjuntos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    nombre_archivo VARCHAR(100) NOT NULL,
    ruta_archivo VARCHAR(255) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS bitácora (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    acción VARCHAR(100) NOT NULL,
    detalles TEXT,
    usuario_id INT NOT NULL,
    ticket_id INT NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Se require definir la estructura de la tabla de encuesta de satisfacion
CREATE TABLE IF NOT EXISTS encuestas_satisfaccion (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    usuario_id INT NOT NULL,
    calificación INT CHECK (calificación BETWEEN 1 AND 5),
    comentarios TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE ambiente
ADD FOREIGN KEY (area_id) REFERENCES areas(id) ON DELETE SET NULL;
ALTER TABLE equipos
ADD FOREIGN KEY (id_ambiente) REFERENCES ambiente(id) ON DELETE CASCADE;
ALTER TABLE reservas 
ADD FOREIGN KEY (usuario_id) REFERENCES usuarios(identificacion) ON DELETE CASCADE,
ADD FOREIGN KEY (ambiente_id) REFERENCES ambiente(id) ON DELETE CASCADE,
ADD FOREIGN KEY (id_objetivo) REFERENCES ambiente(id) ON DELETE CASCADE,
ADD FOREIGN KEY (id_objetivo) REFERENCES equipos(id) ON DELETE CASCADE;
ALTER TABLE tickets
ADD FOREIGN KEY (solicitante) REFERENCES usuarios(identificacion) ON DELETE CASCADE,
ADD FOREIGN KEY (asignado) REFERENCES usuarios(identificacion) ON DELETE CASCADE,
ADD FOREIGN KEY (categoría) REFERENCES categorías(id) ON DELETE CASCADE,
ADD FOREIGN KEY (id_objetivo) REFERENCES ambiente(id) ON DELETE CASCADE,
ADD FOREIGN KEY (id_objetivo) REFERENCES equipos(id) ON DELETE CASCADE;
ALTER TABLE comentarios
ADD FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE,
ADD FOREIGN KEY (usuario_id) REFERENCES usuarios(identificacion) ON DELETE CASCADE;
ALTER TABLE archivos_adjuntos
ADD FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE;
ALTER TABLE bitácora
ADD FOREIGN KEY (usuario_id) REFERENCES usuarios(identificacion) ON DELETE CASCADE,
ADD FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE;
ALTER TABLE encuestas_satisfaccion
ADD FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE,
ADD FOREIGN KEY (usuario_id) REFERENCES usuarios(identificacion) ON DELETE CASCADE;

-- Insertar categorías iniciales
INSERT INTO categorías (nombre, descripción) VALUES
('Redes', 'Problemas relacionados con la conectividad de red.'),
('Hardware', 'Problemas con equipos físicos como computadoras, impresoras, etc.'),
('Software', 'Problemas con aplicaciones o sistemas operativos.'),
('Mantenimiento', 'Solicitudes de mantenimiento general.'),
('Otros', 'Cualquier otro tipo de problema no categorizado.');