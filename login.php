<!DOCTYPE html>
<?php
//Inicia la sesión si no está iniciada
if(session_status()==PHP_SESSION_NONE)
    session_start();

//Datos para acceder a la base de datos
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "usuarios");

// 1. Crear conexión con la BBDD
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Si hay un error, imprimimos la descripción del error y el número de error generado.
if (mysqli_connect_errno()) {
    die("La conexión con la BBDD ha fallado: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")");
}

//Funcion que busca en la base de datos a través de los datos del login
function find_user_by_username($username, $password, $connection){

    $safe_username = mysqli_real_escape_string($connection, $username);
    //Se utiliza para escapar caracteres especiales en una cadena que se va a incluir en una consulta SQL. Evita ataques SQL Injection
    $query  = "SELECT password ";
    $query .= "FROM data_users ";
    $query .= "WHERE usuario = '$username'";
    $query .= "LIMIT 1";  //Como username es primario no lo necesito
    $user_set = mysqli_query($connection, $query);  //mysqli_query ejecuta una sentencia SQL. 
    if (!$user_set) {
        die("Database query failed.");
    }
    /* mysqli_fetch_assoc recupera una fila de resultados como un array asociativo (clave-> valor)
    de los resultados obtenido después de ejecutar una consulta SQL con mysqli_query
    */
    if ($user = mysqli_fetch_assoc($user_set)) {
        return $user;
    } else {
        return null;
    }
}

function attempt_login($username, $password, $connection){
    $pass_s = password_hash($password, PASSWORD_DEFAULT);
    $user = find_user_by_username($username, $pass_s, $connection);
    if ($user) {

        //user encontrado

        return $user;
    } else {
        // user not found
        //echo "Usuario no encontrado";
        return false;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['form_submitted'])) {

    if (isset($_POST['username'])) {
        // check if the username has been set
        $username = $_POST["username"];
    }
    if (isset($_POST['password'])) {
        // check if the username has been set
        $password = $_POST["password"];
    }

    $found_user = attempt_login($username, $password, $connection);

    if ($found_user) {
        // Success
        /* password_verify compara la contraseña ingresada por el usuario con el hash almacenado 
            en la BBDD, devuelve true si coinciden.
        */
        if (password_verify($password, $found_user["password"])) {
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $found_user["password"];
            header("Location: " . "dashboard.php");
        } else {
            echo '<script language="javascript">alert("Contraseña incorrecta");</script>';
        }
    } else {
        // Alerta al usuario de que no se ha encontrado el usuario
        //Src: https://es.stackoverflow.com/questions/57937/hacer-un-alert-con-php-tras-un-formulario
        echo '<script language="javascript">alert("No se ha encontrado al usuario");</script>';
    }

    mysqli_close($connection);
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Iniciar sesión</title>
</head>

<body>
    <header>
        <h1>Inicio de sesión</h1>
    </header>
    <main>
        <section>
            <form action="" method="post" class="formulario">
                <label>Nombre de usuario
                    <input type="text" name="username" id="usuario" placeholder="Escribe tu usario aquí">
                </label>

                <label>Contraseña
                    <input type="password" name="password" placeholder="Escribe tu contraseña aquí" required>
                </label>
                <input type="hidden" name="form_submitted" value="1"> <!-- Campo oculto -->
                <input type="submit" value="Iniciar sesión" class="button" required>

                <br>
                <p id="register-text">¿No tienes cuenta? <a href="./register.php">Registrarse</a></p>
            </form> 
        </section>
    </main>
</body>

</html>