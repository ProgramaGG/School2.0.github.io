<?php
session_start();
// Conectar a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'bibliotecav2');

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
$user = $_SESSION['usuario'];
$sql = "SELECT Usuario, Nombre, Apellidos, Correo, id_cargo FROM usuarios WHERE usuario='".$user."'";
$resultado = $conexion->query($sql);

while($data = $resultado->fetch_assoc()){
    $nombre = $data['Nombre'];
    $apellido = $data['Apellidos'];
}

// Redirigir automáticamente si no se ha realizado una búsqueda
if (!isset($_GET["busqueda"])) {
    header("Location: ?busqueda=".$apellido);
    exit();
}

// Consulta para obtener préstamos únicos por libro
if (isset($_GET["busqueda"]) && $_GET["busqueda"] != '') {
    $busqueda = $_GET['busqueda'];
    $sql = "SELECT Estudiante, Autor, Obra, MIN(FechaPedido) as FechaPedido, MIN(FechaEntrega) as FechaEntrega FROM prestamos WHERE Estudiante LIKE '%$busqueda%' GROUP BY Estudiante, Autor, Obra";
} else {
    $sql = "SELECT Estudiante, Autor, Obra, MIN(FechaPedido) as FechaPedido, MIN(FechaEntrega) as FechaEntrega FROM prestamos WHERE Estudiante='$apellido' GROUP BY Estudiante, Autor, Obra";
}

$result = mysqli_query($conexion, $sql);

// Si no hay resultados, redirigir a otra página o mostrar un mensaje
if (mysqli_num_rows($result) == 0) {
    include("NPrestamos.php");
    exit();
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


<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <span class="d-none d-lg-block"><img class="img-fluid img-profile mx-auto mb-2" src="assets/img/libro.png" width="150px" height="150px" /></span>
            <h1 class="libro display-4 fw-bolder">Tabla de libros prestados</h1>
            <p class="libro2 lead fw-normal -50 mb-0">Sabiduría en páginas</p>
        </div>
    </div>
</header>

<div class="container">
    <div class="main-body">
    
          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <br>
          </nav>
          <!-- /Breadcrumb -->
          <?php
                        $numero = 1;
                        while ($mostrar = mysqli_fetch_array($result)) {
                        ?>
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <h3><?php echo $numero++; ?>° Prestamo</h3>
                    
                    <h4>Obra:</h4>
                    <img class="img" src="<?php echo $mostrar['Obra'] ?>" width="100px" height="150px" /><br>
                   <h5>Autor: <?php echo $mostrar['Autor']?></h5>
                   
                  </div>
                </div>
              </div>

             
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Alumno:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $nombre?> <?php echo $apellido?>
                    </div>
                  </div>
                  <hr>
                <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"> Cantidad:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    Unidad(1)
                    </div>
                  </div>
                  <hr> 
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"> Día pedido:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $mostrar['FechaPedido']?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0"> Día entrega:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $mostrar['FechaEntrega']?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Estado:</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <p class="status pending">Pendiente</p>
                    </div>
                  </div>
                  <style>
                    .status {
                        width: 12   0px;
                        color: black;
    padding: .2rem 0;
    border-radius: 2rem;
    text-align: center;
    width: 120px;
}
                    .status.pending {
    background-color: #ebc474;
}
                  </style>
                  
                    
                  </div>
                </div>
              </div>
            </div>
            <?php
                        }
                        ?>
          </div>
          

        </div>
    </div>
    </div>
    
    </div>
    






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
