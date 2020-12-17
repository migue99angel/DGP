<?php
    require_once "administrador.php";
    require_once "facilitador.php";
    require_once "persona.php";
    require_once "grupos.php";
    require_once "ejercicio.php";
    require_once "asigna.php";
    require_once "chat.php";

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
            $this->conexion = new mysqli("mysql", "equipomumos", "practicasDGP", "Comunica2");

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
            $consulta = "SELECT * from Persona WHERE idPersona=" . $idPersona . ";";

             /* Con esto tenemos un array multidimensional para obtener todos los comentarios a la vez */
            if($res = $this->conexion->query($consulta))
            {
                $row = $res->fetch_assoc();
                $persona = new Persona($row['idPersona'],$row['nombre'],$row['contraseña'],$row['tlfPersona']);
            }

            return $persona;

        }

        /**
         * @method cargarFacilitador crea una instancia de un objeto Facilitador
         * @author Miguel Ángel Posadas
         * @param idFacilitador El identificador del facilitador
         * @return facilitador El facilitador
         */
        public function cargarFacilitador($idFacilitador)
        {
            $consulta = "SELECT * from Facilitador WHERE idFacilitador=" . $idFacilitador . ";";

            if($res = $this->conexion->query($consulta))
            {
                $row = $res->fetch_assoc();
                $facilitador = new Facilitador($row['nombre'],$row['tlfFacilitador'],$row['idFacilitador']);
            }

            return $facilitador;

        }

        /**
         * @method cargarAdministrador crea una instancia de un objeto Administrador
         * @author Miguel Ángel Posadas
         * @param idAdministrador El identificador del administrador
         * @return administrador El administrador
         */
        public function cargarAdministrador($idAdministrador)
        {
            $consulta = "SELECT * from Administrador WHERE idAdministrador=" . $idAdministrador . ";";

            if($res = $this->conexion->query($consulta))
            {
                $row = $res->fetch_assoc();
                $administrador = new Administrador($row['nombre'],$row['tlfAdministrador'],$row['idAdministrador']);
            }

            return $administrador;

        }

        /**
         * @method cargarPersonasFueraGrupo obtiene todas las personas que no están en ese grupo
         * @author Sergio Campos Megías
         * @param idGrupo El identificador del grupo
         * @return personas Array con las personas que no están en este grupo
         */
        public function cargarPersonasFueraGrupo($idGrupo)
        {
            $consulta = "SELECT * from Persona WHERE idPersona not in (select idPersona from Pertenece where idGrupo=$idGrupo)";
            $personas = array();
            $i = 0;
            echo("test");
            if($res = $this->conexion->query($consulta))
            {
                while($row = $res->fetch_assoc())
                {
                    $personas[$i] = $this->cargarPersona($row['idPersona']);
                    $i += 1;
                }
            }

            return $personas;
        }

        /**
         * @method cargarPersonasGrupo obtiene todas las personas correspondientes a un grupo
         * @author Sergio Campos Megías
         * @param idGrupo El identificador del grupo que se va a cargar
         * @return personas Array con las personas del grupo
         */
        public function cargarPersonasGrupo($idGrupo)
        {
            $consulta = "SELECT * from Pertenece WHERE idGrupo=$idGrupo";
            $personas = array();
            $i = 0;
            if($res = $this->conexion->query($consulta))
            {
                while($row = $res->fetch_assoc())
                {
                    $personas[$i] = $this->cargarPersona($row['idPersona']);
                    $i += 1;
                }
            }

            return $personas;
        }

        /**
         * @method getAllPersonas devuelve un array con todos los personas
         * @author Miguel Ángel Posadas Arráez y Darío Megías Guerrero
         * @return personas Array de objetos persona
         */
        public function getAllPersonas()
        {
            $consulta = "SELECT idPersona,nombre,contraseña from Persona ORDER BY nombre ASC";
            $personas = array();

            if ($res = $this->conexion->query($consulta))
            {
                while($row = $res->fetch_assoc())
                {
                    $personas[] = $this->cargarPersona($row['idPersona']);
                }
            }

            return $personas;
        }

        /**
         * @method cargarChatsPersona obtiene todos los chats correspondientes a una persona
         * @author Miguel Ángel Posadas
         * @param idPersona El identificador de la persona que se va a cargar
         * @return chats Array con los chats de la persona
         */
        public function cargarChatsPersona($idPersona)
        {
            $res = $this->conexion->query("SELECT * from Tiene_Chat WHERE idPersona='" . $idPersona . "'");
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
         * @method cargarChat obtiene los datos de un chat concreto
         * @author Darío Megías Guerrero
         * @param idEjercicio El identificador del ejercicio que tiene asignado la persona
         * @param idPersona El identificador de la persona que se va a cargar
         * @param idFacilitador El identificador de la persona que asignó el ejercicio
         * @param fechaAsignacion La fecha en la que se asignó el ejercicio
         * @return chat Objeto de la clase Chat con los datos del chat pedido
         */
        public function cargarChat($idEjercicio,$idPersona,$idFacilitador,$fechaAsignacion)
        {
            $consulta = "SELECT * FROM Tiene_Chat WHERE idEjercicio=$idEjercicio AND idPersona=$idPersona ".
                        "AND idFacilitador=$idFacilitador AND fechaAsignacion='$fechaAsignacion';";

            if ($res = $this->conexion->query($consulta)) {
                $row = $res->fetch_assoc();
                $chat = new Chat($row['idChat'],$row['idEjercicio'],$row['idPersona'],$row['fechaAsignacion'],$row['idFacilitador'],$row['ruta']);
            }

            return $chat;
        }

        // TODO CrearChat. Introduce en la base de datos, crea un nuevo archivo en su sitio y actualiza la BD.
        /**
         * @method crearChat Introduce un chat en la base de datos, crea su archivo correspondiente
         *                   y actualiza la BD para que quede patente la ruta del archivo
         * @author Darío Megías Guerrero
         * @param idEjercicio El identificador del ejercicio que tiene asignado la persona
         * @param idPersona El identificador de la persona que se va a cargar
         * @param idFacilitador El identificador de la persona que asignó el ejercicio
         * @param fechaAsignacion La fecha en la que se asignó el ejercicio
         * @return chat Objeto de la clase Chat con los datos del chat pedido
         */
        public function crearChat($idEjercicio,$idPersona,$idFacilitador,$fechaAsignacion) {
            $seguir = false;
            $exito = false;

            $consultaInsertar =
            "INSERT INTO Tiene_Chat(idEjercicio,idPersona,fechaAsignacion,idFacilitador) ".
            "VALUES($idEjercicio,$idPersona,'$fechaAsignacion',$idFacilitador);";

            $consultaChat =
            "SELECT idChat FROM Tiene_Chat WHERE idEjercicio=$idEjercicio AND idPersona=$idPersona ".
            "AND fechaAsignacion='$fechaAsignacion' AND idFacilitador=$idFacilitador;";

            // Insertamos el nuevo chat en la base de datos
            if ($res = $this->conexion->query($consultaInsertar)) {
                $seguir = true;
            } else {
                var_dump($consultaInsertar);
                var_dump($this->conexion->error);
            }

            // Si lo hemos podido insertar, ahora necesitamos el id del chat para operar con él
            if ($seguir) {
                if ($res = $this->conexion->query($consultaChat)) {
                    $idChat = $res->fetch_assoc()['idChat'];
                } else {
                    var_dump($consultaInsertar);
                    var_dump($this->conexion->error);
                    $seguir = false;
                }
            }

            // Creamos los directorios necesarios para que quede todo organizado
            // y no se pueda pisar ningún archivo con otro
            if ($seguir) {
                $rutaBase = "data/upload/exercises/$idEjercicio/chat/$idChat";
                var_dump(getcwd());
                $exito = mkdir($rutaBase,0777,true);

                if ($exito) {
                    $exito = mkdir($rutaBase."/media",0777,true);
                }

                if ($exito) {
                    $archivo = fopen($rutaBase."/chat.json","w") or die("No se puedo abrir el archivo");
                    $inicializaArchivo = array();
                    fwrite($archivo,json_encode($inicializaArchivo));
                    fclose($archivo);

                    $consultaActualizar =
                    "UPDATE Tiene_Chat SET ruta='$rutaBase/chat.json' WHERE idEjercicio=$idEjercicio AND idPersona=$idPersona ".
                    "AND fechaAsignacion='$fechaAsignacion' AND idFacilitador=$idFacilitador;";

                    if (!$this->conexion->query($consultaActualizar)) {
                        var_dump($consultaActualizar);
                        var_dump($this->conexion->error);
                    }
                }
            }

            return $exito;
        }

        /**
         * @method cargarGruposPersona obtiene todos los grupos correspondientes a una persona
         * @author Miguel Ángel Posadas
         * @param idPersona El identificador de la persona que se va a cargar
         * @return grupos Array con los grupos de la persona
         */
        public function cargarGruposPersona($idPersona)
        {
            $consulta = "SELECT * from Pertenece WHERE idPersona=$idPersona";
            $grupos = array();
            $i = 0;
            if($res = $this->conexion->query($consulta))
            {
                while($row = $res->fetch_assoc())
                {
                    $grupos[$i] = $this->cargarGrupo($row['idGrupo']);
                    $i += 1;
                }
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
            $consultaPertenece = "SELECT * from Pertenece WHERE idGrupo=$idGrupo";
            $consultaGrupo = "SELECT * from Crea_Grupo WHERE idGrupo=$idGrupo";
            $participantes = array();

            if ($res = $this->conexion->query($consultaPertenece)) {
                while($row = $res->fetch_assoc())
                {
                    $participantes[] = $row['idPersona'];
                }
            }

            if($res = $this->conexion->query($consultaGrupo))
            {
                $row = $res->fetch_assoc();
                $nombreGrupo = $row['nombre'];
                $fechaCreacion = $row['fechaCreacion'];
            }

            $grupo = new Grupos($nombreGrupo,$participantes,$idGrupo,$fechaCreacion);

            return $grupo;
        }

	/**
         * @method cargarGrupoNombre obtiene la id de un grupo a partir de su nombre
         * @author Sergio Campos Megias
         * @param nombre El nombre del grupo
         * @return idGrupo String con la id del grupo
         */
        public function cargarGrupoNombre($nombre)
        {
          $consultaGrupo = "SELECT * from Crea_Grupo WHERE nombre='$nombre'";


            if($res = $this->conexion->query($consultaGrupo)){
              $row = $res->fetch_assoc();
              $idGrupo = $row['idGrupo'];
            }

            return $idGrupo;
        }

        /**
         * @method getAllGrupos obtiene todos los grupos de la base de datos
         * @author Darío Megías Guerrero
         * @return grupos Array que contiene todos los grupos de la base de datos
         */
        public function getAllGrupos()
        {
            $consulta = "SELECT idGrupo,fechaCreacion from Crea_Grupo ORDER BY fechaCreacion ASC;";
            $grupos = array();

            if ($res = $this->conexion->query($consulta)) {
                while($row = $res->fetch_assoc())
                {
                    $grupos[] = $this->cargarGrupo($row['idGrupo']);
                }
            }

            return $grupos;
        }

        /**
         * @method cargarEjerciciosPersona obtiene todas las ejercicios de una persona
         * @author Miguel Ángel Posadas
         * @param idPersona El identificador de la persona
         * @return ejercicios Array de objetos de la clase ejercicio
         */
        public function cargarEjerciciosPersona($idPersona, $diaSemana=NULL)
        {
            if ($diaSemana !== NULL) {
                $consulta =
                    "SELECT x.*, ce.imagenAdjunta FROM (".
                        "SELECT *, WEEKDAY(fechaResolucion) as diaSemana FROM Resuelve_Asigna WHERE idPersona=$idPersona".
                    ") AS x ".
                    "INNER JOIN Crea_Ejercicio ce ON x.idEjercicio = ce.idEjercicio ".
                    "WHERE x.diaSemana=$diaSemana;";
            } else {
                $consulta = "SELECT * FROM Resuelve_Asigna WHERE idPersona=" . $idPersona . ";";
            }

            $ejercicios = array();

            if ($res = $this->conexion->query($consulta)) {
                while($row = $res->fetch_assoc())
                {
                    $ejercicios[] = $this->getEjercicioAsignado($row['idEjercicio'],$row['idPersona'],$row['fechaAsignacion'],$row['idFacilitador']);
                    end($ejercicios)->imagenAdjunta = $row['imagenAdjunta'];
                }
            }

            return $ejercicios;
        }

        /**
         * @method cargarEjercicio Crea un objeto de la clase Ejercicio para un idEjercicio pasado
         * @author Miguel Ángel Posadas y Darío Megías Guerrero
         * @param idEjercicio
         * @return ejercicio Obejto de la clase Ejercicio
         */
        public function cargarEjercicio($idEjercicio)
        {
            $consulta = "SELECT * from Crea_Ejercicio WHERE idEjercicio=" . $idEjercicio . ";";
            $ejercicio = new Ejercicio();

            if($res = $this->conexion->query($consulta))
            {
                $row = $res->fetch_assoc();
                $nombreEjercicio = $row['titulo'];
                $tipoEjercicio = $row['categoria'];
                $descripcion = $row['descripcion'];
                $fechaCreacion = $row['fechaCreacion'];
                $mAdjunto = $row['multimediaAdjunto'];
                $iAdjunta = $row['imagenAdjunta'];
                $ejercicio = new Ejercicio($nombreEjercicio, $tipoEjercicio, $descripcion,
                                                           $fechaCreacion, $mAdjunto, $iAdjunta, $idEjercicio);
            }

            return $ejercicio;

        }

        /**
         * @method getAllEjercicios Provee un array de objetos ejercicio con todos los ejercicios
         * @author Darío Megías Guerrero
         * @return ejercicios
         */
        public function getAllEjercicios($ordenarFecha=False)
        {
            $ordenFecha = '';
            $ejercicios = array();

            if ($ordenarFecha)
                $ordenFecha = 'ORDER BY fechaCreacion ASC';

            $consulta = 'SELECT * FROM Crea_Ejercicio '.$ordenFecha.';';

            if ($res = $this->conexion->query($consulta)) {
                while ($fila = $res->fetch_assoc()) {
                    $ejercicios[] = $this->cargarEjercicio($fila['idEjercicio']);
                }
            }

            return $ejercicios;
        }

	/**
         * @method asignarGrupo Plasma en la base de datos que una persona pertenece a un grupo
         * @author Sergio Campos Megias
         * @param idGrupo Id de la base de datos para un grupo
         * @param idPersona Id de la base de datos para una persona
         * @return exito Si ha habido éxito al asignar o no
         */
        public function asignarGrupo($idGrupo,$idPersona)
        {
            $exito = True;

            $consulta = "INSERT INTO Pertenece (idGrupo,idPersona)".
                                "VALUES ($idGrupo,$idPersona);";

            if ($res = $this->conexion->query($consulta)) {
                $exito = True;
            } else {
                $res->close();
                $exito = False;
            }


            return $exito;
        }

        /**
         * @method asignarEjercicioPersona Plasma en la base de datos que un ejercicio queda asignado a una Persona
         * @author Darío Megías Guerrero
         * @param idEjercicio Id de la base de datos para un ejercicio
         * @param idFacilitador Id de la base de datos para un facilitador
         * @param idPersona Id de la base de datos para una persona
         * @return exito Si ha habido éxito al asignar o no
         */
        public function asignarEjercicioPersona($idEjercicio,$idFacilitador,$idPersona,$fechaResolucion)
        {
            $exito = True;

            $consulta = "INSERT IGNORE INTO Resuelve_Asigna (idEjercicio,idPersona,idFacilitador,fechaAsignacion,fechaResolucion)".
                                "VALUES ($idEjercicio,$idPersona,$idFacilitador,NOW(),'$fechaResolucion');";

            if ($res = $this->conexion->query($consulta)) {
                $exito = True;
            } else {
                $exito = False;
            }

            return $exito;
        }

        /**
         * @method asignarEjercicioPersona Plasma en la base de datos que un ejercicio queda asignado a una Persona
         * @author Darío Megías Guerrero
         * @param idEjercicio Id de la base de datos para un ejercicio
         * @param idFacilitador Id de la base de datos para un facilitador
         * @param idPersona Id de la base de datos para una persona
         * @return exito Si ha habido éxito al asignar o no
         */
        public function asignarEjercicioGrupo($idEjecicio,$idFacilitador,$idGrupo,$fechaResolucion)
        {
            $exito = True;

            $grupo = $this->cargarGrupo($idGrupo);

            // Vamos a realizar una transacción en la BD que puede fallar y queremos que,
            // si falla, se deshagan todos ls pasos. Para ello priero tenemos
            // desacctivar el autocommit.
            $this->conexion->autocommit(TRUE);

            // Iniciamos la transacción. Se le podría dar un nombre, pero
            // no creo que haga falta.
            $this->conexion->begin_transaction(MYSQLI_TRANS_START_READ_WRITE);

            // Recorremos los participantes, que son ids de personas, para asignar
            // una a una el ejercicio
            foreach ($grupo->getAllParticipantes() as $participante) {
                // Si no se ha podido asignar, vamos a devolver que no ha habido éxito
                // y nos salimos inmediatamente del bucle
                if (!$this->asignarEjercicioPersona($idEjecicio,$idFacilitador,$participante,$fechaResolucion)) {
                    $exito = False;
                    // :s Creo que es necesario
                    break;
                }
            }

            // Si NO ha habido éxito, "desenrollamos" la transacción
            // Si SÍ ha habido éxito, hacemos commit de la transacción
            if (!$exito) {
                $this->conexion->rollback();
            } else {
                $this->conexion->commit();
            }

            // Volvemos a activar el autocommit para que todo funcione normalmente
            $this->conexion->autocommit(TRUE);

            return $exito;
        }

        /**
         * @method cargarEjerciciosResueltos Consulta todos los ejercicios que han sido resueltos y no han sido corregidos aún
         * @author Francisco Domínguez Lorente
         * @return ejercicios Array de los ejercicios resueltos que no han sido corregidos
         */
        public function cargarEjerciciosResueltos($idFacilitador)
        {
            $consulta = "SELECT *, Persona.nombre FROM Resuelve_Asigna
            INNER JOIN Persona ON Resuelve_Asigna.idPersona = Persona.idPersona
            WHERE NOT EXISTS (SELECT 1 FROM Corrige WHERE Resuelve_Asigna.idEjercicio = Corrige.idEjercicio
            AND Resuelve_Asigna.idPersona = Corrige.idPersona) AND idFacilitador = '". $idFacilitador ."'";

            $ejercicios = array();
            if($res = $this->conexion->query($consulta))
            {
                while($row = $res->fetch_assoc())
                {
                    $ejercicios[] = $row;
                }
            }

            return $ejercicios;
        }

        /**
         * @method cargarEjercicioResueltoPorID Consulta un determinado ejercicio resuelto por una determinada persona
         * @author Francisco Domínguez Lorente
         * @return ejercicio Array con el ejercicio devuelto
         */
        public function cargarEjercicioResueltoPorID($idEjercicio, $idPersona)
        {
            $consulta = "SELECT * from Resuelve_Asigna WHERE idPersona = '". $idPersona ."' AND idEjercicio = '". $idEjercicio ."'";

            $ejercicio = array();
            if($res = $this->conexion->query($consulta))
            {
                $ejercicio = $res->fetch_assoc();
            }

            return $ejercicio;
        }

        /**
         * @method corregirEjercicio Consulta todos los ejercicios que han sido resueltos y no han sido corregidos aún
         * @author Francisco Domínguez Lorente
         * @return resultado True en caso de registro False en caso contrario
         */
        public function corregirEjercicio($idEjercicio, $idFacilitador, $idPersona, $comentario, $adjunto, $valoracion)
        {
            $idEjercicio = (int) $this->conexion->real_escape_string($idEjercicio);
            $idFacilitador = (int) $this->conexion->real_escape_string($idFacilitador);
            $idPersona = (int) $this->conexion->real_escape_string($idPersona);
            $fechaCorreccion = date("Y-m-d");
            $comentario = $this->conexion->real_escape_string($comentario);
            $adjunto = $this->conexion->real_escape_string($adjunto);
            $valoracion = (int) $this->conexion->real_escape_string($valoracion);

            $consulta = $this->conexion->query("SELECT fechaAsignacion FROM Resuelve_Asigna WHERE idEjercicio = '". $idEjercicio ."' AND idPersona ='". $idPersona ."'");

            if($consulta->num_rows > 0) {
                $fila = $consulta->fetch_assoc();
                $fechaAsignacionEjercicio = $fila["fechaAsignacion"];
                }

            $res = $this->conexion->query("INSERT INTO Corrige (idFacilitador, idEjercicio, idPersona,
            fechaAsignacionEjercicio, fechaCorreccion, comentario, archivoAdjuntoCorreccion, valoracionFacilitador)
            VALUES ('$idFacilitador', '$idEjercicio', '$idPersona', '$fechaAsignacionEjercicio', '$fechaCorreccion', '$comentario', '$adjunto', '$valoracion')");
            return $res;
        }

        /**
         * Este método requiere que el controlador parsee los datos
         * @method inicioSesionPersona método que loguea en el sistema a una Persona
         * @author Miguel Ángel Posadas Arráez y Jose Luis Gallego Peña
         * @param pass String
         * @return persona Objeto de la clase Persona
         */
        public function inicioSesionPersona($pass)
        {
            $persona = null;
            $personas = $this->getAllPersonas();

            foreach ($personas as $p)
            {
                $contra = $p->getContraseña();
                if (password_verify($pass, $contra)) 
                {
                    $persona = $this->cargarPersona($p->getIdPersona());
                }
            }

            /*if($res->num_rows > 0)
            {
                $row = $res->fetch_assoc();
                $persona = $this->cargarPersona($row['idPersona']);
            }*/

            return $persona;
        }

        /**
         * Este método requiere que el controlador parsee los datos
         * @method inicioSesionFacilitador método que loguea en el sistema a un Facilitador
         * @author Miguel Ángel Posadas Arráez y Jose Luis Gallego Peña
         * @param nombreFacilitador String
         * @param pass String
         * @return facilitador Objeto de la clase Facilitador
         */
        public function inicioSesionFacilitador($nombreFacilitador,$pass)
        {
            $facilitador = null;
            $res = $this->conexion->query("SELECT * from Facilitador WHERE nombre= '" . $nombreFacilitador . "'");

            if($res->num_rows > 0)
            {
                $row = $res->fetch_assoc();

                if (password_verify($pass, $row['contraseña'])) 
                {
                    $facilitador = new Facilitador($row['nombre'],$row['tlfFacilitador'],$row['idFacilitador']);
                }
            }

            return $facilitador;
        }

        /**
         * Este método requiere que el controlador parsee los datos
         * @method inicioSesionAdministrador método que loguea en el sistema a un administrador
         * @author Miguel Ángel Posadas Arráez y Jose Luis Gallego Peña
         * @param nombreAdministrador String
         * @param pass String
         * @return administrador Objeto de la clase administrador
         */
        public function inicioSesionAdministrador($nombreAdministrador,$pass)
        {
            $admin = null;

            $res = $this->conexion->query("SELECT * FROM Administrador WHERE nombre ='$nombreAdministrador'");

            if($res->num_rows > 0)
            {
                $row = $res->fetch_assoc();

                if (password_verify($pass, $row['contraseña']))
                {
                    $admin = new Administrador($row['nombre'],$row['tlfAdministrador'],$row['idAdministrador']);
                }
            }

            return $admin;
        }

        /**
         * @method getAllFacilitadores devuelve un array con todos los facilitadores
         * @author Miguel Ángel Posadas Arráez
         * @return facilitadores Array de objetos facilitadores
         */
        public function getAllFacilitadores()
        {
            $consulta = "SELECT * from Facilitador";
            $facilitadores = array();
            $i = 0;

            if ($res = $this->conexion->query($consulta))
            {
                while ($row = $res->fetch_assoc())
                {
                    $facilitadores[$i] =  new Facilitador($row['nombre'],$row['tlfFacilitador'],$row['idFacilitador']);
                    $i++;
                }
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
            $consulta = "SELECT * from Administrador";
            $administradores = array();
            $i = 0;

            if ($res = $this->conexion->query($consulta)) {
                while ($row = $res->fetch_assoc())
                {
                    $administradores[$i] = new Administrador($row['nombre'],$row['tlfAdministrador'],$row['idAdministrador']);
                    $i++;
                }
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
            $nombrePersona = $this->conexion->real_escape_string($nombrePersona);
            $telefono = $this->conexion->real_escape_string($telefono);
            // Guardamos en la BD la contraseña encriptada
            $pass = password_hash($this->conexion->real_escape_string($pass), PASSWORD_DEFAULT);

            $res = $this->conexion->query("INSERT INTO Persona (tlfPersona,nombre,contraseña) VALUES ('$telefono','$nombrePersona','$pass')" ) ;

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
            $nombreFacilitador = $this->conexion->real_escape_string($nombreFacilitador);
            $telefono = $this->conexion->real_escape_string($telefono);
            $pass = password_hash($this->conexion->real_escape_string($pass), PASSWORD_DEFAULT);

            $res = $this->conexion->query("INSERT INTO Facilitador (tlfFacilitador,nombre,contraseña) VALUES ('$telefono','$nombreFacilitador','$pass')" ) ;

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
            $nombreAdministrador = $this->conexion->real_escape_string($nombreAdministrador);
            $telefono = $this->conexion->real_escape_string($telefono);
            $pass = password_hash($this->conexion->real_escape_string($pass), PASSWORD_DEFAULT);

            $res = $this->conexion->query("INSERT INTO Administrador (tlfAdministrador,nombre,contraseña) VALUES ('$telefono','$nombreAdministrador','$pass')" ) ;

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
            $res = $this->conexion->query("DELETE FROM Persona WHERE idPersona=$idPersona") ;

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
            $res = $this->conexion->query("DELETE FROM Facilitador WHERE idFacilitador=$idFacilitador");

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
            $res = $this->conexion->query("DELETE FROM Administrador WHERE idAdministrador=$idAdministrador") ;

            return $res;
        }

        /**
         * @method eliminarGrupo Elimina un grupo y todas sus relaciones pertenece asociadas de la base de datos
         * @author Sergio Campos Megias
         * @param idGrupo
         * @return resultado True en caso de eliminación False en caso contrario
         */
        public function eliminarGrupo($idGrupo)
        {
            $res = $this->conexion->query("DELETE FROM Pertenece WHERE idGrupo=$idGrupo") ;
            $res = $this->conexion->query("DELETE FROM Crea_Grupo WHERE idGrupo=$idGrupo") ;
            return $res;
        }

        /**
         * @method eliminarDeGrupo Elimina una relación pertenece de la base de datos
         * @author Sergio Campos Megias
         * @param idGrupo
         * @param idPersona
         * @return resultado True en caso de eliminación False en caso contrario
         */
        public function eliminarDeGrupo($idGrupo,$idPersona)
        {
          $res = $this->conexion->query("DELETE FROM Pertenece WHERE idGrupo=$idGrupo && idPersona=$idPersona") ;
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

            $nombrePersona = $this->conexion->real_escape_string($nombrePersona);
            $telefono = $this->conexion->real_escape_string($telefono);

            if($pass==='')
            {
                $res =  $this->conexion->query("UPDATE Persona SET nombre='$nombrePersona',tlfPersona='$telefono'  WHERE idPersona='$idPersona'");
            }
            else
            {
                $pass = password_hash($this->conexion->real_escape_string($pass), PASSWORD_DEFAULT);
                $res =  $this->conexion->query("UPDATE Persona SET nombre='$nombrePersona', contraseña='$pass',tlfPersona='$telefono'  WHERE idPersona='$idPersona'");
            }

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
            $nombreFacilitador = $this->conexion->real_escape_string($nombreFacilitador);
            $telefono = $this->conexion->real_escape_string($telefono);

            if($pass==='')
            {

                $res = $this->conexion->query("UPDATE Facilitador SET tlfFacilitador='$telefono', nombre='$nombreFacilitador' WHERE idFacilitador='$idFacilitador'");
            }
            else
            {
                $pass = password_hash($this->conexion->real_escape_string($pass), PASSWORD_DEFAULT);
                $res = $this->conexion->query("UPDATE Facilitador SET tlfFacilitador='$telefono', nombre='$nombreFacilitador', contraseña='$pass' WHERE idFacilitador='$idFacilitador'");
            }

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
            $nombreAdministrador = $this->conexion->real_escape_string($nombreAdministrador);
            $telefono = $this->conexion->real_escape_string($telefono);
            if($pass==='')
            {
                $res =  $this->conexion->query("UPDATE Administrador SET  nombre='$nombreAdministrador' ,tlfAdministrador='$telefono'  WHERE idAdministrador='$idAdministrador'");

            }
            else
            {
                $pass = password_hash($this->conexion->real_escape_string($pass), PASSWORD_DEFAULT);
                $res =  $this->conexion->query("UPDATE Administrador SET  nombre='$nombreAdministrador' ,contraseña='$pass',tlfAdministrador='$telefono'  WHERE idAdministrador='$idAdministrador'");

            }

            return $res;
        }

        /**
         * @method modificarGrupo Modifica los datos de un grupo en la base de datos
         * @author Sergio Campos Megias
         * @param idGrupo
         * @param nombreGrupo
         * @return resultado True en caso de modificación correcta False en caso contrario
         */
        public function modificarGrupo($idGrupo,$nombreGrupo)
        {
            $nombreGrupo = $this->conexion->real_escape_string($nombreGrupo);
            $res =  $this->conexion->query("UPDATE Crea_Grupo SET  nombre='$nombreGrupo' WHERE idGrupo='$idGrupo'");

            return $res;
        }

        /**
         * @method crearEjercicio Crea un ejercicio con los datos dados
         * @author Miguel Muñoz Molina
         * @param idFacilitador 
         * @param titulo
         * @param descripcion
         * @param imagen String con la url de una imagen
         * @return res Booleano que indica si la inserción ha sido satisfactoria
         */
        public function crearEjercicio($idFacilitador, $titulo, $descripcion, $imagen)
        {
            $idFacilitador = $this->conexion->real_escape_string($idFacilitador);
            $fechaCreacion = date("Y-m-d");
            $titulo = $this->conexion->real_escape_string($titulo);
            $descripcion = $this->conexion->real_escape_string($descripcion);
            $imagen = $this->conexion->real_escape_string($imagen);
            $res = $this->conexion->query("INSERT INTO Crea_Ejercicio (idFacilitador, fechaCreacion, titulo, categoria, fecha, descripcion, multimediaAdjunto, imagenAdjunta) VALUES ('$idFacilitador', '$fechaCreacion', '$titulo', NULL, NULL, '$descripcion', NULL, '$imagen')" ) ;

            return $res;
        }

        /**
         * @method crearEjercicioMultimedia Crea un ejercicio con los datos dados
         * @author Miguel Muñoz Molina
         * @param idFacilitador
         * @param titulo
         * @param descripcion
         * @param imagen String con la url de una imagen
         * @param multimedia String con la url de un archivo multimedia
         * @return res Booleano que indica si la inserción ha sido satisfactoria
         */
        public function crearEjercicioMultimedia($idFacilitador, $titulo, $descripcion, $imagen, $multimedia)
        {
            $idFacilitador = $this->conexion->real_escape_string($idFacilitador);
            $fechaCreacion = date("Y-m-d");
            $titulo = $this->conexion->real_escape_string($titulo);
            $descripcion = $this->conexion->real_escape_string($descripcion);
            $imagen = $this->conexion->real_escape_string($imagen);
            $multimedia = $this->conexion->real_escape_string($multimedia);
            $res = $this->conexion->query("INSERT INTO Crea_Ejercicio (idFacilitador, fechaCreacion, titulo, categoria, fecha, descripcion, multimediaAdjunto, imagenAdjunta) VALUES ('$idFacilitador', '$fechaCreacion', '$titulo', NULL, NULL, '$descripcion', '$multimedia', '$imagen')" ) ;

            return $res;
        }

        /**
         * @method getEjercicioAsignado Devuelve un ejercicio asignado a una persona
         * @author Miguel Muñoz Molina
         * @param idEjercicio
         * @param idPersona
         * @param fechaAsignacion
         * @param idFacilitador
         * @return asignado Objeto de la clase Asigna que contiene la información referente a la asignación de un ejercicio
         */
        public function getEjercicioAsignado($idEjercicio, $idPersona, $fechaAsignacion, $idFacilitador) {
            $consulta = "SELECT Resuelve_Asigna.idEjercicio, Resuelve_Asigna.fechaAsignacion, Resuelve_Asigna.idFacilitador, Resuelve_Asigna.idPersona, Crea_Ejercicio.titulo, Facilitador.nombre AS nombreFacilitador, Persona.nombre AS nombrePersona, Resuelve_Asigna.fechaResolucion, Resuelve_Asigna.valoracionPersona, Resuelve_Asigna.archivoAdjuntoSolucion FROM Resuelve_Asigna, Crea_Ejercicio, Facilitador, Persona WHERE Resuelve_Asigna.idEjercicio = Crea_Ejercicio.idEjercicio AND Resuelve_Asigna.idFacilitador = Facilitador.idFacilitador AND Resuelve_Asigna.idPersona = Persona.idPersona AND Resuelve_Asigna.idEjercicio = '$idEjercicio' AND Resuelve_Asigna.idPersona = '$idPersona' AND Resuelve_Asigna.fechaAsignacion = '$fechaAsignacion' AND Resuelve_Asigna.idFacilitador = '$idFacilitador';";
            $asignado = new Asigna();

            if($res = $this->conexion->query($consulta))
            {
                $row = $res->fetch_assoc();
                $idEjercicio = $row['idEjercicio'];
                $idFacilitador = $row['idFacilitador'];
                $idPersona = $row['idPersona'];
                $fechaAsignacion = $row['fechaAsignacion'];
                $titulo = $row['titulo'];
                $nombreFacilitador = $row['nombreFacilitador'];
                $nombrePersona = $row['nombrePersona'];
                $fechaResolucion = $row['fechaResolucion'];
	        $valoracionPersona = $row['valoracionPersona'];
	        $archivoAdjuntoSolucion = $row['archivoAdjuntoSolucion'];
                $asignado = new Asigna($idEjercicio, $idFacilitador, $idPersona, $fechaAsignacion, $titulo, $nombreFacilitador, $nombrePersona, $fechaResolucion, $valoracionPersona, $archivoAdjuntoSolucion);
            }

            return $asignado;
        }

        /**
         * @method getAllEjerciciosAsignados
         * @author Miguel Muñoz Molina
         * @return asignados Array con ejercicios asignados
         */
        public function getAllEjerciciosAsignados() {
            $consulta = "SELECT Resuelve_Asigna.idEjercicio, Resuelve_Asigna.fechaAsignacion, Resuelve_Asigna.idFacilitador, Resuelve_Asigna.idPersona, Crea_Ejercicio.titulo, Facilitador.nombre AS nombreFacilitador, Persona.nombre AS nombrePersona FROM Resuelve_Asigna, Crea_Ejercicio, Facilitador, Persona WHERE Resuelve_Asigna.idEjercicio = Crea_Ejercicio.idEjercicio AND Resuelve_Asigna.idFacilitador = Facilitador.idFacilitador AND Resuelve_Asigna.idPersona = Persona.idPersona ORDER BY titulo, nombrePersona, fechaResolucion;";

            $asignados = array();
            $i = 0;

            if ($res = $this->conexion->query($consulta)) {
                while ($fila = $res->fetch_assoc()) {
                    $asignados[] = $this->getEjercicioAsignado($fila['idEjercicio'], $fila['idPersona'], $fila['fechaAsignacion'], $fila['idFacilitador']);
                    $i++;
                }
            }

            return $asignados;
        }
        
        public function getAllEjerciciosAsignadosByFacilitador($idFacilitador) {
            $consulta = "SELECT Resuelve_Asigna.idEjercicio, Resuelve_Asigna.fechaAsignacion, Resuelve_Asigna.idFacilitador, Resuelve_Asigna.idPersona, Crea_Ejercicio.titulo, Facilitador.nombre AS nombreFacilitador, Persona.nombre AS nombrePersona FROM Resuelve_Asigna, Crea_Ejercicio, Facilitador, Persona WHERE Resuelve_Asigna.idFacilitador = '$idFacilitador' AND Resuelve_Asigna.idEjercicio = Crea_Ejercicio.idEjercicio AND Resuelve_Asigna.idFacilitador = Facilitador.idFacilitador AND Resuelve_Asigna.idPersona = Persona.idPersona ORDER BY titulo, nombrePersona, fechaResolucion;";

            $asignados = array();
            $i = 0;

            if ($res = $this->conexion->query($consulta)) {
                while ($fila = $res->fetch_assoc()) {
                    $asignados[] = $this->getEjercicioAsignado($fila['idEjercicio'], $fila['idPersona'], $fila['fechaAsignacion'], $fila['idFacilitador']);
                    $i++;
                }
            }

            return $asignados;
        }

        /**
         * @method crearGrupo
         * @author Miguel Muñoz Molina
         * @param idFacilitador
         * @param nombre
         * @return res Booleano que indica si la inserción ha sido satisfactoria
         */
        public function crearGrupo($idFacilitador, $nombre)
        {
            $idFacilitador = $this->conexion->real_escape_string($idFacilitador);
            $fechaCreacion = date("Y-m-d");
            $nombre = $this->conexion->real_escape_string($nombre);
            $res = $this->conexion->query("INSERT INTO Crea_Grupo (idFacilitador, fechaCreacion, nombre) VALUES ('$idFacilitador', '$fechaCreacion', '$nombre')" ) ;

            return $res;
        }

        public function desasignarEjercicio($idEjercicio, $idFacilitador, $idPersona, $fechaAsignacion) {
            $res = $this->conexion->query("DELETE FROM Resuelve_Asigna WHERE idEjercicio = '$idEjercicio' AND idPersona = '$idPersona' AND idFacilitador = '$idFacilitador' AND fechaAsignacion = '$fechaAsignacion';");

            return $res;

        }

        /**
         * @method getEjercicio
         * @author Miguel Ángel Posadas Arráez
         * @param idEjercicio El id del ejercicio
         * @return ejercicio Objeto de la clase ejercicio
         */
        public function getEjercicio($idEjercicio)
        {
            $consulta = "SELECT * from Crea_Ejercicio WHERE idEjercicio=" . $idEjercicio . ";";

           if($res = $this->conexion->query($consulta))
           {
               $row = $res->fetch_assoc();
               $ejercicio = new Ejercicio($row['titulo'],$row['categoria'],$row['descripcion'], $row['fechaCreacion'], $row['multimediaAdjunto'], $row['imagenAdjunta'], $idEjecicio);
           }

           return $ejercicio;
        }

        /**
         * @method obtenerEstadoEjercicio()
         * @author Miguel Ángel Posadas Arráez
         * @param idEjercicio El id del ejercicio
         * @return 0 Si el ejercicio está asignado pero no esta resuelto ni corregido
         * @return 1 Si el ejercicio está asignado y resuelto 
         * @return 2 Si el ejercicio está corregido 
         */
        public function obtenerEstadoEjercicio($idEjecicio, $idPersona)
        {
            $consultaResolucion = "SELECT * from Resuelve_Asigna WHERE idEjercicio=" . $idEjercicio . "idPersona=" . $idPersona . ";";
            $consultaCorrecion = "SELECT * from Corrige WHERE idEjercicio=" . $idEjercicio . "idPersona=" . $idPersona . ";";

            if($res = $this->conexion->query($consultaResolucion))
            {  
                $row = $res->fetch_assoc();
                $retorno = 0;

                if($row['texto'] != NULL || $row['valoracionPersona'] != NULL || $row['archivoAdjuntoSolucion'] != NULL)
                {
                    $retorno = 1;
                    if($res = $this->conexion->query($consultaCorrecion))
                    {
                        $row2 = $res->fetch_assoc();
                        if($row2['comentario'] || $row2['archivoAdjuntoCorreccion'] || $row2['valoracionFacilitador'])
                            $retorno = 2;
                    }
                    
                    return $retorno;
                }
            }
            else
                return "Error en la consulta";
        }
    }


?>
