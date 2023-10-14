<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

// Incluye la conexión a la base de datos desde db.php
include('db.php');

// Verifica si se enviaron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los valores del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];

    try {
        $sql_usuario = "SELECT User.Id_User, User.Id_Rol
        FROM User
        WHERE User.UserName = ? 
        AND User.Password = ?";

        // Prepara la consulta para el usuario
        $stmt_usuario = mysqli_prepare($con, $sql_usuario);

        // Vincula los parámetros
        mysqli_stmt_bind_param($stmt_usuario, "ss", $nombre_usuario, $contraseña);

        // Ejecuta la consulta para el usuario
        mysqli_stmt_execute($stmt_usuario);

        // Almacena el resultado
        mysqli_stmt_store_result($stmt_usuario);

        // Verifica si se encontró un usuario con las credenciales proporcionadas
        if (mysqli_stmt_num_rows($stmt_usuario) == 1) {
            // Extraer los resultados de la consulta
            mysqli_stmt_bind_result($stmt_usuario, $id_usuario, $id_rol);

            // Leer el resultado
            mysqli_stmt_fetch($stmt_usuario);

            // Verificar si el ID_Rol es 1 o 2
            if ($id_rol == 1 || $id_rol == 2) {
                // Credenciales válidas para usuario normal o administrador, redirecciona a la página correspondiente
                if ($id_rol == 1) {
                    // Usuario normal
                    header("Location: usuario.html");
                } else if ($id_rol == 2) {
                    // Administrador
                    header("Location: administrador.html");
                }


                // Credenciales incorrectas, redirige con un mensaje de error
                $mensaje_error = "Credenciales incorrectas. Intente nuevamente.";
                header("Location: InicioSesion.php?error=" . urlencode($mensaje_error));
                exit();

                // Cierra las consultas preparadas
                mysqli_stmt_close($stmt_usuario);
                mysqli_stmt_close($stmt_empleado);
            }
        }
    } catch (Exception $e) {
        // Manejar la excepción de la base de datos, por ejemplo, registrándola o mostrándola
        die($e->getMessage());
    }

    // Cierra la conexión a la base de datos
    mysqli_close($con);
}
