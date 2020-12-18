-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Dec 18, 2020 at 07:47 PM
-- Server version: 8.0.22
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Comunica2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Administrador`
--

CREATE TABLE `Administrador` (
  `idAdministrador` int UNSIGNED NOT NULL,
  `tlfAdministrador` varchar(10) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `contraseña` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Administrador`
--

INSERT INTO `Administrador` (`idAdministrador`, `tlfAdministrador`, `nombre`, `contraseña`) VALUES
(2, '645908342', 'administrador', '$2y$10$GUIWZ.JtfXUJQCdQa5za5.W1zHNNmL3jM/EJ0RdlPfonvbNdbLXDS');

-- --------------------------------------------------------

--
-- Table structure for table `Corrige`
--

CREATE TABLE `Corrige` (
  `idEjercicio` int UNSIGNED NOT NULL,
  `idFacilitador` int UNSIGNED NOT NULL,
  `idPersona` int UNSIGNED NOT NULL,
  `fechaAsignacionEjercicio` datetime NOT NULL,
  `fechaCorreccion` date NOT NULL,
  `comentario` text,
  `archivoAdjuntoCorreccion` varchar(100) DEFAULT NULL,
  `valoracionFacilitador` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Corrige`
--

INSERT INTO `Corrige` (`idEjercicio`, `idFacilitador`, `idPersona`, `fechaAsignacionEjercicio`, `fechaCorreccion`, `comentario`, `archivoAdjuntoCorreccion`, `valoracionFacilitador`) VALUES
(7, 3, 7, '2020-12-18 19:31:08', '2020-12-18', 'Perfecto hahaha', 'data/upload/muybien.png', 5);

-- --------------------------------------------------------

--
-- Table structure for table `Crea_Ejercicio`
--

CREATE TABLE `Crea_Ejercicio` (
  `idEjercicio` int UNSIGNED NOT NULL,
  `idFacilitador` int UNSIGNED NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` text,
  `multimediaAdjunto` varchar(100) DEFAULT NULL,
  `imagenAdjunta` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Crea_Ejercicio`
--

INSERT INTO `Crea_Ejercicio` (`idEjercicio`, `idFacilitador`, `fechaCreacion`, `titulo`, `categoria`, `fecha`, `descripcion`, `multimediaAdjunto`, `imagenAdjunta`) VALUES
(5, 3, '2020-12-18 00:00:00', 'Lavar los platos', NULL, NULL, 'Teneis que lavar los platos y dejarlos en el fregadero', NULL, './data/upload/platos.png'),
(7, 3, '2020-12-18 00:00:00', 'Lavarse las manos', NULL, NULL, 'Debeis lavaros las manos como sale en el vídeo. Es muy importante por el coronavirus!', './data/upload/Cómo lavarse las manos correctamente.mp4', './data/upload/lavar las manos.png');

-- --------------------------------------------------------

--
-- Table structure for table `Crea_Grupo`
--

CREATE TABLE `Crea_Grupo` (
  `idGrupo` int UNSIGNED NOT NULL,
  `idFacilitador` int UNSIGNED NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Crea_Grupo`
--

INSERT INTO `Crea_Grupo` (`idGrupo`, `idFacilitador`, `fechaCreacion`, `nombre`) VALUES
(10, 3, '2020-12-18 00:00:00', 'Excursiones'),
(11, 3, '2020-12-18 00:00:00', 'Tareas del hogar'),
(12, 3, '2020-12-18 00:00:00', 'Ejercicios Basicos'),
(13, 3, '2020-12-18 00:00:00', 'Ejercicios Avanzados'),
(14, 3, '2020-12-18 00:00:00', 'Comun');

-- --------------------------------------------------------

--
-- Table structure for table `Facilitador`
--

CREATE TABLE `Facilitador` (
  `idFacilitador` int UNSIGNED NOT NULL,
  `tlfFacilitador` varchar(10) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `contraseña` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Facilitador`
--

INSERT INTO `Facilitador` (`idFacilitador`, `tlfFacilitador`, `nombre`, `contraseña`) VALUES
(3, '645396954', 'Miguel Muñoz Molina', '$2y$10$TBjaRdqNKCHOUSMqftajmOpO2Qjo4MyvpZZ8Juk6z4kaYQ70rbguS'),
(4, '644784962', 'Darío Megías Guerrero', '$2y$10$gYTLZ2.1W8qS8lInLpYnROX7Crxtkcep9ydxmMZYydCFEFak5yTOq');

-- --------------------------------------------------------

--
-- Table structure for table `GestionaFacilitador`
--

CREATE TABLE `GestionaFacilitador` (
  `idAdministrador` int UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `idFacilitador` int UNSIGNED NOT NULL,
  `tipoGestion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `GestionaPersona`
--

CREATE TABLE `GestionaPersona` (
  `idAdministrador` int UNSIGNED NOT NULL,
  `fecha` date NOT NULL,
  `idPersona` int UNSIGNED NOT NULL,
  `tipoGestion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Persona`
--

CREATE TABLE `Persona` (
  `idPersona` int UNSIGNED NOT NULL,
  `tlfPersona` varchar(10) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `contraseña` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Persona`
--

INSERT INTO `Persona` (`idPersona`, `tlfPersona`, `nombre`, `contraseña`) VALUES
(4, '756342532', 'Sergio Campos Megías', '$2y$10$cGoCSlCTEEgmODnYodrHVeUnaMlHwc2X.ojCFR5lCLaduM4vjpyRe'),
(5, '746333955', 'Francisco Domínguez Lorente', '$2y$10$BDI2nvmD6YwsAnzPdxOUz.KexGJUx4cIEkyvD8Fzu7qs.NTzixrhC'),
(6, '654876543', 'Francisco Javier Casado de Amezúa', '$2y$10$sB1dYAPr7XS1CS3tvXPCP.GH2BgUlQhawe3dC5EQzECpVyrMUhvyC'),
(7, '643930954', 'Miguel Posadas Arráez', '$2y$10$SkKpLEAlMHLWAVd534bBXe28F1LjBj8C/uwXDyQQIRj.0Jp6momTS'),
(8, '745000765', 'Jose Luis Gallego Peña', '$2y$10$VGaKii748z.VmerqOYvRteIx6oWN8hqBnwq.He1S3VVC6KPHUKy4O');

-- --------------------------------------------------------

--
-- Table structure for table `Pertenece`
--

CREATE TABLE `Pertenece` (
  `idGrupo` int UNSIGNED NOT NULL,
  `idPersona` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Pertenece`
--

INSERT INTO `Pertenece` (`idGrupo`, `idPersona`) VALUES
(10, 4),
(11, 4),
(12, 4),
(14, 4),
(11, 5),
(13, 5),
(14, 5),
(11, 6),
(13, 6),
(14, 6),
(10, 7),
(11, 7),
(13, 7),
(14, 7),
(10, 8),
(11, 8),
(13, 8),
(14, 8);

-- --------------------------------------------------------

--
-- Table structure for table `Resuelve_Asigna`
--

CREATE TABLE `Resuelve_Asigna` (
  `idEjercicio` int UNSIGNED NOT NULL,
  `idPersona` int UNSIGNED NOT NULL,
  `fechaAsignacion` datetime NOT NULL,
  `idFacilitador` int UNSIGNED NOT NULL,
  `texto` text,
  `fechaResolucion` date DEFAULT NULL,
  `valoracionPersona` int DEFAULT NULL,
  `feedbackEjercicio` text,
  `archivoAdjuntoSolucion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Resuelve_Asigna`
--

INSERT INTO `Resuelve_Asigna` (`idEjercicio`, `idPersona`, `fechaAsignacion`, `idFacilitador`, `texto`, `fechaResolucion`, `valoracionPersona`, `feedbackEjercicio`, `archivoAdjuntoSolucion`) VALUES
(5, 7, '2020-12-18 19:42:02', 3, 'Me han quedado perfectos!', '2020-12-25', 5, NULL, './data/upload/'),
(7, 7, '2020-12-18 19:31:08', 3, 'Bien hecho!!!', '2020-12-21', 5, NULL, './data/upload/manos_lavadas.png');

-- --------------------------------------------------------

--
-- Table structure for table `Tiene_Chat`
--

CREATE TABLE `Tiene_Chat` (
  `idChat` int UNSIGNED NOT NULL,
  `idEjercicio` int UNSIGNED NOT NULL,
  `idPersona` int UNSIGNED NOT NULL,
  `fechaAsignacion` datetime DEFAULT NULL,
  `idFacilitador` int UNSIGNED DEFAULT NULL,
  `ruta` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `Tiene_Chat`
--

INSERT INTO `Tiene_Chat` (`idChat`, `idEjercicio`, `idPersona`, `fechaAsignacion`, `idFacilitador`, `ruta`) VALUES
(6, 7, 7, '2020-12-18 19:31:08', 3, 'data/upload/exercises/7/chat/6/chat.json'),
(7, 5, 7, '2020-12-18 19:42:02', 3, 'data/upload/exercises/5/chat/7/chat.json');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Administrador`
--
ALTER TABLE `Administrador`
  ADD PRIMARY KEY (`idAdministrador`),
  ADD UNIQUE KEY `tlfAdministrador` (`tlfAdministrador`);

--
-- Indexes for table `Corrige`
--
ALTER TABLE `Corrige`
  ADD PRIMARY KEY (`idEjercicio`,`idFacilitador`,`idPersona`,`fechaAsignacionEjercicio`) USING BTREE;

--
-- Indexes for table `Crea_Ejercicio`
--
ALTER TABLE `Crea_Ejercicio`
  ADD PRIMARY KEY (`idEjercicio`,`idFacilitador`),
  ADD KEY `idFacilitador` (`idFacilitador`);

--
-- Indexes for table `Crea_Grupo`
--
ALTER TABLE `Crea_Grupo`
  ADD PRIMARY KEY (`idGrupo`,`idFacilitador`) USING BTREE,
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `idFacilitador` (`idFacilitador`);

--
-- Indexes for table `Facilitador`
--
ALTER TABLE `Facilitador`
  ADD PRIMARY KEY (`idFacilitador`),
  ADD UNIQUE KEY `tlfFacilitador` (`tlfFacilitador`);

--
-- Indexes for table `GestionaFacilitador`
--
ALTER TABLE `GestionaFacilitador`
  ADD PRIMARY KEY (`idAdministrador`,`fecha`),
  ADD UNIQUE KEY `idFacilitador` (`idFacilitador`);

--
-- Indexes for table `GestionaPersona`
--
ALTER TABLE `GestionaPersona`
  ADD PRIMARY KEY (`idAdministrador`,`fecha`),
  ADD UNIQUE KEY `idPersona` (`idPersona`);

--
-- Indexes for table `Persona`
--
ALTER TABLE `Persona`
  ADD PRIMARY KEY (`idPersona`),
  ADD UNIQUE KEY `contraseña` (`contraseña`),
  ADD UNIQUE KEY `tlfPersona` (`tlfPersona`);

--
-- Indexes for table `Pertenece`
--
ALTER TABLE `Pertenece`
  ADD PRIMARY KEY (`idGrupo`,`idPersona`),
  ADD KEY `idPersona` (`idPersona`);

--
-- Indexes for table `Resuelve_Asigna`
--
ALTER TABLE `Resuelve_Asigna`
  ADD PRIMARY KEY (`idEjercicio`,`idPersona`,`fechaAsignacion`,`idFacilitador`) USING BTREE,
  ADD UNIQUE KEY `idEjercicio_2` (`idEjercicio`,`idFacilitador`,`idPersona`,`fechaAsignacion`) USING BTREE,
  ADD KEY `idFacilitador` (`idFacilitador`),
  ADD KEY `idEjercicio` (`idEjercicio`) USING BTREE,
  ADD KEY `idPersona` (`idPersona`) USING BTREE,
  ADD KEY `fechaAsignacion` (`fechaAsignacion`) USING BTREE;

--
-- Indexes for table `Tiene_Chat`
--
ALTER TABLE `Tiene_Chat`
  ADD PRIMARY KEY (`idChat`),
  ADD KEY `fechaAsignacion` (`fechaAsignacion`),
  ADD KEY `idFacilitador` (`idFacilitador`),
  ADD KEY `idPersona` (`idPersona`) USING BTREE,
  ADD KEY `idEjercicio` (`idEjercicio`) USING BTREE,
  ADD KEY `idEjercicio_2` (`idEjercicio`,`idFacilitador`,`idPersona`,`fechaAsignacion`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Administrador`
--
ALTER TABLE `Administrador`
  MODIFY `idAdministrador` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Crea_Ejercicio`
--
ALTER TABLE `Crea_Ejercicio`
  MODIFY `idEjercicio` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `Crea_Grupo`
--
ALTER TABLE `Crea_Grupo`
  MODIFY `idGrupo` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `Facilitador`
--
ALTER TABLE `Facilitador`
  MODIFY `idFacilitador` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Persona`
--
ALTER TABLE `Persona`
  MODIFY `idPersona` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `Tiene_Chat`
--
ALTER TABLE `Tiene_Chat`
  MODIFY `idChat` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Corrige`
--
ALTER TABLE `Corrige`
  ADD CONSTRAINT `Corrige_ibfk_1` FOREIGN KEY (`idEjercicio`,`idFacilitador`,`idPersona`,`fechaAsignacionEjercicio`) REFERENCES `Resuelve_Asigna` (`idEjercicio`, `idFacilitador`, `idPersona`, `fechaAsignacion`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `Crea_Ejercicio`
--
ALTER TABLE `Crea_Ejercicio`
  ADD CONSTRAINT `Crea_Ejercicio_ibfk_1` FOREIGN KEY (`idFacilitador`) REFERENCES `Facilitador` (`idFacilitador`);

--
-- Constraints for table `Crea_Grupo`
--
ALTER TABLE `Crea_Grupo`
  ADD CONSTRAINT `Crea_Grupo_ibfk_1` FOREIGN KEY (`idFacilitador`) REFERENCES `Facilitador` (`idFacilitador`);

--
-- Constraints for table `GestionaFacilitador`
--
ALTER TABLE `GestionaFacilitador`
  ADD CONSTRAINT `GestionaFacilitador_ibfk_1` FOREIGN KEY (`idFacilitador`) REFERENCES `Facilitador` (`idFacilitador`);

--
-- Constraints for table `GestionaPersona`
--
ALTER TABLE `GestionaPersona`
  ADD CONSTRAINT `GestionaPersona_ibfk_1` FOREIGN KEY (`idAdministrador`) REFERENCES `Administrador` (`idAdministrador`),
  ADD CONSTRAINT `GestionaPersona_ibfk_2` FOREIGN KEY (`idPersona`) REFERENCES `Persona` (`idPersona`);

--
-- Constraints for table `Pertenece`
--
ALTER TABLE `Pertenece`
  ADD CONSTRAINT `Pertenece_ibfk_1` FOREIGN KEY (`idGrupo`) REFERENCES `Crea_Grupo` (`idGrupo`),
  ADD CONSTRAINT `Pertenece_ibfk_2` FOREIGN KEY (`idPersona`) REFERENCES `Persona` (`idPersona`);

--
-- Constraints for table `Resuelve_Asigna`
--
ALTER TABLE `Resuelve_Asigna`
  ADD CONSTRAINT `Resuelve_Asigna_ibfk_1` FOREIGN KEY (`idEjercicio`) REFERENCES `Crea_Ejercicio` (`idEjercicio`),
  ADD CONSTRAINT `Resuelve_Asigna_ibfk_2` FOREIGN KEY (`idPersona`) REFERENCES `Persona` (`idPersona`),
  ADD CONSTRAINT `Resuelve_Asigna_ibfk_3` FOREIGN KEY (`idFacilitador`) REFERENCES `Facilitador` (`idFacilitador`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `Tiene_Chat`
--
ALTER TABLE `Tiene_Chat`
  ADD CONSTRAINT `Tiene_Chat_ibfk_1` FOREIGN KEY (`idEjercicio`,`idFacilitador`,`idPersona`,`fechaAsignacion`) REFERENCES `Resuelve_Asigna` (`idEjercicio`, `idFacilitador`, `idPersona`, `fechaAsignacion`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
