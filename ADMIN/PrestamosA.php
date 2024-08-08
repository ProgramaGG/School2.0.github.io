<?php
session_start();
// Conectar a la base de datos
$conexion = new mysqli('localhost', 'root', '', 'bibliotecav2');

// Verificar si la conexión fue exitosa
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$user = $_SESSION['usuario'];
$stmt = $conexion->prepare("SELECT Usuario, Nombre, Apellidos, Correo, id_cargo FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$resultado = $stmt->get_result();

if ($data = $resultado->fetch_assoc()) {
    $usuario = $data['Usuario'];
    $nombre = $data['Nombre'];
    $apellido = $data['Apellidos'];
    $correo = $data['Correo'];
    $idcardo = $data['id_cargo'];
}

$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Prestamos - biblioteca</title>
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../css/styles.css" rel="stylesheet" />
</head>
<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">
            <span class="d-block d-lg-none">Bibliotecary Mercedary</span>
            <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="../assets/img/Merced.jpg" alt="..." /></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav">
                <h4>Administrador:</h4>
                <li class="nav-item"><a class="nav-link js-scroll-trigger"><?php echo htmlspecialchars($nombre); ?></a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger"><?php echo htmlspecialchars($apellido); ?></a></li>
                <br><h4>Contenido:</h4>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Estudiantes.php">Estudiantes</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="InicioA.php">Libros</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="">Prestamos</a></li>
                <li class="nav-item"><a class="nav-link js-scroll-trigger" href="" id="alertLink">Salir</a></li>
                <script>
                    document.getElementById('alertLink').addEventListener('click', function(event) {
                        event.preventDefault();
                        swal({
                            title: "¿Cerrar Sesión?",
                            text: "¡Una vez cerrado sesión tendrás que ingresar tus datos!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                swal("¡Has Cerrado Sesión correctamente!", {
                                    icon: "success",
                                }).then(() => {
                                    window.location.href = "../index.php";
                                });
                            }
                        });
                    });
                </script>
            </ul>
        </div>
    </nav>
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <span class="d-none d-lg-block"><img class="img-fluid img-profile mx-auto mb-2" src="../assets/img/libro.png" width="150px" height="150px" alt="Libro"/></span>
                <h1 class="libro display-4 fw-bolder">Prestamos de estudiantes</h1>
                <p class="libro2 lead fw-normal mb-0">Sabiduría en páginas</p>
            </div>
        </div>
    </header>
    <section>
        <!-- Section-->
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-4 row-cols-xl-4 justify-content-center">
                <?php
                if (isset($_GET["busqueda"]) && $_GET["busqueda"] != '') {
                    $busqueda = $conexion->real_escape_string($_GET['busqueda']);
                    $sql = "SELECT * FROM prestamos WHERE Nombre LIKE '%$busqueda%'";
                } else {
                    $sql = "SELECT * FROM prestamos";
                }

                $result = $conexion->query($sql);

                // Si no hay resultados, redirigir a otra página o mostrar un mensaje
                if ($result->num_rows == 0) {
                    include("NPrestamosA.php");
                    exit();
                }

                while ($mostrar = $result->fetch_assoc()) {
                ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h4>Prestamo de:<br/></h4>
                               <h5> " <?php echo htmlspecialchars($mostrar['Estudiante']); ?> "</h5>
                                <h5>Obra:</h5>
                                <!-- Product image-->
                                <img src="../<?php echo htmlspecialchars($mostrar['Obra']); ?>" alt="Obra" width="150">
                                <br>
                                Autor: <?php echo htmlspecialchars($mostrar['Autor']); ?><br><br>
                                <h5>Fecha de pedido:</h5> <?php echo htmlspecialchars($mostrar['FechaPedido']); ?><br>
                                <h5>Fecha de entrega:</h5> <?php echo htmlspecialchars($mostrar['FechaEntrega']); ?>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="EliminarPres.php?id=<?php echo urlencode($mostrar['Idprestamo']); ?>">Entregado</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2024</p></div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>
</html>
<?php
$conexion->close();
?>
