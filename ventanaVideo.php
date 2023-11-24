<?php
session_start(); // Asegúrate de haber iniciado la sesión
?>

<!DOCTYPE html>
<html lang="es">

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
            flex-direction: column; /* Alinea los elementos en columna */
        }

        .comment-section {
            margin-top: 20px;
            width: 100%;
            max-width: 800px; /* Ajusta según tus necesidades */
        }

        .comment-section textarea {
            width: 100%;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        .comment-section input[type="submit"] {
            padding: 10px;
            cursor: pointer;
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
            <h2>Haznos saber que opinas en los comentarios!</h2>
            <?php
            // Verifica si el nombre de usuario está almacenado en la sesión
            if (isset($_SESSION['nombre_usuario'])) {
                $nombre_usuario = $_SESSION['nombre_usuario'];
                // Recupera el parámetro "path" de la URL
                if (isset($_GET['path'])) {
                    $videoPath = $_GET['path'];

                    // Puedes utilizar $videoPath para mostrar el video o realizar otras operaciones
                    echo "<iframe width='800' height='600' src='$videoPath' frameborder='0'></iframe>";
                } else {
                    // Maneja el caso en el que no se proporciona el parámetro "path"
                    echo "No se especificó un video para mostrar.";
                }
                ?>
            </div>

            <div class="comment-section">
                <h2>Deja tu comentario:</h2>
                <form action="procesar_comentario.php" method="post">
                    <textarea name="comentario" rows="4" placeholder="Escribe tu comentario aquí" required></textarea>
                    <br>
                    <input type="submit" value="Enviar comentario">
                </form>
            </div>
        </main>

        <footer>
            <div class="footer-content">
                <p>¿Desea contactarnos para colaborar en un video?</p>
                <p>Envíenos un correo a: <a href="mailto:chispafolklor@gmail.com">chispafolklor@gmail.com</a></p>
            </div>
        </footer>
    </body>

    </html>
    <?php
    } else {
        // Si el nombre de usuario no está en la sesión, maneja la situación apropiadamente
    }
    ?>
