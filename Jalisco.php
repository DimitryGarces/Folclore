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
    $sqlJ = "SELECT * FROM VIDEO WHERE Id_State=2 ORDER BY DatePublic";

    $resultJ = mysqli_query($con, $sqlJ);

    if (mysqli_num_rows($resultJ) > 0) {
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
