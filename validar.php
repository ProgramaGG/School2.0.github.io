<?php
$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
session_start();
$_SESSION['usuario'] = $usuario;

// Conectar a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'bibliotecav2');

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Establecer el conjunto de caracteres a UTF-8
$conexion->set_charset("utf8");

// Preparar la consulta
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE Usuario = ? AND Contrasena = ?");
if ($stmt === false) {
    header(" index.php");
}

// Enlazar los parámetros
$stmt->bind_param("ss", $usuario, $contraseña);

// Ejecutar la consulta
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar el resultado
if ($resultado && $resultado->num_rows > 0) {
    $filas = $resultado->fetch_array();
    if ($filas['id_cargo'] == 1) {
        header("Location: ADMIN/Estudiantes.php");
        exit;
    } elseif ($filas['id_cargo'] == 2) {
        header("Location: Inicio.php");
        exit;
    }
} else {
    // Si no hay resultados, redirigir al formulario de inicio de sesión con un mensaje de error
    header("Location: index.php");
    exit;
}

// Liberar el resultado
$resultado->free();

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>
