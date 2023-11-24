<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-S">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/stylesheet.css">
    <style>
        body {
            background-image: url('css/Fondo.jpeg');
            background-size: contain;
            /* Ajusta la imagen al tamaño del cuerpo */
            background-repeat: repeat;
            /* Evita la repetición de la imagen */
        }
    </style>
</head>

<body>
    <!-- Botón de regreso -->
    <a href="Principal.html" class="back-button">
        <img src="css/volver.png" alt="Volver" width="50" height="50">
    </a>
    <div class="formulario">
        <h1>Inicio de Sesión</h1>
        <!-- Muestra el mensaje de error si existe -->
        <?php
        if (isset($_GET['error'])) {
            echo '<div class="error-message">' . htmlspecialchars($_GET['error']) . '</div>';
        }
        ?>
        <form action="login_process.php" method="post">
            <div class="username">
                <input type="text" name="nombre_usuario" required>
                <label for="nombre_usuario">Nombre de Usuario</label>
            </div>
            <div class="username">
                <input type="password" name="contraseña" required>
                <label for="contraseña">Contraseña</label>
            </div>
            <div class="recordar">
                <a href="#" id="olvidoContraseña">¿Olvidó su contraseña?</a>
            </div>
            <input type="submit" value="Iniciar">
            <div class="registrarse">
                Quiero hacer el <a href="RegistroUsuario.php"> registro</a>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('olvidoContraseña').onclick = function () {
            // Dirección de correo electrónico del destinatario
            var destinatario = 'chispaFolclore@gmail.com';

            // Asunto y cuerpo del mensaje predeterminados
            var asunto = 'Recuperar Contraseña';
            var cuerpoMensaje = 'Hola, olvidé mi contraseña, mi posible usuario era [Usuario] ¿Puedes ayudarme?';

            // Construye el enlace de correo electrónico
            var enlaceCorreo = 'https://mail.google.com/mail/?view=cm&to=' + encodeURIComponent(destinatario) + '&su=' + encodeURIComponent(asunto) + '&body=' + encodeURIComponent(cuerpoMensaje);
            // Abre una nueva ventana o pestaña con el enlace de correo
            window.open(enlaceCorreo, '_blank');

            // Evita que el enlace predeterminado se ejecute
            return false;
        };
    </script>
</body>

</html>