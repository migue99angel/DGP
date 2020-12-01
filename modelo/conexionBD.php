<?php
    require "administrador.php";
    require "facilitador.php";
    require "persona.php";
    require "grupos.php";
    require "ejercicio.php";
    /**
     * @class ConexionBD
     * @author Miguel Ángel Posadas
     */
    class ConexionBD
    {
        private $conexion; //Conexión a la base de datos
         /**
         * @method Constructor por defecto
         * @author Miguel Ángel Posadas
         */
        public function __construct()
        {
            //Aquí cada uno tiene que introducir sus credenciales para acceder a la base de datos
            $this->$conexion = new mysqli("mysql", "equipomumos", "practicasDGP", "Comunica2");

            if($conexion->connect_errno)
            {
                echo("Fallo al conectar: " . $conexion->connect_errno);
            }
        }

        /**
         * @method cargarPersona crea una instancia de un objeto persona cuyo id es el pasado como parámetro
         * @author Miguel Ángel Posadas
         * @param idPersona El identificador de la persona que se va a cargar
         * @return persona El persona
         */
        public function cargarPersona($idPersona)
        {
            $res = $this->$conexion->query("SELECT * from Persona WHERE idPersona='" . $idPersona . "'");

             /* Con esto tenemos un array multidimensional para obtener todos los comentarios a la vez */
            if($res->num_rows > 0) 
            {
                $row = $res->fetch_assoc();
                $persona = new Persona($row['idPersona'],$row['nombre']);
            }

            $persona->setChat($this->cargarChatsPersona($idPersona));
            $persona->setGrupo($this->cargarGruposPersona($idPersona));
            $persona->setEjercicios($this->cargarEjerciciosPersona($idPersona));

            return $persona;

        }

        /**
         * @method cargarChatsPersona obtiene todos los chats correspondientes a una persona
         * @author Miguel Ángel Posadas
         * @param idPersona El identificador de la persona que se va a cargar
         * @return chats Array con los chats de la persona
         */
        public function cargarChatsPersona($idPersona)
        {
            $res = $this->$conexion->query("SELECT * from Tiene_Chat WHERE idPersona='" . $idPersona . "'");
            $chats = array();
            $i = 0;

            while($row = $res->fetch_assoc())
            {
                $aux = new Chat($row['idChat'],$row['idEjercicio'],$row['idPersona']);
                $chats[$i] = $aux;
                $i += 1;
            }

            return $chats;
        }

        /**
         * @method cargarGruposPersona obtiene todos los grupos correspondientes a una persona
         * @author Miguel Ángel Posadas
         * @param idPersona El identificador de la persona que se va a cargar
         * @return grupos Array con los grupos de la persona
         */
        public function cargarGruposPersona($idPersona)
        {
            $res = $this->$conexion->query("SELECT * from Pertenece WHERE idPersona=$idPersona");
            $grupos = array();
            $i = 0;
            
            while($row = $res->fetch_assoc())
            {
                $grupos[$i] = $this->cargarGrupo($row['idGrupo']);
                $i += 1;
            }

            return $grupos;
        }

        /**
         * @method cargarGrupo obtiene todos el grupo correspondientes a un idGrupo
         * @author Miguel Ángel Posadas
         * @param idGrupo El identificador del grupo
         * @return grupo Objeto de la clase Grupos
         */
        public function cargarGrupo($idGrupo)
        {
            $res = $this->$conexion->query("SELECT * from Pertenece WHERE idGrupo=$idGrupo");
            $participantes = array();
            $i = 0;

            while($row = mysqli_fetch_row($res))
            {
                $participantes[$i] = $row['idPersona'];
                $i += 1;
            }

            $res = $this->$conexion->query("SELECT * from Crea_Grupo WHERE idGrupo=$idGrupo");
            if($res->num_rows > 0) 
            {
                $row = $res->fetch_assoc();
                $nombreGrupo = $row['nombre'];
            }

            $grupo = new Grupos($nombreGrupo,$participantes,$idGrupo);

            return $grupo;
        }

        /**
         * @method cargarEjerciciosPersona obtiene todas las ejercicios de una persona
         * @author Miguel Ángel Posadas
         * @param idPersona El identificador de la persona
         * @return ejercicios Array de objetos de la clase ejercicio
         */
        public function cargarEjerciciosPersona()
        {
            $res = $this->$conexion->query("SELECT * from Asigna WHERE idPersona='" . $idPersona . "'");
            $ejercicios = array();
            $i = 0;
            
            while($row = mysqli_fetch_row($res))
            {
                $ejercicios[$i] = cargarEjercicio($row['idEjercicio']);
                $i += 1;
            }

            return $ejercicios;
        }

        /**
         * @method cargarEjercicio Crea un objeto de la clase Ejercicio para un idEjercicio pasado
         * @author Miguel Ángel Posadas
         * @param idEjercicio
         * @return ejercicio Obejto de la clase Ejercicio
         */
        public function cargarEjercicio($idEjecicio)
        {
            $res = $this->$conexion->query("SELECT * from Crea_Ejercicio WHERE idEjercicio='" . $idEjercicio . "'");
            $ejercicio = new Ejercicio();

            if($res->num_rows > 0) 
            {
                $row = $res->fetch_assoc();
                $nombreEjercicio = $row['titulo'];
                $tipoEjercicio = $row['categoria'];
                $descripcion = $row['descripcion'];
                $fecha = $row['fecha'];
                $adjunto = $row['archivoAdjunto'];
                $ejercicio = new Ejercicio($nombreEjercicio, $tipoEjercicio, $descripcion, $fecha, $adjunto, $idEjercicio);
            }

            return $ejercicio;
            
        }

        /**
         * @method cargarEjerciciosResueltos Consulta todos los ejercicios que han sido resueltos y no han sido corregidos aún
         * @author Francisco Domínguez Lorente
         * @return ejercicios Array de los ejercicios resueltos que no han sido corregidos
         */
        public function cargarEjerciciosResueltos()
        {
            $res = $this->$conexion->query("SELECT * from Resuelve LEFT JOIN Corrige ON (Resuelve.idEjercicio = Corrige.idEjercicio AND Resuelve.idPersona = Corrige.idPersona");
            $ejercicios = array();

            while($row = mysqli_fetch_row($res)) {
                $ejercicios[] = $row;
            }

            return $ejercicios;
        }

        /**
         * @method corregirEjercicio Consulta todos los ejercicios que han sido resueltos y no han sido corregidos aún
         * @author Francisco Domínguez Lorente
         * @return resultado True en caso de registro False en caso contrario
         */
        public function corregirEjercicio($idEjercicio, $idFacilitador, $idPersona, $comentario, $adjunto, $valoracion)
        {
            $idEjercicio = $this->$conexion->real_escape_string($idEjecicio); 
            $idFacilitador = $this->$conexion->real_escape_string($idFacilitador); 
            $idPersona = $this->$conexion->real_escape_string($idPersona);
            $fechaCorrecion = date("Y-m-d");
            $comentario = $this->$conexion->real_escape_string($comentario);
            $adjunto = $this->$conexion->real_escape_string($adjunto);
            $valoracion = $this->$conexion->real_escape_string($valoracion);

            $res = $this->$conexion->query("INSERT INTO Corrige (idEjercicio, idFacilitador, idPersona, fechaCorrecion, comentario, archivoAdjuntoCorrecion, valoracionFacilitadorbre)
            VALUES ('$idEjercicio','$idFacilitador','$idPersona','$fechaCorrecion','$comentario','$adjunto','$valoracion')" ) ;

            return $res;
        }

        /**
         * Este método requiere que el controlador parsee los datos
         * @method inicioSesionPersona método que loguea en el sistema a una Persona
         * @author Miguel Ángel Posadas Arráez
         * @param pass String
         * @return persona Objeto de la clase Persona
         */
        public function inicioSesionPersona($pass)
        {
            $persona = null;
            $res = $this->$conexion->query("SELECT * from Persona WHERE contraseña= '". $pass ."' ");
            
            if($res->num_rows > 0) 
            {
                $row = $res->fetch_assoc();
                $persona = $this->cargarPersona($row['idPersona']);
            }

            return $persona;
        }

        /**
         * Este método requiere que el controlador parsee los datos
         * @method inicioSesionFacilitador método que loguea en el sistema a un Facilitador
         * @author Miguel Ángel Posadas Arráez
         * @param nombreFacilitador String
         * @param pass String
         * @return facilitador Objeto de la clase Facilitador
         */
        public function inicioSesionFacilitador($nombreFacilitador,$pass)
        {
            $facilitador = null;
            $res = $this->$conexion->query("SELECT * from Facilitador WHERE nombre='" . $nombreFacilitador . "' AND contraseña= '". $pass ."' ");
            
            if($res->num_rows > 0) 
            {
                $row = $res->fetch_assoc();
                $facilitador = new Facilitador($row['nombre'],$row['tlfFacilitador'],$row['idFacilitador']);
            }

            return $facilitador;
        }

        /**
         * Este método requiere que el controlador parsee los datos
         * @method inicioSesionAdministrador método que loguea en el sistema a un administrador
         * @author Miguel Ángel Posadas Arráez
         * @param nombreAdministrador String
         * @param pass String
         * @return administrador Objeto de la clase administrador
         */
        public function inicioSesionAdministrador($nombreAdministrador,$pass)
        {
            $admin = null;

            $res = $this->$conexion->query("SELECT * FROM Administrador WHERE nombre ='$nombreAdministrador' AND contraseña = '$pass'");

            if($res->num_rows > 0) 
            {
                $row = $res->fetch_assoc();
                $admin = new Administrador($row['nombre'],$row['tlfAdministrador'],$row['idAdministrador']);
            }

            return $admin;
        }

        /**
         * @method getAllPersonas devuelve un array con todos los personas
         * @author Miguel Ángel Posadas Arráez
         * @return personas Array de objetos persona
         */
        public function getAllPersonas()
        {
            $res = $this->$conexion->query("SELECT * from Persona");
            $personas = array();
            $i = 0;

            while($row = mysqli_fetch_row($res))
            {
                $personas[$i] = cargarPersona($row['idPersona']);
                $i++;
            }

            return $personas;
        }

        /**
         * @method getAllFacilitadores devuelve un array con todos los facilitadores
         * @author Miguel Ángel Posadas Arráez
         * @return facilitadores Array de objetos facilitadores
         */
        public function getAllFacilitadores()
        {
            $res = $this->$conexion->query("SELECT * from Facilitador");
            $facilitadores = array();
            $i = 0;

            while($row = mysqli_fetch_row($res))
            {
                $facilitadores[$i] =  new Facilitdor($row['nombre'],$row['tlfFacilitador'],$row['idFacilitador']);
                $i++;
            }

            return $facilitadores;
            
        }


        /**
         * @method getAllAdministradores devuelve un array con todos los administradores
         * @author Miguel Ángel Posadas Arráez
         * @return administradores Array de objetos administradores
         */
        public function getAllAdministradores()
        {
            $res = $this->$conexion->query("SELECT * from Facilitador");
            $administradores = array();
            $i = 0;

            while($row = mysqli_fetch_row($res))
            {
                $administradores[i] = new Administrador($row['nombre'],$row['tlfAdministrador'],$row['idAdministrador']);
                $i++;
            }

            return $administradores;
        }

        /**
         * Esta función requiere que los datos sean parseados previamente por el controlador
         * @method registrarPersonas Añade un usario a la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param nombrePersona
         * @param telefono
         * @param pass
         * @return resultado True en caso de registro False en caso contrario
         */
        public function registrarPersonas($nombrePersona,$telefono,$pass)
        {
            $nombrePersona = $this->$conexion->real_escape_string($nombreFacilitador); 
            $telefono = $this->$conexion->real_escape_string($telefono); 
            $pass = $this->$conexion->real_escape_string($pass); 

            $res = $this->$conexion->query("INSERT INTO Persona (tlfPersona,nombre,contraseña) VALUES ('$telefono','$nombrePersona','$pass')" ) ;

            return $res;
        }

        /**
         * Esta función requiere que los datos sean parseados previamente por el controlador
         * @method registrarFacilitador Añade un facilitador a la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param nombreFacilitador
         * @param telefono
         * @param pass
         * @return resultado True en caso de registro False en caso contrario
         */
        public function registrarFacilitador($nombreFacilitador,$telefono,$pass)
        {
            $nombreFacilitador = $this->$conexion->real_escape_string($nombreFacilitador); 
            $telefono = $this->$conexion->real_escape_string($telefono); 
            $pass = $this->$conexion->real_escape_string($pass); 

            $res = $this->$conexion->query("INSERT INTO Facilitador (tlfFacilitador,nombre,contraseña) VALUES ('$telefono','$nombreFacilitador','$pass')" ) ;

            return $res;
        }

        /**
         * Esta función requiere que los datos sean parseados previamente por el controlador
         * @method registrarFacilitador Añade un administrador a la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param nombreAdministrador
         * @param telefono
         * @param pass
         * @return resultado True en caso de registro False en caso contrario
         */
        public function registrarAdministrador($nombreAdministrador,$telefono,$pass)
        {
            $nombreAdministrador = $this->$conexion->real_escape_string($nombreAdministrador); 
            $telefono = $this->$conexion->real_escape_string($telefono); 
            $pass = $this->$conexion->real_escape_string($pass); 

            $res = $this->$conexion->query("INSERT INTO Administrador (tlfAdministrador,nombre,contraseña) VALUES ('$telefono','$nombreAdministrador','$pass')" ) ;

            return $res;
        }

        /**
         * @method eliminarPersona Elimina una persona de la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param idPersona
         * @return resultado True en caso de eliminación False en caso contrario
         */
        public function eliminarPersona($idPersona)
        {
            $res = $this->$conexion->query("DELETE FROM Persona WHERE idPersona=$idPersona") ;

            return $res;
        }

        /**
         * @method eliminarFacilitador Elimina un facilitador de la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param idFacilitador
         * @return resultado True en caso de eliminación False en caso contrario
         */
        public function eliminarFacilitador($idFacilitador)
        {
            $res = $this->$conexion->query("DELETE FROM Facilitador WHERE idFacilitador=$idFacilitador");

            return $res;
        }

        /**
         * @method eliminarAdministrador Elimina un administrador de la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param idAdministrador
         * @return resultado True en caso de eliminación False en caso contrario
         */
        public function eliminarAdministrador($idAdministrador)
        {
            $res = $this->$conexion->query("DELETE FROM Administrador WHERE idAdministrador=$idAdministrador") ;

            return $res;
        }

        /**
         * @method modificarPersona Modifica los datos de una persona en la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param idPersona 
         * @param nombrePersona
         * @param telefono
         * @param pass
         * @return resultado True en caso de modificación correcta False en caso contrario
         */
        public function modificarPersona($idPersona,$nombrePersona,$telefono,$pass)
        {
            $nombrePersona = $this->$conexion->real_escape_string($nombrePersona); 
            $telefono = $this->$conexion->real_escape_string($telefono); 
            $pass = $this->$conexion->real_escape_string($pass);
            //FALTA HASHEAR contraseña
            $res =  $this->$conexion->query("UPDATE Persona SET  nombre='$nombrePersona' contraseña='$pass',tlfPersona='$telefono'  WHERE idPersona='$idPersona'");
            
            return $res;
        }

        /**
         * @method modificarFacilitador
         * @author Miguel Munoz Molina
         * @param idFacilitador
         * @param nombreFacilitador
         * @param telefono
         * @param pass
         * @return resultado True en caso de modificación correcta False en caso contrario
         */
        public function modificarFacilitador($idFacilitador, $nombreFacilitador, $telefono, $pass)
        {
            $nombreFacilitador = $this->$conexion->real_escape_string($nombreFacilitador); 
            $telefono = $this->$conexion->real_escape_string($telefono); 
            $pass = $this->$conexion->real_escape_string($pass);
            //FALTA HASHEAR contraseña
            $res = $this->$conexion->query("UPDATE Facilitador SET idPersona='$idFacilitador', tlfFacilitador='$telefono', nombre='$nombreFacilitador', contraseña='$pass' WHERE idPersona='$idFacilitador'");
            
            return $res;
        }

        /**
         * @method modificarAdministrador Modifica los datos de un administrador en la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param idAdministrador 
         * @param nombreAdministrador
         * @param telefono
         * @param pass
         * @return resultado True en caso de modificación correcta False en caso contrario
         */
        public function modificarAdministrador($idAdministrador,$nombreAdministrador,$telefono,$pass)
        {
            $nombreAdministrador = $this->$conexion->real_escape_string($nombreAdministrador); 
            $telefono = $this->$conexion->real_escape_string($telefono); 
            $pass = $this->$conexion->real_escape_string($pass);
            //FALTA HASHEAR contraseña
            $res =  $this->$conexion->query("UPDATE Administrador SET  nombre='$nombreAdministrador' contraseña='$pass',tlfPersona='$telefono'  WHERE idAdministrador='$idAdministrador'");
            
            return $res;
        }
    }   


?>