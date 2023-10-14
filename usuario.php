<?php
session_start(); // Asegúrate de haber iniciado la sesión

// Verifica si el nombre de usuario está almacenado en la sesión
if (isset($_SESSION['nombre_usuario'])) {
    $nombre_usuario = $_SESSION['nombre_usuario'];
    // Ahora puedes mostrar el nombre de usuario en tu página
    echo "Bienvenido, $nombre_usuario!";

?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Página de Inicio</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>

    <body>
        <header>
            <nav>
                <ul>
                    <li><a href="#">Inicio</a></li>
                </ul>
            </nav>
            <div class="user-menu">
                <div class="user-profile">
                    <span><?php echo $nombre_usuario; ?></span>
                </div>
                <ul>
                    <li><a href="#">Mi Perfil</a></li>
                    <li><a href="InicioSesion.php">Cerrar Sesión</a></li>
                </ul>
            </div>
        </header>

        <main>
        <section class="video-grid">
            <?php include('videos.php'); ?>
        </section>
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