<!DOCTYPE html>
<?php
    session_start();
?>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "usuarios";

    $conn = new mysqli($servername, $username, $password, $dbname);
    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $query_insert = "INSERT INTO data_users (nombre, apellidos, usuario, edad, direccion, `password`)
    VALUES ('', '', '', 0, '', '');";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Me aseguro de que los valores no están vacíos y si lo están cojo los valores predeterminados
        //Igualmente en el html tengo la etiqueta required que va a exigir que haya contenido dentro de los inputs
        $nombre = !empty($_POST["nombre"]) ? $_POST["nombre"] : '';
        $apellidos = !empty($_POST["apellidos"]) ? $_POST["apellidos"] : '';
        $usuario = !empty($_POST["usuario"]) ? $_POST["usuario"] : '';
        $edad = !empty($_POST["edad"]) ? $_POST["edad"] : 0;
        $direccion = !empty($_POST["direccion"]) ? $_POST["direccion"] : '';
        $password = !empty($_POST["password"]) ? $_POST["password"] : '';

        $pass_s = password_hash($password, PASSWORD_DEFAULT);
        // Preparar la consulta SQL
        $query_insert = "INSERT INTO data_users (nombre, apellidos, usuario, edad, direccion, `password`)
        VALUES ('$nombre', '$apellidos', '$usuario', $edad, '$direccion', '$pass_s')";

        $_SESSION["username"] = $usuario;


        // Ejecutar la consulta
        $conn->query($query_insert);

        header("Location: dashboard.php");
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
        <h1>Registro de usuario</h1>
    </header>
    <main>
        <section>
            <form action="" method="post" class="formulario">
                <label>Nombre
                    <input name="nombre" type="text" id="nombre" placeholder="Escribe tu nombre aquí" required>
                </label>
                <label>Apellidos
                    <input name="apellidos" type="text" id="apellidos" placeholder="Escribe tus apellidos aquí" required>
                </label>
                <label>Nombre de usuario
                    <input name="usuario" type="text" id="usuario" placeholder="Escribe tu usario aquí" required>
                </label>
                <label>Edad
                    <input name="edad" type="number" min="0" id="edad" placeholder="Escribe tu edad aquí" required>
                </label>
                <label>Direccion
                    <input name="direccion" type="text" id="direccion" placeholder="Escribe tu dirección aquí" required>
                </label>
                <label>Contraseña
                    <input name="password" type="password" id="password" placeholder="Escribe tu contraseña aquí" required>
                </label>
                
                <input type="submit" value="Iniciar sesión" class="button">

                <br>
                <p id="register-text">¿Ya tienes cuenta? <a href="./login.php">Register</a></p>
            </form>
        </section>
    </main>
</body>
</html>