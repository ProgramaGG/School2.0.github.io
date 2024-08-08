<?php

// Conectar a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'bibliotecav2');

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Prestamos - biblioteca</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                
            
                <span class="d-block d-lg-none">Bibliotecary Mercedary</span>
                
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/Merced.jpg " alt="..." /></span>
                
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                   
                     <h4>Estudiante:</h4>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" ><?php echo $nombre?> </a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" ><?php echo $apellido?> </a></li>
                    <br><h4>Contenido:</h4>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Perfil.php">Mi perfil</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Inicio.php">Libros</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Prestamos.php">Mis prestamos</a></li>
                    
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Intereses.php">Intereses</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="" id="alertLink">Salir</a></li>
                    
                    <script>
        document.getElementById('alertLink').addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                title: "¿Cerrar Sesión?",
                text: "¡Una vez cerrado sesión tendrás que ingresar tus datos!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Sí, cerrar sesión',
                cancelButtonText: 'No, permanecer',
                dangerMode: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire("¡Has Cerrado Sesión correctamente!", {
                        icon: "success",
                    }).then(() => {
                        window.location.href = "index.php";
                    });
                }
            });
        });
    </script>
                </ul>
            </div>
        </nav>




<body>
<header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <span class="d-none d-lg-block"><img class="img-fluid img-profile mx-auto mb-2" src="assets/img/libro.png" width="150px" height="150px" /></span>
                <h1 class="libro display-4 fw-bolder">Tabla de libros prestados</h1>
                <p class="libro2 lead fw-normal -50 mb-0">Sabiduría en páginas</p>
            </div>
        </div>
    </header>

    <section class="py-5">
       

        <div class="container">
            <div class="row gx-4 gx-lg-4 align-items-center">
                <div class="col-md-7">
                    <div class="card-body p-3">
                       <h3> No tienes ningún prestamo de libro</h3>
<br/><br/><br/><br/><br/><br/><br/><br/>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 bg-dark">
        <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2024</p></div>
    </footer>

    <!-- Footer scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/visible.js"></script>
</body>
</html>