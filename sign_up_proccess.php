<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Incluye la conexión a la base de datos desde db.php
include('dbMariaDB.php');

// Inicia la sesión
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los valores del formulario
    $name = $_POST['name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    try {
        // Consulta SQL para verificar la existencia de un usuario
        $sql_busqueda_usuario = "SELECT username
                FROM USER
                WHERE username = ?";
        // Prepara la consulta para el usuario
        $stmt_busqueda_usuario = mysqli_prepare($con, $sql_busqueda_usuario);

        // Vincula los parámetros
        mysqli_stmt_bind_param($stmt_busqueda_usuario, "s", $username);

        // Ejecuta la consulta para la existencia de usuario
        mysqli_stmt_execute($stmt_busqueda_usuario);

        // Almacena el resultado
        mysqli_stmt_store_result($stmt_busqueda_usuario);

        // Verifica si se encontró un usuario normal con las credenciales proporcionadas
        if (mysqli_stmt_num_rows($stmt_busqueda_usuario) == 1) {
            // Credenciales válidas para usuario normal, pide que use otro usuario
            $mensaje_error = "Ya existe ese usuario, intente con otro.";
            header("Location: RegistroUsuario.php?error=" . urlencode($mensaje_error));
            exit();
        }

        // Ahora que hemos verificado que el usuario no existen, procedemos con la inserción
        // Consulta SQL para insertar datos en la tabla DatosPersonales
        $sql_insertar_datos = "INSERT INTO USER (Id_Rol, Name, LastName, UserName, Password, Age) 
        VALUES (2, ?, ?, ?, ?, ?)";
        // Prepara la consulta para la inserción
        $stmt_insertar_datos = mysqli_prepare($con, $sql_insertar_datos);

        // Vincula los parámetros
        mysqli_stmt_bind_param($stmt_insertar_datos, "ssssi", $name, $last_name, $username, $pass, $age);

        // Ejecuta la consulta de inserción
        mysqli_stmt_execute($stmt_insertar_datos);

        // Cierra las consultas preparadas
        mysqli_stmt_close($stmt_busqueda_usuario);
        mysqli_stmt_close($stmt_insertar_datos);

        // Establece la variable de sesión con el mensaje de éxito
        $_SESSION['success_message'] = "Registro exitoso";

        // Redirige a la ventana de registro
        header("Location: InicioSesion.php");
        exit();
    } catch (Exception $e) {
        // Manejar la excepción de la base de datos, por ejemplo, registrándola o mostrándola
        die($e->getMessage());
    }

    // Cierra la conexión a la base de datos
    mysqli_close($con);
}
?>