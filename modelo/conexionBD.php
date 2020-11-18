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

        }
    }

?>