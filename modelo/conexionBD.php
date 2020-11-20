<?php
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
            $this->conexion = new mysqli("mysql", "miguelAngel", "practicasSIBW", "Comunica2");

            if($conexion->connect_errno)
            {
                echo("Fallo al conectar: " . $conexion->connect_errno);
            }
        }

        /**
         * @method cargarUsuario crea una instancia de un objeto usuario cuyo id es el pasado como parámetro
         * @author Miguel Ángel Posadas
         * @param idUsuario El identificador del usuario que se va a cargar
         * @return usuario El usuario
         */
        public function cargarUsuario($idUsuario)
        {
            $res = $this->$conexion->query("SELECT * from Persona WHERE IDpersona='" . $idUsuario . "'");

             /* Con esto tenemos un array multidimensional para obtener todos los comentarios a la vez */
            if($res->num_rows > 0) 
            {
                $row = $res->fetch_assoc();
                $usuario = new Usuario($row['iDpersona'],$row['Nombre']);
            }

            $usuario->setChat(cargarChatsUsuario($idUsuario));
            $usuario->setGrupo(cargarGruposUsuario($idUsuario));
            $usuario->setActividades(cargarActividadesUsuario($idUsuario));

            return $usuario;

        }

        /**
         * @method cargarChatsUsuario obtiene todos los chats correspondientes a un usuario
         * @author Miguel Ángel Posadas
         * @param idUsuario El identificador del usuario que se va a cargar
         * @return chats Array con los chats del usuario
         */
        public function cargarChatsUsuario($idUsuario)
        {
            $res = $this->$conexion->query("SELECT * from Tiene_Chat WHERE IDpersona='" . $idUsuario . "'");
            $chats = array();
            $i = 0;

            while($row = mysqli_fetch_row($res))
            {
                $aux = new Chat($row['IDchat'],$row['IDejercicio'],$row['IDpersona']);
                $chats[$i] = $aux;
                $i += 1;
            }

            return $chats;
        }

        /**
         * @method cargarGruposUsuario obtiene todos los grupos correspondientes a un usuario
         * @author Miguel Ángel Posadas
         * @param idUsuario El identificador del usuario que se va a cargar
         * @return grupos Array con los grupos del usuario
         */
        public function cargarGruposUsuario($idUsuario)
        {
            $res = $this->$conexion->query("SELECT * from Pertenece WHERE IDpersona='" . $idUsuario . "'");
            $grupos = array();
            $i = 0;
            
            while($row = mysqli_fetch_row($res))
            {
                $grupos[$i] = cargarGrupo($row['IDgrupo']);
                $i += 1;
            }

            return $grupos;
        }

        /**
         * @method cargarGrupo obtiene todos el grupo correspondientes a un IDgrupo
         * @author Miguel Ángel Posadas
         * @param idGrupos El identificador del grupo
         * @return grupo Objeto de la clase Grupos
         */
        public function cargarGrupo($idGrupo)
        {
            $res = $this->$conexion->query("SELECT * from Pertenece WHERE IDgrupo='" . $idGrupo . "'");
            $participantes = array();
            $i = 0;

            while($row = mysqli_fetch_row($res))
            {
                $participantes[$i] = $row['IDpersona'];
                $i += 1;
            }

            $res = $this->$conexion->query("SELECT * from Crea_Grupo WHERE IDgrupo='" . $idGrupo . "'");
            if($res->num_rows > 0) 
            {
                $row = $res->fetch_assoc();
                $nombreGrupo = $row['Nombre'];
            }

            $grupo = new Grupos($nombreGrupo,$participantes,$idGrupo);

            return $grupo;
        }

        /**
         * @method cargarActividadesUsuario obtiene todas las actividades de un usuario
         * @author Miguel Ángel Posadas
         * @param idUsuario El identificador del usuario
         * @return actividades Array de objetos de la clase actividad
         */
        public function cargarActividadesUsuario()
        {
            $res = $this->$conexion->query("SELECT * from Asigna WHERE IDpersona='" . $idUsuario . "'");
            $actividades = array();
            $i = 0;
            
            while($row = mysqli_fetch_row($res))
            {
                $actividades[$i] = cargarActividad($row['IDejercicio']);
                $i += 1;
            }

            return $actividades;
        }

        /**
         * @method cargarActividad Crea un objeto de la clase Actividad para un idEjercicio pasado
         * @author Miguel Ángel Posadas
         * @param idEjercicio
         * @return actividad Obejto de la clase Actividad
         */
        public function cargarActividad($idEjecicio)
        {
            $res = $this->$conexion->query("SELECT * from Crea_Ejercicio WHERE IDejercicio='" . $idEjercicio . "'");
            $actividad = new Actividad();

            if($res->num_rows > 0) 
            {
                $row = $res->fetch_assoc();
                $nombreActividad = $row['Titulo'];
                $tipoActividad = $row['Categoria'];
                $descripcion = $row['Descripcion'];
                $fecha = $row['Fecha'];
                $adjunto = $row['archivoAdjunto'];
                $actividad = new Actividad($nombreActividad, $tipoActividad, $descripcion, $fecha, $adjunto, $idEjercicio);
            }

            return $actividad;
            
        }

        /**
         * Este método requiere que el controlador parsee los datos
         * @method inicioSesionUsuario método que loguea en el sistema a un Usuario
         * @author Miguel Ángel Posadas Arráez
         * @param pass String
         * @return usuario Objeto de la clase Usuario
         */
        public function inicioSesionUsuario($pass)
        {
            $usuario = new Tutor();
            $res = $this->$conexion->query("SELECT * from Persona WHERE Contraseña= '". $pass ."' ");
            
            if($res->num_rows > 0) 
            {
                $row = $res->fetch_assoc();
                $usuario = $this->cargarUsuario($row['IDpersona']);
            }

            return $usuario;
        }

        /**
         * Este método requiere que el controlador parsee los datos
         * @method inicioSesionTutor método que loguea en el sistema a un Tutor
         * @author Miguel Ángel Posadas Arráez
         * @param nombreTutor String
         * @param pass String
         * @return tutor Objeto de la clase Tutor
         */
        public function inicioSesionTutor($nombreTutor,$pass)
        {
            $tutor = new Tutor();
            $res = $this->$conexion->query("SELECT * from Facilitador WHERE Nombre='" . $nombreTutor . "' AND Contraseña= '". $pass ."' ");
            
            if($res->num_rows > 0) 
            {
                $row = $res->fetch_assoc();
                $tutor = new Tutor($row['Nombre'],$row['TlfFacilitador'],$row['IDfacilitador']);
            }

            return $tutor;
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
            $admin = new Administrador();
            $res = $this->$conexion->query("SELECT * from Administrador WHERE Nombre='" . $nombreAdministrador . "' AND Contraseña= '". $pass ."' ");

            if($res->num_rows > 0) 
            {
                $row = $res->fetch_assoc();
                $admin = new Administrador($row['Nombre'],$row['TlfAdministrador'],$row['IDadministrador']);
            }

            return $admin;
        }

        /**
         * @method getAllUsuarios devuelve un array con todos los usuarios
         * @author Miguel Ángel Posadas Arráez
         * @return usuarios Array de objetos usuario
         */
        public function getAllUsuarios()
        {
            $res = $this->$conexion->query("SELECT * from Persona");
            $usuarios = array();
            $i = 0;

            while($row = mysqli_fetch_row($res))
            {
                $usuarios[$i] = cargarUsuario($row['IDpersona']);
                $i++;
            }

            return $usuarios;
        }

        /**
         * @method getAllTutores devuelve un array con todos los tutores
         * @author Miguel Ángel Posadas Arráez
         * @return tutores Array de objetos tutores
         */
        public function getAllTutores()
        {
            $res = $this->$conexion->query("SELECT * from Facilitador");
            $tutores = array();
            $i = 0;

            while($row = mysqli_fetch_row($res))
            {
                $tutores[$i] =  new Tutor($row['Nombre'],$row['TlfFacilitador'],$row['IDfacilitador']);
                $i++;
            }

            return $tutores;
            
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
                $administradores[i] = new Administrador($row['Nombre'],$row['TlfAdministrador'],$row['IDadministrador']);
                $i++;
            }

            return $administradores;
        }

        /**
         * Esta función requiere que los datos sean parseados previamente por el controlador
         * @method registrarUsuario Añade un usario a la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param nombreUsuario
         * @param telefono
         * @param pass
         * @return resultado True en caso de registro False en caso contrario
         */
        public function registrarUsuario($nombreUsuario,$telefono,$pass)
        {
            $nombreUsuario = $this->$conexion->real_escape_string($nombreTutor); 
            $telefono = $this->$conexion->real_escape_string($telefono); 
            $pass = $this->$conexion->real_escape_string($pass); 

            $res = $this->$conexion->query("INSERT INTO Persona (TlfPersona,Nombre,Contraseña) VALUES ('$telefono','$nombreUsuario','$pass')" ) ;

            return $res;
        }

        /**
         * Esta función requiere que los datos sean parseados previamente por el controlador
         * @method registrarTutor Añade un tutor a la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param nombreTutor
         * @param telefono
         * @param pass
         * @return resultado True en caso de registro False en caso contrario
         */
        public function registrarTutor($nombreTutor,$telefono,$pass)
        {
            $nombreTutor = $this->$conexion->real_escape_string($nombreTutor); 
            $telefono = $this->$conexion->real_escape_string($telefono); 
            $pass = $this->$conexion->real_escape_string($pass); 

            $res = $this->$conexion->query("INSERT INTO Facilitador (TlfFacilitador,Nombre,Contraseña) VALUES ('$telefono','$nombreTutor','$pass')" ) ;

            return $res;
        }

        /**
         * Esta función requiere que los datos sean parseados previamente por el controlador
         * @method registrarTutor Añade un administrador a la base de datos
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

            $res = $this->$conexion->query("INSERT INTO Administrador (TlfAdministrador,Nombre,Contraseña) VALUES ('$telefono','$nombreAdministrador','$pass')" ) ;

            return $res;
        }

        /**
         * @method eliminarUsuario Elimina un usuario de la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param idUsuario
         * @return resultado True en caso de eliminación False en caso contrario
         */
        public function eliminarUsuario($idUsuario)
        {
            $res = $this->$conexion->query("DELETE FROM Persona (IDpersona) VALUES ('$idUsuario')" ) ;

            return $res;
        }

        /**
         * @method eliminarTutor Elimina un tutor de la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param idTutor
         * @return resultado True en caso de eliminación False en caso contrario
         */
        public function eliminarTutor($idTutor)
        {
            $res = $this->$conexion->query("DELETE FROM Facilitador (IDfacilitador) VALUES ('$idTutor')" ) ;

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
            $res = $this->$conexion->query("DELETE FROM Administrador (IDadministrador) VALUES ('$idAdministrador')" ) ;

            return $res;
        }

        /**
         * @method modificarUsuario Modifica los datos de un usuario en la base de datos
         * @author Miguel Ángel Posadas Arráez
         * @param idUsuario 
         * @param nombreUsuario
         * @param telefono
         * @param pass
         * @return resultado True en caso de modificación correcta False en caso contrario
         */
        public function modificarUsuario($idUsuario,$nombreUsuario,$telefono,$pass)
        {
            $nombreUsuario = $this->$conexion->real_escape_string($nombreUsuario); 
            $telefono = $this->$conexion->real_escape_string($telefono); 
            $pass = $this->$conexion->real_escape_string($pass);
            //FALTA HASHEAR CONTRASEÑA
            $res =  $this->$conexion->query("UPDATE Persona SET  Nombre='$nombreUsuario' Contraseña='$pass',TlfPersona='$telefono'  WHERE IDpersona='$idUsuario'");
            
            return $res;
        }

        /**
         * @method modificarTutor
         * @author Miguel Munoz Molina
         * @param idTutor
         * @param nombreTutor
         * @param telefono
         * @param pass
         * @return resultado True en caso de modificación correcta False en caso contrario
         */
        public function modificarTutor($idTutor, $nombreTutor, $telefono, $pass)
        {
            $nombreTutor = $this->$conexion->real_escape_string($nombreTutor); 
            $telefono = $this->$conexion->real_escape_string($telefono); 
            $pass = $this->$conexion->real_escape_string($pass);
            //FALTA HASHEAR CONTRASEÑA
            $res = $this->$conexion->query("UPDATE Facilitador SET IDfacilitador='$idTutor', TlfFacilitador='$telefono', Nombre='$nombreTutor', Contraseña='$pass' WHERE IDfacilitador='$idTutor'");
            
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
            //FALTA HASHEAR CONTRASEÑA
            $res =  $this->$conexion->query("UPDATE Administrador SET  Nombre='$nombreAdministrador' Contraseña='$pass',TlfPersona='$telefono'  WHERE IDadministrador='$idAdministrador'");
            
            return $res;
        }
    }   


?>