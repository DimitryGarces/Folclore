
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
            background-size: contain; /* Ajusta la imagen al tamaño del cuerpo */
            background-repeat: repeat; /* Evita la repetición de la imagen */
        }
    </style>
</head>
<body>
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
                <input type="text" name="nombre_usuario" required >
                <label for="nombre_usuario">Nombre de Usuario</label>
            </div>
            <div class="username">
                <input type="password" name="contraseña" required>
                <label for="contraseña">Contraseña</label>
            </div>
            <div class="recordar">¿Olvido su contraseña?</div>
            <input type="submit" value="Iniciar">
            <div class="registrarse">
                Quiero hacer el <a href="RegistroUsuario.php"> registro</a>
            </div>
        </form>
    </div>
</body>
</html>