<?php

$servername = "localhost"; // Cambia a la dirección del servidor si no está en localhost
$username = "dimitry";
$password = "12345678";
$database = "folclore";

try {
    $con = new mysqli($servername, $username, $password, $database);

    // Verifica la conexión
    if ($con->connect_error) {
        throw new Exception("Error de conexión a la base de datos: " . $con->connect_error);
    }

} catch (Exception $e) {
    // Manejar la excepción, por ejemplo, registrándola o mostrándola
    die($e->getMessage());
}

?>
