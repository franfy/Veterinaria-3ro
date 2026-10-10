<?php

    //Define las variables que se pueden usar en todo el Script
    define('DB_URL', '127.0.0.1'); //Link para conectarse a la base de datos
    define('DB_USER', 'root'); //Usuario a conectarse a la base de datos
    define('DB_PASS', ''); //Contraseña para conectarse a la base de datos
    define('DB_BDD', 'dbprueba'); //Nombre de la base de datos


    /*
    NAME: altaUsuario
    INPUT: string $pass, string $cedula, string $nombre, string $apellido
    OUTPUT: bool
    DESCRIPTION: Método de dar de alta a un usuario via MYSQL
    */
    function altaUsuario(string $pass, string $cedula, string $nombre, string $apellido): bool{
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);//Habilita que el try y catch salte si $conexion falla

        //Resultado a retornar en caso de no ser cambiado a true tras hacer excitosamente la sentencia
        $res = false;
        //Objeto que contendrá la conección a la base de datos
        $conexion = null;



        //Intento de conectarse a la base de datos
        try {
            //Crea la coneccion a la base de datos utilizando la URL, USUARIO, CONTRASENA, NOMBRE DE LA BDD y EL PUERTO (para localhost)
            $conexion = new mysqli(DB_URL, DB_USER, DB_PASS, DB_BDD, 3306);
            //Setea el metodo de envio de datos
            $conexion->set_charset("utf8mb4");

            //Encripta la contrasena de texto plano a HASH en la base de datos
            $passHash = password_hash($pass, PASSWORD_DEFAULT); //encripta la contraseña con hash

            //STATEMENT en el que se prepara la sentencia SQL
            $stmt = $conexion->prepare(
                "INSERT INTO USUARIOS (pass, cedula, nombre, apellido) VALUES (?, ?, ?, ?)"
            );
            //Remplaza los simbolos de pregunta de la sentencia por los valores, el primero indica que tipo de valores se ingresan 's = string', 'i = int'
            $stmt->bind_param("ssss", $passHash, $cedula, $nombre, $apellido);
            $stmt->execute(); //ejecuta la sentencia
            $stmt->close(); //termina la sentencia

            //Establece el valor a mas tarde retornar
            $res = true;

        //Atrapa el error en caso de haberlo
        } catch (mysqli_sql_exception $e) {
            echo "Error de base de datos: ", $e->getMessage(), " (código ", $e->getCode(), ")";
        //Bloque que se ejecuta siempre independientemente de que catch salte o no
        } finally {
            if ($conexion instanceof mysqli) {
                $conexion->close();
            } //Cierra la coneccion a la base de datos
        }

        //Retorna un valor dependiendo de si operacion fue exitosa
        return $res;
    }

    /*
    NAME: bajaUsuario
    INPUT: int $id
    OUTPUT: bool
    DESCRIPTION: Método de dar de baja a un usuario via MYSQL
    */
    function bajaUsuario(int $id): bool{

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $res = false;
        $conexion = null;

        try {
            $conexion = new mysqli(DB_URL, DB_USER, DB_PASS, DB_BDD, 3306);
            $conexion->set_charset("utf8mb4"); 

            $stmt = $conexion->prepare(
                "DELETE FROM USUARIOS WHERE ID_usuario = ?"
            );
            $stmt->bind_param("i", $id);
            $stmt->execute();
            
            //Si se ah aplicado a mas de una fila, entonces $res es true (si funciona devuelve true)
            $res = $stmt->affected_rows > 0;

            $stmt->close(); //termina la sentencia

        } catch (mysqli_sql_exception $e) {
            echo "Error de base de datos: " . $e->getMessage() . " (código " . $e->getCode() . ")";
        } finally {
            if ($conexion instanceof mysqli) {
                $conexion->close();
            }
        }

        return $res;

    }

    /*
    NAME: modificarUsuario
    INPUT: int $id, string $pass, string $cedula, string $nombre, string $apellido
    OUTPUT: bool
    DESCRIPTION: Modifica todos los valores ingresador de una fila USUARIOS donde el id sea igual al ingresado por parametros
    */
    function modificarUsuario(int $id, string $pass, string $cedula, string $nombre, string $apellido): bool{
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $res = false;
        $conexion = null;

        try {
            $conexion = new mysqli(DB_URL, DB_USER, DB_PASS, DB_BDD, 3306); //crea la coneccion
            $conexion->set_charset("utf8mb4");

            $passHash = password_hash($pass, PASSWORD_DEFAULT);

            $stmt = $conexion->prepare( //prepara la sentencia
                "UPDATE USUARIOS SET pass=? , cedula=? , nombre=? , apellido=? WHERE ID_usuario = ?"
            );
            $stmt->bind_param("ssssi", $pass, $cedula, $nombre, $apellido, $id); //remplaza los ? por los valores
            $stmt->execute(); //ejecuta la sentencia
            
            $res = $stmt->affected_rows > 0;

            $stmt->close(); //termina la sentencia

        } catch (mysqli_sql_exception $e) {
            echo "Error de base de datos: " . $e->getMessage() . " (código " . $e->getCode() . ")";
        } finally {
            if ($conexion instanceof mysqli) {
                $conexion->close();
            }
        }

        return $res;
    }

    /*
    NAME: listarUsuario
    INPUT: 
    OUTPUT: array
    DESCRIPTION: Método para listar todo el contenido de una tabla y volcarlo a un array
    */
    function listarUsuario(): array{

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        $res = [];
        $conexion = null;

        try {
            $conexion = new mysqli(DB_URL, DB_USER, DB_PASS, DB_BDD, 3306); //crea la coneccion
            $conexion->set_charset("utf8mb4"); 

            //Guarda la sentencia en la variable $sentencia
            $sentencia = "SELECT * FROM USUARIOS";
            //Guarda el resultado de ejecutar la sentencia en $resultset
            $resultset = $conexion->query($sentencia);


            //Convierte el resultado obtenido tras la sentencia en un array tradicional y lo retorna
            $res = $resultset->fetch_all(MYSQLI_NUM);
            //Libera el contenido de $resultset para poder ser utilizado mas tarde y evitar fallos de seguridad
            $resultset->free();

        } catch (mysqli_sql_exception $e) {
            echo "Error de base de datos: " . $e->getMessage() . " (código " . $e->getCode() . ")";
        } finally {
            if ($conexion instanceof mysqli) {
                $conexion->close();
            }
        }

        return $res;

    }

    //El array $array es igual al valor retornado por listarUsuario()
    $array = listarUsuario();

    //for anidado que recorre el array dentro del otro array
    for ($i = 0; $i < count($array); $i++){
        for ($j = 0; $j < count($array[$i]); $j++){
            echo $array[$i][$j];
        }
    }
    
?>