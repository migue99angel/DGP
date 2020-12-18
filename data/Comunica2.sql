-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Dec 17, 2020 at 05:09 PM
-- Server version: 8.0.19
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `contraseña` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `Facilitador`
--

CREATE TABLE `Facilitador` (
  `idFacilitador` int UNSIGNED NOT NULL,
  `tlfFacilitador` varchar(10) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `contraseña` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `contraseña` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Pertenece`
--

CREATE TABLE `Pertenece` (
  `idGrupo` int UNSIGNED NOT NULL,
  `idPersona` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  ADD PRIMARY KEY (`idEjercicio`,`idFacilitador`,`idPersona`,`fechaAsignacionEjercicio`) USING BTREE,
  ADD UNIQUE KEY `idFacilitador` (`idFacilitador`),
  ADD UNIQUE KEY `idPersona` (`idPersona`),
  ADD KEY `fechaAsignacionEjercicio` (`fechaAsignacionEjercicio`);

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
  ADD KEY `idEjercicio` (`idEjercicio`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Administrador`
--
ALTER TABLE `Administrador`
  MODIFY `idAdministrador` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Crea_Ejercicio`
--
ALTER TABLE `Crea_Ejercicio`
  MODIFY `idEjercicio` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Crea_Grupo`
--
ALTER TABLE `Crea_Grupo`
  MODIFY `idGrupo` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Facilitador`
--
ALTER TABLE `Facilitador`
  MODIFY `idFacilitador` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Persona`
--
ALTER TABLE `Persona`
  MODIFY `idPersona` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Tiene_Chat`
--
ALTER TABLE `Tiene_Chat`
  MODIFY `idChat` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Corrige`
--
ALTER TABLE `Corrige`
  ADD CONSTRAINT `Corrige_ibfk_1` FOREIGN KEY (`idEjercicio`) REFERENCES `Resuelve_Asigna` (`idEjercicio`),
  ADD CONSTRAINT `Corrige_ibfk_2` FOREIGN KEY (`idFacilitador`) REFERENCES `Facilitador` (`idFacilitador`),
  ADD CONSTRAINT `Corrige_ibfk_3` FOREIGN KEY (`idPersona`) REFERENCES `Resuelve_Asigna` (`idPersona`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Corrige_ibfk_4` FOREIGN KEY (`fechaAsignacionEjercicio`) REFERENCES `Resuelve_Asigna` (`fechaAsignacion`) ON DELETE RESTRICT ON UPDATE RESTRICT;

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
  ADD CONSTRAINT `Tiene_Chat_ibfk_1` FOREIGN KEY (`idEjercicio`) REFERENCES `Resuelve_Asigna` (`idEjercicio`),
  ADD CONSTRAINT `Tiene_Chat_ibfk_2` FOREIGN KEY (`idPersona`) REFERENCES `Resuelve_Asigna` (`idPersona`),
  ADD CONSTRAINT `Tiene_Chat_ibfk_3` FOREIGN KEY (`fechaAsignacion`) REFERENCES `Resuelve_Asigna` (`fechaAsignacion`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `Tiene_Chat_ibfk_4` FOREIGN KEY (`idFacilitador`) REFERENCES `Resuelve_Asigna` (`idFacilitador`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
