<?php
// Conecta a la base de datos (debes tener una conexión a la base de datos configurada)
include('dbMariaDB.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/escalacion.css">
    <style>
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            position: absolute;
            bottom: 0;
            width: 100%;
        }

        .footer-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Estilos para los enlaces en el pie de página */
        footer a {
            color: #fff;
            text-decoration: none;
        }

        /* Estilos para resaltar el enlace de correo */
        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php
    // Consulta SQL para seleccionar todos los videos
    $sqlBC = "SELECT * FROM VIDEO WHERE Id_State=1 ORDER BY DatePublic";
    $sqlJ = "SELECT * FROM VIDEO WHERE Id_State=2 ORDER BY DatePublic";
    $sqlV = "SELECT * FROM VIDEO WHERE Id_State=3 ORDER BY DatePublic";

    // Ejecuta la consulta
    $resultBC = mysqli_query($con, $sqlBC);
    $resultJ = mysqli_query($con, $sqlJ);
    $resultV = mysqli_query($con, $sqlV);

    // Verifica si se encontraron videos
    if (mysqli_num_rows($resultBC) > 0) {
        ?>
        <footer>
            <div class="footer-content">
                <p>Baja california!</p>
            </div>
        </footer>
        <?php
        while ($row = mysqli_fetch_assoc($resultBC)) {
            $titulo = $row['Title'];
            $author = $row['Author'];
            $description = $row['Description'];
            $state = $row['Id_state'];
            $path = $row['Path'];
            $pathImage = $row['PathImage'];

            // Muestra la información del video en una plantilla HTML
            echo "<div class='video'>
    <h2>$titulo</h2>
    <p>$description</p>
    <a href='muestra-video.php?path=$path' class='video-link' data-video-path='$path'>
        <img src='$pathImage' alt='No deberias estar viendo este texto'  class='scaled-image'>
    </a>
</div>";
        }
    } else {
        echo "No se encontraron videos sobre Baja California.";
    }
    if (mysqli_num_rows($resultJ) > 0) {
        ?>
        <footer>
            <div class="footer-content">
                <p>Jalisco!</p>
            </div>
        </footer>
        <?php
        while ($row = mysqli_fetch_assoc($resultJ)) {
            $titulo = $row['Title'];
            $author = $row['Author'];
            $description = $row['Description'];
            $state = $row['Id_state'];
            $path = $row['Path'];
            $pathImage = $row['PathImage'];

            // Muestra la información del video en una plantilla HTML
            echo "<div class='video'>
    <h2>$titulo</h2>
    <p>$description</p>
    <a href='muestra-video.php?path=$path' class='video-link' data-video-path='$path'>
        <img src='$pathImage' alt='No deberias estar viendo este texto'  class='scaled-image'>
    </a>
</div>";
        }
    } else {
        echo "No se encontraron videos sobre Jalisco.";
    }
    if (mysqli_num_rows($resultV) > 0) {
        ?>
        <footer>
            <div class="footer-content">
                <p>Veracruz</p>
            </div>
        </footer>
        <?php
        while ($row = mysqli_fetch_assoc($resultV)) {
            $titulo = $row['Title'];
            $author = $row['Author'];
            $description = $row['Description'];
            $state = $row['Id_state'];
            $path = $row['Path'];
            $pathImage = $row['PathImage'];

            // Muestra la información del video en una plantilla HTML
            echo "<div class='video'>
    <h2>$titulo</h2>
    <p>$description</p>
    <a href='muestra-video.php?path=$path' class='video-link' data-video-path='$path'>
        <img src='$pathImage' alt='No deberias estar viendo este texto'  class='scaled-image'>
    </a>
</div>";
        }
    } else {
        echo "No se encontraron videos sobre Veracruz.";
    }

    // Cierra la conexión a la base de datos
    mysqli_close($con);
