<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Incluye la conexión a la base de datos desde db.php
include('dbMariaDB.php');
session_start();

// Verifica si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén el valor del comentario, el nombre de usuario y el path del formulario
    $comentario = $_POST['comentario'];
    $nombre_usuario = $_POST['nombre_usuario'];
    $path = $_POST['videoPath']; // Asegúrate de tener este valor disponible en el formulario

    try {
        // Obtén el Id_User correspondiente al nombre de usuario
        $sql_id_usuario = "SELECT Id_User FROM USER WHERE UserName = ?";
        $stmt_id_usuario = mysqli_prepare($con, $sql_id_usuario);
        mysqli_stmt_bind_param($stmt_id_usuario, "s", $nombre_usuario);
        mysqli_stmt_execute($stmt_id_usuario);
        mysqli_stmt_store_result($stmt_id_usuario);

        // Verifica si se encontró el usuario
        if (mysqli_stmt_num_rows($stmt_id_usuario) == 1) {
            mysqli_stmt_bind_result($stmt_id_usuario, $id_usuario);
            mysqli_stmt_fetch($stmt_id_usuario);

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

                // Inserta el comentario en la tabla COMMENT
                $sql_comentario = "INSERT INTO COMMENT (Id_User, Id_Video, DatePublic, Content) VALUES (?, ?, NOW(), ?)";
                $stmt_comentario = mysqli_prepare($con, $sql_comentario);

                // Vincula los parámetros
                mysqli_stmt_bind_param($stmt_comentario, "iis", $id_usuario, $id_video, $comentario);

                // Ejecuta la consulta para el comentario
                mysqli_stmt_execute($stmt_comentario);

                // Cierra las consultas preparadas
                mysqli_stmt_close($stmt_id_usuario);
                mysqli_stmt_close($stmt_id_video);
                mysqli_stmt_close($stmt_comentario);

                // Redirecciona o realiza alguna otra acción después de insertar el comentario
                header("Location: muestra-video.php?path=$path"); // Puedes pasar el path como parámetro
                exit();
            } else {
                // Si no se encuentra el Id_Video, maneja la situación apropiadamente
                echo "Ups! Hubo un error al procesar tu comentario. Video no encontrado. Path: $path";
            }
        } else {
            // Si no se encuentra el usuario, maneja la situación apropiadamente
            echo "Ups! Hubo un error al procesar tu comentario. Usuario no encontrado.";
        }
    } catch (Exception $e) {
        // Manejar la excepción de la base de datos, por ejemplo, registrándola o mostrándola
        die($e->getMessage());
    }

    // Cierra la conexión a la base de datos
    mysqli_close($con);
}
?>