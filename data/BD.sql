/*Autor: José Luis Gallego Peña*/
/*Autor: Darío Megías Guerrero*/


DROP DATABASE IF EXISTS Comunica2;

CREATE DATABASE IF NOT EXISTS Comunica2;

USE Comunica2;

CREATE TABLE Crea_Ejercicio(
    IDejercicio INT NOT NULL AUTO_INCREMENT,
    IDfacilitador INT NOT NULL,
    TlfFacilitador VARCHAR(10) UNIQUE,
    FechaCreacion DATE NOT NULL,
    Titulo VARCHAR(100) NOT NULL,
    Categoria VARCHAR(100),
    Fecha DATE,
    Descripcion TEXT(1000),
    archivoAdjunto VARCHAR(100),
    PRIMARY KEY (IDejercicio, IDfacilitador)
);

CREATE TABLE Persona(
    IDpersona INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TlfPersona VARCHAR(10) UNIQUE,
    Nombre VARCHAR(100) NOT NULL,
    Contraseña VARCHAR(100) NOT NULL
);

CREATE TABLE Resuelve(
    IDejercicio INT NOT NULL PRIMARY KEY,
    IDpersona INT NOT NULL UNIQUE,
    TlfPersona VARCHAR(10) UNIQUE,
    Texto TEXT(1000),
    FechaResolucion DATE NOT NULL,
    ValoracionPersona INT,
    ArchivoAdjuntoSolucion VARCHAR(100),
    FOREIGN KEY (IDejercicio) REFERENCES Crea_Ejercicio(IDejercicio),
    FOREIGN KEY (IDpersona) REFERENCES Persona(IDpersona),
    FOREIGN KEY (TlfPersona) REFERENCES Persona(TlfPersona)
);

CREATE TABLE Administrador(
    IDadministrador INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TlfAdministrador VARCHAR(10) UNIQUE,
    Nombre VARCHAR(100) NOT NULL,
    Contraseña VARCHAR(100) NOT NULL
);

CREATE TABLE GestionaPersona(
    IDadministrador INT NOT NULL,
    Fecha DATE NOT NULL,
    TlfAdministrador VARCHAR(10) UNIQUE,
    IDpersona INT NOT NULL UNIQUE,
    TlfPersona VARCHAR(10) UNIQUE,
    TipoGestion VARCHAR(30) NOT NULL,
    PRIMARY KEY (IDadministrador, Fecha),
    FOREIGN KEY (IDadministrador) REFERENCES Administrador(IDadministrador),
    FOREIGN KEY (TlfAdministrador) REFERENCES Administrador(TlfAdministrador),
    FOREIGN KEY (IDpersona) REFERENCES Persona(IDpersona),
    FOREIGN KEY (TlfPersona) REFERENCES Persona(TlfPersona)
);

CREATE TABLE Facilitador(
    IDfacilitador INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TlfFacilitador VARCHAR(10) UNIQUE,
    Nombre VARCHAR(100) NOT NULL,
    Contraseña VARCHAR(100) NOT NULL
);

CREATE TABLE Asigna(
    IDejercicio INT NOT NULL,
    FechaAsignacion DATE NOT NULL,
    IDfacilitador INT NOT NULL UNIQUE,
    TlfFacilitador VARCHAR(10) UNIQUE,
    IDpersona INT NOT NULL UNIQUE,
    TlfPersona VARCHAR(10) UNIQUE,
    PRIMARY KEY (IDejercicio, FechaAsignacion),
    FOREIGN KEY (IDejercicio) REFERENCES Resuelve(IDejercicio),
    FOREIGN KEY (IDfacilitador) REFERENCES Facilitador(IDfacilitador),
    FOREIGN KEY (TlfFacilitador) REFERENCES Facilitador(TlfFacilitador),
    FOREIGN KEY (IDpersona) REFERENCES Persona(IDpersona),
    FOREIGN KEY (IDpersona) REFERENCES Persona(IDpersona)
);

CREATE TABLE GestionaFacilitador(
    IDadministrador INT NOT NULL,
    Fecha DATE NOT NULL,
    TlfAdministrador VARCHAR(10) UNIQUE,
    IDfacilitador INT NOT NULL UNIQUE,
    TlfFacilitador VARCHAR(10) UNIQUE,
    TipoGestion VARCHAR(30) NOT NULL,
    PRIMARY KEY (IDadministrador, Fecha),
    FOREIGN KEY (TlfAdministrador) REFERENCES Administrador(TlfAdministrador),
    FOREIGN KEY (IDfacilitador) REFERENCES Facilitador(IDfacilitador),
    FOREIGN KEY (TlfFacilitador) REFERENCES Facilitador(TlfFacilitador)
);

CREATE TABLE Corrige(
    IDejercicio INT NOT NULL PRIMARY KEY,
    IDfacilitador INT NOT NULL UNIQUE,
    TlfFacilitador VARCHAR(10) UNIQUE,
    IDpersona INT NOT NULL UNIQUE,
    TlfPersona VARCHAR(10) UNIQUE,
    FechaCorreccion DATE NOT NULL,
    Comentario TEXT(1000),
    ArchivoAdjuntoCorreccion VARCHAR(100),
    ValoracionFacilitador INT,
    FOREIGN KEY (IDejercicio) REFERENCES Resuelve(IDejercicio),
    FOREIGN KEY (IdFacilitador) REFERENCES Facilitador(IdFacilitador),
    FOREIGN KEY (TlfFacilitador) REFERENCES Facilitador(TlfFacilitador),
    FOREIGN KEY (IDpersona) REFERENCES Persona(IDpersona),
    FOREIGN KEY (IDpersona) REFERENCES Persona(IDpersona)
);

CREATE TABLE Crea_Grupo(
    IDgrupo INT NOT NULL AUTO_INCREMENT,
    IDfacilitador INT NOT NULL,
    TlfFacilitador VARCHAR(10) NOT NULL UNIQUE,
    FechaCreacion DATE NOT NULL,
    Nombre VARCHAR(100) NOT NULL,
    PRIMARY KEY (IDgrupo, IDfacilitador),
    FOREIGN KEY (IDfacilitador) REFERENCES Facilitador(IDfacilitador),
    FOREIGN KEY (TlfFacilitador) REFERENCES Facilitador(TlfFacilitador)
);

CREATE TABLE Pertence(
    IDgrupo INT NOT NULL,
    IDpersona INT NOT NULL,
    TlfPersona VARCHAR(10) UNIQUE,
    PRIMARY KEY (IDgrupo, IDpersona),
    FOREIGN KEY (IDgrupo) REFERENCES Crea_Grupo(IDgrupo),
    FOREIGN KEY (IDpersona) REFERENCES Persona(IDpersona),
    FOREIGN KEY (TlfPersona) REFERENCES Persona(TlfPersona)
);

CREATE TABLE Tiene_Chat(
    IDchat INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    IDejercicio INT NOT NULL UNIQUE,
    IDpersona INT NOT NULL UNIQUE,
    TlfPersona VARCHAR(10) UNIQUE,
    Ruta VARCHAR(1000),
    FOREIGN KEY (IDejercicio) REFERENCES Resuelve(IDejercicio),
    FOREIGN KEY (IDpersona) REFERENCES Resuelve(IDpersona),
    FOREIGN KEY (TlfPersona) REFERENCES Resuelve(TlfPersona)
);
