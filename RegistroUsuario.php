<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>Registro</title>
  <link rel="stylesheet" href="css/stylesheet.css" />
  <style>
        body {
            background-image: url('css/Fondo.jpeg');
            background-size: contain; /* Ajusta la imagen al tamaño del cuerpo */
            background-repeat: repeat; /* Evita la repetición de la imagen */
        }
    </style>
</head>

<body>
    <a href="javascript:history.back()" class="back-button">
        <img src="css/volver.png" alt="Volver" width="50" height="50">
    </a>
  <div class="sing-up_form">
    <h1>Registro</h1>
    <!-- Muestra el mensaje de error si existe -->
    <?php
    if (isset($_GET['error'])) {
      echo '<div class="error-message">' . htmlspecialchars($_GET['error']) . '</div>';
    }
    ?>
    <form action="sign_up_proccess.php" method="post">
      <div class="registration_data">
        <input type="text" name="name" id="name"
          oninput="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1).toLowerCase();" required />
        <label for="name">Nombre</label>
      </div>

      <div class="registration_data">
        <input type="text" name="last_name" id="last_name"
          oninput="this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1).toLowerCase();" required />
        <label for="last_name">Apellido paterno</label>
      </div>

      <div class="registration_data">
        <input type="number" name="age" id="age" min="18" max="120"
          oninvalid="this.setCustomValidity('La edad debe estar entre 18 y 120 años')" required />
        <label for="age">Edad</label>
      </div>

      <div class="registration_data">
        <input type="text" name="username" id="username" required />
        <label for="username">Nombre de usuario</label>
      </div>

      <div class="registration_data">
        <input type="password" name="pass" id="pass" required />
        <label for="pass">Contraseña</label>
      </div>

      <div class="registration_data">
        <input type="password" name="conf_pass" id="conf_pass" required />
        <label for="conf_pass">Confirmar contraseña</label>
      </div>

      <button type="submit" id="registroButton" onclick="return validarRegistro()">
        Registrarse
      </button>
      <script>
        function validarRegistro() {

          var pass = document.getElementById("pass").value;
          var confPass = document.getElementById("conf_pass").value;
          var edadInput = document.getElementById("age");

          // Validar que las contraseñas coincidan
          if (pass !== confPass) {
            alert("Las contraseñas no coinciden.");
            return false;
          }

          // Restablecer el estado de validación del campo
          edadInput.setCustomValidity('');

          //Si llegamos aquí el formulario es valido
          return true;
        }
      </script>
    </form>
  </div>
</body>

</html>