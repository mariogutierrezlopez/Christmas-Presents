<?php //Inicio la sesion
    session_start();
    
    if(isset($_SESSION["username"])) {
        // Si el usuario está autenticado, mostrar el contenido del panel de control
?>

<?php //Conexion a una base de datos
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

    
    // Utilizar una sentencia preparada para prevenir la inyección SQL
    $query_consultar_user = 'SELECT tipo, nombre, apellidos, regalo1, regalo2, regalo3, carta FROM data_users WHERE usuario = ? LIMIT 1;';
    
    // Preparar la sentencia
    $stmt = $conn->prepare($query_consultar_user);

    // Vincular el parámetro de usuario a la sentencia preparada
    $stmt->bind_param('s', $_SESSION["username"]);

    // Ejecutar la sentencia preparada
    $stmt->execute();

    // Obtener resultados
    $result_consultar_user = $stmt->get_result();


    // Verificar si la consulta fue exitosa y si hay filas
    if ($result_consultar_user && $result_consultar_user->num_rows > 0) {
        $row_consultar_user = $result_consultar_user->fetch_assoc();

        $tipo_usuario = $row_consultar_user['tipo'];
        // Ahora puedes acceder a los datos y utilizarlos en tu HTML
        $regalo1_existente = $row_consultar_user['regalo1'];
        if($tipo_usuario == 1){

            if($regalo1_existente === '' || $regalo1_existente === null) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/dashboard.css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">
    <title>Carta a los reyes magos </title>
</head>
<body>
    <header>
        <p><?php echo $row_consultar_user['nombre'] . ' ' . $row_consultar_user['apellidos'];?></p>
        <form method="post" action="logout.php"><input type="submit" value="Cerrar Sesion" class="logout-button"></form>
    </header>
    <main>
        <h1>Tu carta a los reyes magos </h1>
        <form method="post" class="formulario" action="insertar_regalos.php">
            Escribe tus 3 regalos que más quieras pedir a los Reyes Magos
            <label>Regalo 1
                <input type="text" name="r1" id="r1" placeholder="Escribe tu regalo 1 aquí" required>
            </label>
            <label>Regalo 2
                <input type="text" name="r2" id="r2" placeholder="Escribe tu regalo 2 aquí" required>
            </label>
            <label>Regalo 3
                <input type="text" name="r3" id="r3" placeholder="Escribe tu regalo 3 aquí" required>
            </label>
            
            <label><span>Carta a los reyes magos <i>(Opcional)</i></span>
                <textarea name="carta" id="carta" maxlength="255" cols="30" rows="10" placeholder="Queridos reyes magos..."></textarea>
                <div id="textarea-count">
                    <span id="current">0</span>
                    <span id="maximum">/ 255</span>
                  </div>
            </label>
            <input type="submit" value="Pedir" class="submit-pedir">
            
        </form>
    </main>
    <script src="scripts/dashboard.js"></script>
</body>
</html>
<?php
    }else{   
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/dashboard.css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">
    <title>Carta a los reyes magos </title>
</head>
<body>
    <header>
        <p><?php echo $row_consultar_user['nombre'] . ' ' . $row_consultar_user['apellidos'];?></p>
        <form method="post" action="logout.php"><input type="submit" value="Cerrar Sesion" class="logout-button"></form>
    </header>
    <main>
        <h1>Tu carta a los reyes magos </h1>
        <form method="post" action="insertar_regalos.php" class="formulario">
            <span class="form-title">Aquí están tus 3 regalos que has pedido a los reyes magos, ¡Feliz navidad!</span>
            <label>Regalo 1
                <input type="text" name="r1" id="r1" placeholder="Escribe tu regalo 1 aquí" required disabled
                value="<?php echo $row_consultar_user['regalo1'];?>">
            </label>
            <label>Regalo 2
                <input type="text" name="r2" id="r2" placeholder="Escribe tu regalo 2 aquí" required disabled
                value="<?php echo $row_consultar_user['regalo2'];?>">
            </label>
            <label>Regalo 3
                <input type="text" name="r3" id="r3" placeholder="Escribe tu regalo 3 aquí" required disabled value="<?php echo $row_consultar_user['regalo3'];?>">
            </label>
            
            <label><span>Carta a los reyes magos <i>(Opcional)</i></span>
                <textarea name="carta" id="carta" maxlength="255" cols="30" rows="10" placeholder="Queridos reyes magos..." disabled><?php echo $row_consultar_user['carta']?></textarea>
                <div id="textarea-count">
                    <span id="current">0</span>
                    <span id="maximum">/ 255</span>
                  </div>
            </label>
            <button type="button" id="boton-editar" class="submit-editar">Editar</button>
            <button type="submit" id="boton-guardar" class="submit-pedir" style="display: none;">Guardar cambios</button>
            
        </form>
    </main>
    <script src="./scripts/dashboard.js"></script>
</body>
</html>
<?php 
            }
        }else{ //Tipo = 2 (Melchor, Gaspar y Baltasar)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/dashboard.css">
    <link rel="icon" type="image/x-icon" href="/images/favicon.png">
    <title>Carta a los reyes magos </title>
</head>
<body>
    <header>
        <p><?php echo $row_consultar_user['nombre'] . ' ' . $row_consultar_user['apellidos'];?></p>
        <form method="post" action="logout.php"><input type="submit" value="Cerrar Sesion" class="logout-button"></form>
    </header>
    <main>
        <h1>Lista de regalos solicitados</h1>
        <br>
        <br>
        <br>
        <br>
        <?php 
        $query_obtener_niños = "SELECT nombre, apellidos, usuario, edad, direccion, regalo1, regalo2, regalo3, carta
        FROM data_users
        WHERE tipo = 1;";
        $result_obtener_niños = $conn->query($query_obtener_niños);

        // Verificar si la consulta fue exitosa
        if ($result_obtener_niños) {
            // Recorrer los resultados y obtener cada fila de datos
            while ($row = $result_obtener_niños->fetch_assoc()) {
                // Obtener valores específicos de cada columna
                $nombre = $row['nombre'];
                $apellidos = $row['apellidos'];
                $usuario = $row['usuario'];
                $edad = $row['edad'];
                $direccion = $row['direccion'];
                $regalo1 = $row['regalo1'];
                $regalo2 = $row['regalo2'];
                $regalo3 = $row['regalo3'];
                $carta = $row['carta'];

                // Procesar o mostrar los datos según sea necesario
                // Por ejemplo, puedes imprimir los valores o realizar otras operaciones
                $child_card =  '<div class="child-card">
                <h3>' . $nombre . ' ' . $apellidos . '</h3>
                <div class="data">
                    <div class="personal-data">
                        <p><img src="./images/user.png" height="20" alt="">' . $usuario . '</p>
                        <p><img src="./images/age-group.png" height="20" alt="">' . $edad . ' años</p>
                        <p><img src="./images/location.png" height="20" alt="">' . $direccion . '</p>
                    </div>
                    <div class="regalos">
                        <p><img src="./images/present.png" height="20" alt="">' . $regalo1 . '</p>
                        <p><img src="./images/present.png" height="20" alt="">' . $regalo2 . '</p>
                        <p><img src="./images/present.png" height="20" alt="">' . $regalo3 . '</p>
                    </div>';
                if($carta === null || $carta === ""){
                    $child_card .= '</div></div>';
                }else{
                    $child_card.=' </div>
                    <div class="line"></div>
                    <p class="carta"><img src="./images/mail.png" height="20" alt="">' . $carta . '</p>
                </div>';
                }

                echo $child_card;
             }

            // Liberar el conjunto de resultados
            $result_obtener_niños->free();
        }
        ?>
        
        
    </main>
    <script src="scripts/dashboard.js"></script>
</body>
</html>
<?php
}
} //Fin bloque html sino existen regalos
    $conn->close();
    } else {
        header('location: login.php');
    }
?>

