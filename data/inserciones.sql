INSERT INTO Administrador (tlfAdministrador,nombre,contraseña) VALUES ('666666666', 'elAdmin', 'elAdmin');
INSERT INTO Facilitador (tlfFacilitador, nombre, contraseña) VALUES ('777777777', 'elFaci', 'elFaci');
INSERT INTO Facilitador (tlfFacilitador, nombre, contraseña) VALUES ('222222222', 'elFaci2', 'elFaci2');
INSERT INTO Persona (tlfPersona, nombre, contraseña) VALUES ('888888888', 'laPersona', 'laPersona');
INSERT INTO Persona (tlfPersona, nombre, contraseña) VALUES ('999999999', 'Eufrasio de la Cuevas y Garmendia', 'eufrasio');
INSERT INTO Persona (tlfPersona, nombre, contraseña) VALUES ('111111111', 'Consuelo Rodríguez Gamarra', 'consuelo');
INSERT INTO Crea_Grupo (idFacilitador,fechaCreacion,nombre) VALUES ((SELECT idFacilitador FROM Facilitador WHERE nombre = 'elFaci'), NOW(), 'Motricidad');
INSERT INTO Crea_Grupo (idFacilitador,fechaCreacion,nombre) VALUES ((SELECT idFacilitador FROM Facilitador WHERE nombre = 'elFaci2', NOW(), 'Lavadora');
INSERT INTO Crea_Ejercicio (idFacilitador,fechaCreacion,titulo,categoria,fecha,descripcion,multimediaAdjunto,imagenAdjunta) VALUES ((SELECT idFacilitador FROM Facilitador WHERE nombre = 'elFaci'),NOW(),'Lavando la ropa blanca',NULL,NULL,'La ropa se lava metiéndola en la lavadora, luego...','unaRuta que se puede hacer con disparadors','otra ruta igual');
INSERT INTO Crea_Ejercicio (idFacilitador,fechaCreacion,titulo,categoria,fecha,descripcion,multimediaAdjunto,imagenAdjunta) VALUES ((SELECT idFacilitador FROM Facilitador WHERE nombre = 'elFaci2'),NOW(),'Usando Facebook',NULL,NULL,'Vamos a crearnos una cuenta...','pues eso','otra ruta semejante');
INSERT INTO Asigna (idEjercicio,fechaAsignacion,idFacilitador,idPersona) VALUES (1,NOW(),(SELECT idFacilitador FROM Facilitador WHERE nombre = 'elFaci'),(SELECT idPersona FROM Persona WHERE nombre = 'laPersona'));
INSERT INTO Asigna (idEjercicio,fechaAsignacion,idFacilitador,idPersona) VALUES (2,NOW(),(SELECT idFacilitador FROM Facilitador WHERE nombre = 'elFaci2'),(SELECT idPersona FROM Persona WHERE nombre = 'Consuelo Rodríguez Gamarra'));
INSERT INTO Resuelve () VALUES ();
INSERT INTO Resuelve () VALUES ();
INSERT INTO Corrige () VALUES ();
INSERT INTO Corrige () VALUES ();
INSERT INTO Pertenece () VALUES ();
INSERT INTO Pertenece () VALUES ();
INSERT INTO Pertenece () VALUES ();
INSERT INTO Tiene_Chat () VALUES ();
INSERT INTO Tiene_Chat () VALUES ();


/*
Quitar categoría, fecha en Crea_ejercicio
*/
