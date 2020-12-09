INSERT INTO Administrador (tlfAdministrador,nombre,contraseña) VALUES ('666666666', 'elAdmin', 'elAdmin');
INSERT INTO Facilitador (tlfFacilitador, nombre, contraseña) VALUES ('777777777', 'elFaci', 'elFaci');
INSERT INTO Facilitador (tlfFacilitador, nombre, contraseña) VALUES ('222222222', 'elFaci2', 'elFaci2');
INSERT INTO Persona (tlfPersona, nombre, contraseña) VALUES ('888888888', 'laPersona', '123');
INSERT INTO Persona (tlfPersona, nombre, contraseña) VALUES ('999999999', 'Eufrasio de la Cuevas y Garmendia', '144');
INSERT INTO Persona (tlfPersona, nombre, contraseña) VALUES ('111111111', 'Consuelo Rodríguez Gamarra', '111');
INSERT INTO Crea_Grupo (idFacilitador,fechaCreacion,nombre) VALUES ((SELECT idFacilitador FROM Facilitador WHERE nombre = 'elFaci'), NOW(), 'Motricidad');
INSERT INTO Crea_Grupo (idFacilitador,fechaCreacion,nombre) VALUES ((SELECT idFacilitador FROM Facilitador WHERE nombre = 'elFaci2'), NOW(), 'Lavadora');
INSERT INTO Crea_Ejercicio (idFacilitador,fechaCreacion,titulo,categoria,fecha,descripcion,multimediaAdjunto,imagenAdjunta) VALUES ((SELECT idFacilitador FROM Facilitador WHERE nombre = 'elFaci'),NOW(),'Lavando la ropa blanca',NULL,NULL,'La ropa se lava metiéndola en la lavadora, luego...','unaRuta que se puede hacer con disparadors','otra ruta igual');
INSERT INTO Crea_Ejercicio (idFacilitador,fechaCreacion,titulo,categoria,fecha,descripcion,multimediaAdjunto,imagenAdjunta) VALUES ((SELECT idFacilitador FROM Facilitador WHERE nombre = 'elFaci2'),NOW(),'Usando Facebook',NULL,NULL,'Vamos a crearnos una cuenta...','pues eso','otra ruta semejante');

INSERT INTO
    Resuelve_Asigna (idEjercicio,idPersona,fechaAsignacion,idFacilitador,texto,fechaResolucion,valoracionPersona,archivoAdjuntoSolucion)
    VALUES (1,(SELECT idPersona FROM Persona WHERE nombre = 'laPersona'),NOW(),(SELECT idFacilitador FROM Facilitador WHERE nombre = 'elFaci'),NULL,NULL,NULL,NULL);

INSERT INTO
    Resuelve_Asigna (idEjercicio,idPersona,fechaAsignacion,idFacilitador,texto,fechaResolucion,valoracionPersona,archivoAdjuntoSolucion)
    VALUES (2,(SELECT idPersona FROM Persona WHERE nombre = 'Consuelo Rodríguez Gamarra'),NOW(),(SELECT idFacilitador FROM Facilitador WHERE nombre = 'elFaci2'),NULL,NULL,NULL,NULL);

INSERT INTO Pertenece (idGrupo,idPersona) VALUES ((SELECT idGrupo FROM Crea_Grupo WHERE nombre = 'Motricidad'),(SELECT idPersona FROM Persona WHERE nombre = 'laPersona'));
INSERT INTO Pertenece (idGrupo,idPersona) VALUES ((SELECT idGrupo FROM Crea_Grupo WHERE nombre = 'Motricidad'),(SELECT idPersona FROM Persona WHERE nombre = 'Consuelo Rodríguez Gamarra'));
INSERT INTO Pertenece (idGrupo,idPersona) VALUES ((SELECT idGrupo FROM Crea_Grupo WHERE nombre = 'Lavadora'),(SELECT idPersona FROM Persona WHERE nombre = 'Eufrasio de la Cuevas y Garmendia'));
INSERT INTO Pertenece (idGrupo,idPersona) VALUES ((SELECT idGrupo FROM Crea_Grupo WHERE nombre = 'Lavadora'),(SELECT idPersona FROM Persona WHERE nombre = 'laPersona'));
INSERT INTO Corrige () VALUES ();
INSERT INTO Corrige () VALUES ();
INSERT INTO Tiene_Chat () VALUES ();
INSERT INTO Tiene_Chat () VALUES ();


/*
Quitar categoría, fecha en Crea_ejercicio
*/
