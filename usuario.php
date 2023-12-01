<?php
session_start(); // Asegúrate de haber iniciado la sesión

// Verifica si el nombre de usuario está almacenado en la sesión
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
    // Ahora puedes mostrar el nombre de usuario en tu página
    echo "Bienvenido, $nombre_usuario!";
    ?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <title>Página de Inicio</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
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

            <div class="video-category">
                <h2>Baja California!</h2>
                <section class="video-grid">
                    <?php include('BJC.php'); ?>
                </section>
                <img src="pictures/BAJA CAL.png" alt="Jalisco Image">
            </div>

            <div class="video-category">
                <h2>Jalisco!</h2>
                <section class="video-grid">
                    <?php include('Jalisco.php'); ?>
                </section>
                <img src="pictures/JAL.png" alt="Jalisco Image">
            </div>

            <div class="video-category">
                <h2>Veracruz!</h2>
                <section class="video-grid">
                    <?php include('Veracruz.php'); ?>
                </section>
                <img src="pictures/VERA.png" alt="Jalisco Image">
            </div>
            </section>
        </main>


        <footer>
            <div class="footer-content">
                <p>¿Desea contactarnos para colaborar en un video?</p>
                <p>Envíenos un correo a: <a href="mailto:chispafolklor@gmail.com">chispafolklor@gmail.com</a></p>
            </div>
        </footer>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const videoLinks = document.querySelectorAll('.video-link');

                videoLinks.forEach(function (videoLink) {
                    videoLink.addEventListener('click', function (event) {
                        event.preventDefault(); // Previene el comportamiento predeterminado del enlace

                        const videoURL = this.getAttribute('href');
                        const nombreUsuario = "<?php echo $nombre_usuario; ?>"; // Obtén el nombre de usuario de PHP
                        const videoURLConUsuario = `${videoURL}?usuario=${nombreUsuario}`;

                        window.open(videoURLConUsuario, 'muestra-video', 'width=800,height=600');
                        console.log('Clic en el video:', videoURLConUsuario); // Agregar un registro en la consola
                    });
                });
            });
        </script>

    </body>

    </html>

    <?php
} else {
    // Si el nombre de usuario no está en la sesión, maneja la situación apropiadamente
    echo "El nombre de usuario no está en la sesión.";
}
?>