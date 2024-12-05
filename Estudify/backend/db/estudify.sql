-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-11-2024 a las 10:01:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;




--
-- Base de Datos: estudify
--

CREATE DATABASE IF NOT EXISTS `estudify`;
USE `estudify`;



-- 
-- tabla usuarios
-- 

CREATE TABLE `usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `contraseña` VARCHAR(255) NOT NULL,
  `fecha_creacion` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




--
-- tabla roles
-- 
CREATE TABLE `roles` (
  `id_rol` INT NOT NULL AUTO_INCREMENT,
  `nombre_rol` ENUM('admin', 'usuario') NOT NULL,
  PRIMARY KEY (`id_rol`),
  UNIQUE (`nombre_rol`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;





-- 
-- tabla usuarioroles
-- 
CREATE TABLE `usuarioroles` (
  `id_usuario` INT NOT NULL,
  `id_rol` INT NOT NULL,
  PRIMARY KEY (`id_usuario`, `id_rol`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE,
  FOREIGN KEY (`id_rol`) REFERENCES `roles`(`id_rol`) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- 
-- tabla calendario
-- 
CREATE TABLE `calendario` (
  `id_evento` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `titulo` VARCHAR(100) NOT NULL,
  `descripcion` TEXT DEFAULT NULL,
  `fecha_inicio` DATETIME NOT NULL,
  `fecha_fin` DATETIME DEFAULT NULL,
  `recordatorio` TINYINT(1) DEFAULT 0,
  PRIMARY KEY (`id_evento`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



--
-- tabla estadisticas
-- 

CREATE TABLE `estadisticas` (
  `id_estadistica` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `tipo_estadistica` ENUM('Tiempo de Estudio', 'Programas Comparados') NOT NULL,
  `valor` JSON DEFAULT NULL CHECK (json_valid(`valor`)),
  PRIMARY KEY (`id_estadistica`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- 
-- tabla finanzas
-- 

CREATE TABLE `finanzas` (
  `id_transaccion` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `tipo` ENUM('Ingreso', 'Gasto') NOT NULL,
  `monto` DECIMAL(10,2) NOT NULL,
  `descripcion` TEXT DEFAULT NULL,
  `fecha` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_transaccion`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




-- 
-- tabla frasesmotivacionales
-- 

CREATE TABLE `frasesmotivacionales` (
  `id_frase` INT NOT NULL AUTO_INCREMENT,
  `frase` TEXT NOT NULL,
  `fuente` VARCHAR(100) DEFAULT NULL,
  PRIMARY KEY (`id_frase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;




-- 
-- tabla programasacademicos
-- 
CREATE TABLE `programasacademicos`(
  `id_programa` INT NOT NULL AUTO_INCREMENT,
  `nombre_programa` VARCHAR(100) NOT NULL,
  `universidad` VARCHAR(100) NOT NULL,
  `nivel` ENUM('Grado', 'Máster', 'Curso') NOT NULL,
  `descripcion` TEXT DEFAULT NULL,
  PRIMARY KEY (`id_programa`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- 
-- tabla sesionesestudio
-- 
CREATE TABLE `sesionesestudio`(
  `id_sesion` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `fecha` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `duracion` INT NOT NULL,
  `asignatura` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_sesion`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



-- 
-- tabla ubicaciones
-- 

CREATE TABLE `ubicaciones`(
  `id_ubicacion` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `nombre` VARCHAR(100) NOT NULL,
  `coordenadas` VARCHAR(50) NOT NULL,
  `descripcion` TEXT DEFAULT NULL,
  PRIMARY KEY (`id_ubicacion`),
  FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;














-- tabla usuarios
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `contraseña`, `fecha_creacion`) VALUES
(1, 'Alejandro Ruiz', 'alejandro.ruiz@artegranada.com', '*CCE01C742AF76488A0E6F5727CEA7F11F0F04F3A', '2024-11-06 09:01:04'),
(2, 'Lucía Fernández', 'lucia.fernandez@artegranada.com', '*3E41BCF06786A7B8FDD3752A3B32AE501B50FA44', '2024-11-06 09:01:04'),
(3, 'Admin User', 'admin@artegranada.com', '*9A9A8DF73F6431CD3B43F2EE3309A01592D8ADFA', '2024-11-06 09:01:04');



-- tabla roles
INSERT INTO `roles` (`id_rol`, `nombre_rol`) VALUES
(1, 'admin'),
(2, 'usuario');




-- tabla usuarioroles
INSERT INTO `usuarioroles` (`id_usuario`, `id_rol`) VALUES
(1, 2),
(2, 2),
(3, 1);





-- tabla calendario
INSERT INTO `calendario` (`id_evento`, `id_usuario`, `titulo`, `descripcion`, `fecha_inicio`, `fecha_fin`, `recordatorio`) VALUES
(1, 1, 'Clase de PHP', 'Clase sobre manejo de bases de datos en PHP', '2024-11-10 10:00:00', '2024-11-10 11:30:00', 1),
(2, 1, 'Revisión de proyecto final', 'Revisión de mi proyecto final en DAW', '2024-11-12 09:00:00', '2024-11-12 10:00:00', 0),
(3, 2, 'Consulta con profesor', 'Revisión de dudas sobre la práctica de JavaScript', '2024-11-15 14:00:00', '2024-11-15 15:00:00', 1);





-- tabla estadisticas
INSERT INTO `estadisticas` (`id_estadistica`, `id_usuario`, `tipo_estadistica`, `valor`) VALUES
(1, 1, 'Tiempo de Estudio', '{\"PHP\": 12, \"JavaScript\": 15, \"SQL\": 10}'),
(2, 1, 'Programas Comparados', '{\"Grado en Desarrollo de Aplicaciones Web\": \"Escuela de Arte Granada\", \"Máster en Desarrollo Full Stack\": \"Universidad de Granada\"}'),
(3, 2, 'Tiempo de Estudio', '{\"HTML\": 7, \"CSS\": 8, \"JavaScript\": 12}');





-- tabla finanzas
INSERT INTO `finanzas` (`id_transaccion`, `id_usuario`, `tipo`, `monto`, `descripcion`, `fecha`) VALUES
(1, 1, 'Ingreso', 250.00, 'Pago por prácticas en empresa', '2024-10-01 08:30:00'),
(2, 1, 'Gasto', 20.00, 'Compra de libro sobre PHP y MySQL', '2024-10-03 15:00:00'),
(3, 2, 'Ingreso', 150.00, 'Ayuda económica de la beca', '2024-10-05 09:00:00'),
(4, 2, 'Gasto', 35.00, 'Materiales para proyecto final de DAW', '2024-10-07 11:00:00');





-- tabla frasesmotivacionales
INSERT INTO `frasesmotivacionales` (`id_frase`, `frase`, `fuente`) VALUES
(1, 'El único modo de hacer un gran trabajo es amar lo que haces.', 'Steve Jobs'),
(2, 'El aprendizaje nunca agota la mente.', 'Leonardo da Vinci'),
(3, 'La educación es el arma más poderosa que puedes usar para cambiar el mundo.', 'Nelson Mandela');




-- tabla programasacademicos
INSERT INTO `programasacademicos` (`id_programa`, `nombre_programa`, `universidad`, `nivel`, `descripcion`) VALUES
(1, 'Grado en Desarrollo de Aplicaciones Web', 'Escuela de Arte Granada', 'Grado', 'Programa orientado a la creación de aplicaciones web y desarrollo full stack.'),
(2, 'Máster en Desarrollo Full Stack', 'Universidad de Granada', 'Máster', 'Especialización en desarrollo avanzado de aplicaciones y bases de datos.'),
(3, 'Curso de Diseño UX/UI', 'Escuela de Arte Granada', 'Curso', 'Curso sobre principios y prácticas en diseño de experiencia de usuario y diseño de interfaz.');





-- tabla sesionesestudio
INSERT INTO `sesionesestudio` (`id_sesion`, `id_usuario`, `fecha`, `duracion`, `asignatura`) VALUES
(1, 1, '2024-10-04 10:00:00', 90, 'PHP'),
(2, 1, '2024-10-05 15:00:00', 120, 'JavaScript'),
(3, 2, '2024-10-06 10:30:00', 60, 'HTML y CSS'),
(4, 2, '2024-10-07 14:00:00', 45, 'JavaScript');





-- tabla ubicaciones
INSERT INTO `ubicaciones` (`id_ubicacion`, `id_usuario`, `nombre`, `coordenadas`, `descripcion`) VALUES
(1, 1, 'Biblioteca de la Escuela de Arte Granada', '37.1809,-3.6009', 'Espacio tranquilo para estudiar en la Escuela de Arte Granada'),
(2, 1, 'Cafetería del Campus Universitario', '37.1775,-3.5989', 'Lugar para estudiar y relajarse en el campus'),
(3, 2, 'Parque García Lorca', '37.1776,-3.5945', 'Parque ideal para estudiar al aire libre y relajarse');


















----------------------------------------------------------------
-- Indices y claves primarias
----------------------------------------------------------------



-- tabla calendario
ALTER TABLE `calendario`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `id_usuario` (`id_usuario`);



-- tabla estadisticas
ALTER TABLE `estadisticas`
  ADD PRIMARY KEY (`id_estadistica`),
  ADD KEY `id_usuario` (`id_usuario`);



-- tabla finanzas
ALTER TABLE `finanzas`
  ADD PRIMARY KEY (`id_transaccion`),
  ADD KEY `id_usuario` (`id_usuario`);



-- tabla frasesmotivacionales
ALTER TABLE `frasesmotivacionales`
  ADD PRIMARY KEY (`id_frase`);



-- tabla programasacademicos
ALTER TABLE `programasacademicos`
  ADD PRIMARY KEY (`id_programa`);



-- tabla roles
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`),
  ADD UNIQUE KEY `nombre_rol` (`nombre_rol`);



-- tabla sesionesestudio
ALTER TABLE `sesionesestudio`
  ADD PRIMARY KEY (`id_sesion`),
  ADD KEY `id_usuario` (`id_usuario`);



-- tabla ubicaciones
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id_ubicacion`),
  ADD KEY `id_usuario` (`id_usuario`);



-- tabla usuarioroles
ALTER TABLE `usuarioroles`
  ADD PRIMARY KEY (`id_usuario`, `id_rol`),
  ADD KEY `id_rol` (`id_rol`);



-- tabla usuarios
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);
















------------------------------------------
-- Auto increment en las tablas
----------------------------------------------




-- calendario
ALTER TABLE `calendario`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


-- estadisticas
ALTER TABLE `estadisticas`
  MODIFY `id_estadistica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;


-- finanzas
ALTER TABLE `finanzas`
  MODIFY `id_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;



-- frasesmotivacionales
ALTER TABLE `frasesmotivacionales`
  MODIFY `id_frase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;



-- programasacademicos
ALTER TABLE `programasacademicos`
  MODIFY `id_programa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;



-- roles
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;



-- sesionesestudio
ALTER TABLE `sesionesestudio`
  MODIFY `id_sesion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;



-- ubicaciones
ALTER TABLE `ubicaciones`
  MODIFY `id_ubicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;



-- usuarios
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;









----------------------------------------------------------
-- Claves Foráneas y Restricciones
--------------------------------------------------------



-- calendario
ALTER TABLE `calendario`
  ADD CONSTRAINT `calendario_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;


-- estadisticas
ALTER TABLE `estadisticas`
  ADD CONSTRAINT `estadisticas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;


-- finanzas
ALTER TABLE `finanzas`
  ADD CONSTRAINT `finanzas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;


-- sesionesestudio
ALTER TABLE `sesionesestudio`
  ADD CONSTRAINT `sesionesestudio_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;


-- ubicaciones
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `ubicaciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE;


-- usuarioroles
ALTER TABLE `usuarioroles`
  ADD CONSTRAINT `usuarioroles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  ADD CONSTRAINT `usuarioroles_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE;





