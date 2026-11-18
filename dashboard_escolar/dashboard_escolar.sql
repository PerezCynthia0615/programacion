CREATE DATABASE dashboard_escolar
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;
USE dashboard_escolar;
CREATE TABLE materias (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nombre VARCHAR(150) NOT NULL,
 modulo VARCHAR(100),
 submodulo VARCHAR(150),
 semestre INT NULL,
 descripcion TEXT,
 activo TINYINT(1) DEFAULT 1
);
USE dashboard_escolar;
INSERT INTO materias
(nombre, modulo, submodulo, semestre, descripcion)
VALUES
('Procesamiento de Lenguaje Natural',
 'Módulo II',
 'Submódulo 2 - Soluciona problemas con lenguaje natural',
 3,
 'Curso de procesamiento de texto y voz con inteligencia artificial'),
('Implementa aplicaciones web',
 'Módulo IV',
 'Submódulo 2 - Implementa aplicaciones web',
 NULL,
 'Desarrollo, pruebas y despliegue de aplicaciones web');

-- ===== Semana 7: tabla servicios (Práctica Clase 2) =====
-- Estructura final (Guía PASO 1 + PASO 2)
CREATE TABLE servicios (
  id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  descripcion VARCHAR(255) NULL,
  activo TINYINT(1) NOT NULL,
  categoria VARCHAR(100) NULL,
  horario VARCHAR(50) NULL,
  ubicacion VARCHAR(150) NULL
);

-- Los 2 registros iniciales (ids 1 y 2); el primer POST creará el id 3
INSERT INTO servicios (nombre, descripcion, activo) VALUES
('Consulta de calificaciones', 'Consulta de calificaciones', 1),
('Consulta de calificaciones', 'Consulta de calificaciones', 1);
