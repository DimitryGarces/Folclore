<?php
// Conecta a la base de datos (debes tener una conexión a la base de datos configurada)
include('dbMariaDB.php');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/escalacion.css">
</head>

<body>
    <?php
    // Consulta SQL para seleccionar todos los videos
    $sqlBC = "SELECT * FROM VIDEO WHERE Id_State=1 ORDER BY DatePublic";

    // Ejecuta la consulta
    $resultBC = mysqli_query($con, $sqlBC);

    // Verifica si se encontraron videos
    if (mysqli_num_rows($resultBC) > 0) {
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
    // Cierra la conexión a la base de datos
    mysqli_close($con);
