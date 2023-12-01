<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Incluye la conexión a la base de datos desde db.php
include('dbMariaDB.php');

// Inicia la sesión
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el valor del path del formulario
    $path = $_POST['videoPath'];

    try {
        // Obtén el Id_Video correspondiente al path
        $sql_id_video = "SELECT Id_Video FROM VIDEO WHERE Path LIKE CONCAT(SUBSTRING_INDEX(?, '?', 1), '%')";
        $stmt_id_video = mysqli_prepare($con, $sql_id_video);
        mysqli_stmt_bind_param($stmt_id_video, "s", $path);
        mysqli_stmt_execute($stmt_id_video);
        mysqli_stmt_store_result($stmt_id_video);

        // Verifica si se encontró el Id_Video
        if (mysqli_stmt_num_rows($stmt_id_video) == 1) {
            mysqli_stmt_bind_result($stmt_id_video, $id_video);
            mysqli_stmt_fetch($stmt_id_video);

            // Consulta SQL para obtener todos los comentarios dado el Id_Video
            $sql_comentarios = "SELECT COMMENT.Content, USER.UserName
                                FROM COMMENT
                                INNER JOIN USER ON COMMENT.Id_User = USER.Id_User
                                WHERE COMMENT.Id_Video = ?";
            // Prepara la consulta para los comentarios
            $stmt_comentarios = mysqli_prepare($con, $sql_comentarios);

            // Vincula los parámetros
            mysqli_stmt_bind_param($stmt_comentarios, "i", $id_video);

            // Ejecuta la consulta de comentarios
            mysqli_stmt_execute($stmt_comentarios);

            // Almacena el resultado
            mysqli_stmt_store_result($stmt_comentarios);

            // Puedes procesar los resultados aquí, por ejemplo, imprimirlos en una tabla
            while (mysqli_stmt_fetch($stmt_comentarios)) {
                echo "Comentario: " . $content . " - Usuario: " . $userName . "<br>";
            }

            // Cierra la consulta preparada para comentarios
            mysqli_stmt_close($stmt_comentarios);
        } else {
            // Si no se encuentra el Id_Video, maneja la situación apropiadamente
            echo "Ups! Hubo un error al obtener los comentarios. Video no encontrado. Path: $path";
        }

        // Cierra la consulta preparada para el Id_Video
        mysqli_stmt_close($stmt_id_video);

    } catch (Exception $e) {
        // Manejar la excepción de la base de datos, por ejemplo, registrándola o mostrándola
        die($e->getMessage());
    }

    // Cierra la conexión a la base de datos
    mysqli_close($con);
}
?>
