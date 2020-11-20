CREATE TABLE Persona(
    idPersona INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tlfPersona VARCHAR(10) UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    contraseña VARCHAR(100) NOT NULL
);

CREATE TABLE Administrador(
    idAdministrador INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tlfAdministrador VARCHAR(10) UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    contraseña VARCHAR(100) NOT NULL
);

CREATE TABLE Facilitador(
    idFacilitador INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tlfFacilitador VARCHAR(10) UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    contraseña VARCHAR(100) NOT NULL
);

CREATE TABLE Crea_Ejercicio(
    idEjercicio INT NOT NULL AUTO_INCREMENT,
    idFacilitador INT NOT NULL,
    fechaCreacion DATE NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    categoria VARCHAR(100),
    fecha DATE,
    descripcion TEXT(1000),
    archivoAdjunto VARCHAR(100),
    PRIMARY KEY (idEjercicio, idFacilitador),
    FOREIGN KEY (idFacilitador) REFERENCES Facilitador(idFacilitador)
);



CREATE TABLE Resuelve(
    idEjercicio INT NOT NULL PRIMARY KEY,
    idPersona INT NOT NULL UNIQUE,
    texto TEXT(1000),
    fechaResolucion DATE NOT NULL,
    valoracionPersona INT,
    archivoAdjuntoSolucion VARCHAR(100),
    FOREIGN KEY (idEjercicio) REFERENCES Crea_Ejercicio(idEjercicio),
    FOREIGN KEY (idPersona) REFERENCES Persona(idPersona)
);



CREATE TABLE GestionaPersona(
    idAdministrador INT NOT NULL,
    fecha DATE NOT NULL,
    idPersona INT NOT NULL UNIQUE,
    tipoGestion VARCHAR(30) NOT NULL,
    PRIMARY KEY (idAdministrador, fecha),
    FOREIGN KEY (idAdministrador) REFERENCES Administrador(idAdministrador),
    FOREIGN KEY (idPersona) REFERENCES Persona(idPersona)
);


CREATE TABLE Asigna(
    idEjercicio INT NOT NULL,
    fechaAsignacion DATE NOT NULL,
    idFacilitador INT NOT NULL UNIQUE,
    idPersona INT NOT NULL UNIQUE,
    PRIMARY KEY (idEjercicio, fechaAsignacion),
    FOREIGN KEY (idEjercicio) REFERENCES Resuelve(idEjercicio),
    FOREIGN KEY (idFacilitador) REFERENCES Facilitador(idFacilitador),
    FOREIGN KEY (idPersona) REFERENCES Persona(idPersona),
    FOREIGN KEY (idPersona) REFERENCES Persona(idPersona)
);

CREATE TABLE GestionaFacilitador(
    idAdministrador INT NOT NULL,
    fecha DATE NOT NULL,
    idFacilitador INT NOT NULL UNIQUE,
    tipoGestion VARCHAR(30) NOT NULL,
    PRIMARY KEY (idAdministrador, fecha),
    FOREIGN KEY (idFacilitador) REFERENCES Facilitador(idFacilitador)
);

CREATE TABLE Corrige(
    idEjercicio INT NOT NULL PRIMARY KEY,
    idFacilitador INT NOT NULL UNIQUE,
    idPersona INT NOT NULL UNIQUE,
    fechaCorreccion DATE NOT NULL,
    comentario TEXT(1000),
    archivoAdjuntoCorreccion VARCHAR(100),
   valoracionFacilitador INT,
    FOREIGN KEY (idEjercicio) REFERENCES Resuelve(idEjercicio),
    FOREIGN KEY (idFacilitador) REFERENCES Facilitador(idFacilitador),
    FOREIGN KEY (idPersona) REFERENCES Persona(idPersona)
);

CREATE TABLE Crea_Grupo(
    idGrupo INT NOT NULL AUTO_INCREMENT,
    idFacilitador INT NOT NULL,
    fechaCreacion DATE NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    PRIMARY KEY (idGrupo, idFacilitador),
    FOREIGN KEY (idFacilitador) REFERENCES Facilitador(idFacilitador)
);

CREATE TABLE Pertence(
    idGrupo INT NOT NULL,
    idPersona INT NOT NULL,
    PRIMARY KEY (idGrupo, idPersona),
    FOREIGN KEY (idGrupo) REFERENCES Crea_Grupo(idGrupo),
    FOREIGN KEY (idPersona) REFERENCES Persona(idPersona)
);
CREATE TABLE Tiene_Chat(
    idChat INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idEjercicio INT NOT NULL UNIQUE,
    idPersona INT NOT NULL UNIQUE,
    ruta VARCHAR(1000),
    FOREIGN KEY (idEjercicio) REFERENCES Resuelve(idEjercicio),
    FOREIGN KEY (idPersona) REFERENCES Resuelve(idPersona)
);















































