<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "usuarios";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $username = $_SESSION['username'];


    // Verificar si el formulario ha sido enviado
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $regalo1 = $_POST['r1'];
        $regalo2 = $_POST['r2'];
        $regalo3 = $_POST['r3'];
        $carta = $_POST['carta'];
    
        // Suponiendo que $username está definido en algún lugar de tu código
        $username = $_SESSION['username'];
    
        // Preparar la consulta con una sentencia preparada
        $query_insert = "UPDATE data_users
                            SET 
                                regalo1 = ?,
                                regalo2 = ?,
                                regalo3 = ?,
                                carta = ?
                            WHERE usuario = ?";
    
        // Preparar la sentencia
        $stmt = $conn->prepare($query_insert);
    
        // Vincular parámetros
        $stmt->bind_param("sssss", $regalo1, $regalo2, $regalo3, $carta, $username);
    
        // Ejecutar la sentencia
        $stmt->execute();
    
        // Cerrar la sentencia
        $stmt->close();

        header("Location: dashboard.php");

    }


?>