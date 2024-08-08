<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <link rel="stylesheet" href="css/LOGINstyle.css"> <!-- Asegúrate de que este archivo exista -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <title>Iniciar Sesión - Biblioteca</title>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="validar.php" class="sign-in-form" method="POST">
                    <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/Merced.jpg" alt="..."></span>
                    <h2 class="title">Iniciar Sesión</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Usuario" name="usuario" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Contraseña" name="contraseña" required>
                    </div>
                    <input type="submit" value="Ingresar" class="btn solid">
                    <p class="social-text">O ingrese por estas plataformas</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
                <form action="" class="sign-up-form" method="POST">
                <?php
// Conectar a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'bibliotecav2');

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (!empty($_POST["registroU"])) {
    if (empty($_POST["usuario"]) || empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["email"]) || empty($_POST["contraseña"]) || empty($_POST["cargo"])) {
        echo 'Uno de los campos está vacío';
    } else {
        $usuario = $_POST["usuario"];
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $email = $_POST["email"];
        $contraseña = $_POST["contraseña"];
        $id_cargo = $_POST["cargo"];

        // Verificar si el correo ya existe en la base de datos
        $verificarCorreo = $conexion->query("SELECT * FROM usuarios WHERE Correo='$email'");
        if ($verificarCorreo->num_rows > 0) {
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">';
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
            Swal.fire({
                title: "Error",
                text: "El correo ya está registrado",
                icon: "error",
                confirmButtonText: "OK"
            });
            </script>';
        } else {
            // Insertar el nuevo usuario en la base de datos
            $sql = $conexion->query("INSERT INTO usuarios (Usuario, Nombre, Apellidos, Correo, Contrasena, id_cargo) VALUES ('$usuario', '$nombre', '$apellido', '$email', '$contraseña', '$id_cargo')");

            if ($sql) {
                echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">';
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo '<script>
                Swal.fire({
                    title: "¡Registro Exitoso!",
                    text: "Bienvenido estudiante",
                    icon: "success",
                    confirmButtonText: "OK"
                });
                </script>';
            } else {
                echo 'Error en el registro: ' . mysqli_error($conexion);
            }
        }
    }
}
?>


                
                    <h2 class="title">REGISTRATE</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Usuario" name="usuario" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nombres" name="nombre" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Apellidos" name="apellido" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Contraseña" name="contraseña" required>
                        <input type="text"style="display: none;" value="2" name="cargo" required>
                    </div>
                    <input type="submit" class="btn" value="Registrar" name="registroU">
                    <p class="social-text">O regístrate en plataformas sociales</p>
                    <div class="social-media">
                        <a href="#" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>¿Nuevo aquí?</h3>
                    <p>
                        Te invitamos a registrarte con tu correo institucional presionando 
                        el botón de abajo.
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        REGISTRATE
                    </button>
                </div>
                <img src="img/log.svg" class="image" alt="Log Image"> <!-- Asegúrate de que esta imagen exista -->
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>¿Uno de nosotros?</h3>
                    <p>
                        Inicia sesión con tu usuario y contraseña presionando 
                        el botón de abajo.
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        INGRESAR
                    </button>
                </div>
                <img src="img/register.svg" class="image" alt="Register Image"> <!-- Asegúrate de que esta imagen exista -->
            </div>
        </div>
    </div>
    
    <script src="js/app.js"></script> <!-- Asegúrate de que este archivo exista -->
    
</body>
</html>

