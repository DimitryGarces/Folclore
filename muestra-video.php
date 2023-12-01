<?php
session_start(); // Asegúrate de haber iniciado la sesión
include('dbMariaDB.php');
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
    // Verifica si el parámetro "path" se encuentra en la URL
    if (isset($_GET['path'])) {
        $videoPath = $_GET['path'];
        ?>

        <!DOCTYPE html>
        <html>

        <head>
            <meta charset="UTF-8">
            <title>Video</title>
            <link rel="stylesheet" type="text/css" href="css/styles.css">
            <style>
                .video-container {
                    width: 800px;
                    /* Ajusta el ancho según tus necesidades */
                    height: 600px;
                    /* Ajusta el alto según tus necesidades */
                }

                main {
                    flex: 1;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
            </style>
        </head>

        <body>
            <header>
                <nav>
                    <ul>
                        <li><a href="Principal.html">Inicio</a></li>
                    </ul>
                </nav>
                <div class="user-menu">
                    <div class="user-profile">
                        <span>
                            <?php echo $nombre_usuario; ?>
                        </span>
                    </div>
                    <ul>
                        <li><a href="InicioSesion.php">Cerrar Sesión</a></li>
                    </ul>
                </div>
            </header>

            <main>
                <div class="video-container">
                    <h2>Haznos saber qué opinas en los comentarios!</h2>
                    <?php
                    // Puedes utilizar $videoPath para mostrar el video o realizar otras operaciones
                    echo "<iframe width='800' height='600' src='$videoPath' frameborder='0'></iframe>";
                    ?>
                    <h2>Deja tu comentario:</h2>
                    <form action="procesar_comentario.php" method="post">
                        <!-- Campos ocultos -->
                        <input type="hidden" name="nombre_usuario" value="<?php echo $nombre_usuario; ?>">
                        <input type="hidden" name="videoPath" value="<?php echo $videoPath; ?>">

                        <!-- Resto del formulario -->
                        <textarea name="comentario" rows="4" cols="50" placeholder="Escribe tu comentario aquí"
                            required></textarea>
                        <br>
                        <input type="submit" value="Enviar comentario">
                    </form>
                    <!-- Sección para mostrar comentarios -->
                    <div>
                        <h2>Comentarios:</h2>
                        <?php
                        // Consulta SQL para obtener comentarios asociados al video
                        $sql_comentarios = "SELECT C.Content, U.UserName, C.DatePublic
                    FROM COMMENT C
                    JOIN USER U ON C.Id_User = U.Id_User
                    WHERE C.Id_Video = (SELECT Id_Video FROM VIDEO WHERE Path LIKE CONCAT(SUBSTRING_INDEX(?, '?', 1), '%'))
                    ORDER BY C.Id_Comment DESC";

                        $stmt_comentarios = mysqli_prepare($con, $sql_comentarios);
                        mysqli_stmt_bind_param($stmt_comentarios, "s", $videoPath);
                        mysqli_stmt_execute($stmt_comentarios);
                        mysqli_stmt_store_result($stmt_comentarios);

                        // Verifica si hay comentarios
                        if (mysqli_stmt_num_rows($stmt_comentarios) > 0) {
                            mysqli_stmt_bind_result($stmt_comentarios, $comentario, $nombre_usuario_comentario, $fecha_comentario);

                            // Muestra cada comentario
                            while (mysqli_stmt_fetch($stmt_comentarios)) {
                                echo "<p><strong>$nombre_usuario_comentario</strong> - $fecha_comentario</p>";
                                echo "<p>$comentario</p>";
                                echo "<hr>";
                            }
                        } else {
                            echo "<p>No hay comentarios.</p>";
                        }

                        // Cierra la consulta preparada
                        mysqli_stmt_close($stmt_comentarios);
                        ?>
                    </div>

                </div>
            </main>
        </body>

        </html>

        <?php
    } else {
        // Si no se proporcionó el parámetro "path", maneja la situación apropiadamente
        echo "No se especificó un video para mostrar.";
    }
}
?>