<?php
// Conecta a la base de datos (debes tener una conexión a la base de datos configurada)
include('db.php');

// Consulta SQL para seleccionar todos los videos
$sql = "SELECT * FROM Video";

// Ejecuta la consulta
$result = mysqli_query($con, $sql);

// Verifica si se encontraron videos
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $titulo = $row['title'];
        $author = $row['author'];
        $description = $row['description'];
        $state = $row['id_state'];
        $path = $row['path'];

        // Muestra la información del video en una plantilla HTML
        echo "<div class='video'>
                  <h2>$title</h2>
                  <p>$description</p>
                  <iframe width='560' height='315' src='$path' frameborder='0' allowfullscreen></iframe>
              </div>";
    }
} else {
    echo "No se encontraron videos.";
}

// Cierra la conexión a la base de datos
mysqli_close($con);
?>
