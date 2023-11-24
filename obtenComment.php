<?php
include('dbMariaDB.php');
session_start();

// Verifica si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    // Cierra la conexión a la base de datos
    
}else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Obtén los valores del formulario
    $Id_Video = $_POST['Id_Video'];
    try {
        $sql_commentario = "SELECT COMMENT.Content, USER.Name FROM COMMENT LEFT JOIN USER on 
        COMMENT.Id_User = USER.Id_User WHERE Id_Video= ? ;  
        FROM USER
        WHERE UserName = ? 
        AND Password = ? ";

        // Prepara la consulta para el usuario
        $stmt_usuario = mysqli_prepare($con, $sql_commentario);

        // Vincula los parámetros
        mysqli_stmt_bind_param($stmt_usuario, "i",$Id_Video);

        // Ejecuta la consulta para el usuario
        mysqli_stmt_execute($stmt_usuario);

        // Almacena el resultado
        mysqli_stmt_store_result($stmt_usuario);

        // Verifica si se encontró un usuario con las credenciales proporcionadas
        if (mysqli_stmt_num_rows($stmt_usuario) >= 1) {
            // Extraer los resultados de la consulta
            mysqli_stmt_bind_result($stmt_usuario, $Content, $Name);

            // Leer el resultado
            mysqli_stmt_fetch($stmt_usuario);

            // Cierra las consultas preparadas
            mysqli_stmt_close($stmt_usuario);
        }else {
            // Credenciales incorrectas, redirige con un mensaje de error
            $mensaje_error = "Credenciales incorrectas. Intente nuevamente.";
            header("Location: InicioSesion.php?error=" . urlencode($mensaje_error));
            exit();
        }
    } catch (Exception $e) {
        // Manejar la excepción de la base de datos, por ejemplo, registrándola o mostrándola
        die($e->getMessage());
    }
}
mysqli_close($con);