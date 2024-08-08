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
    $usuario = $data['Usuario'];
    $nombre = $data['Nombre'];
    $apellido = $data['Apellidos'];
    $correo = $data['Correo'];
    $idcardo = $data['id_cargo'];
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Libros - biblioteca</title>
        <link rel="icon" type="image/x-icon" href="../assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> 
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
            <a class="navbar-brand js-scroll-trigger" href="#page-top">
                
            
                <span class="d-block d-lg-none">Bibliotecary Mercedary</span>
                
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="../assets/img/Merced.jpg " alt="..." /></span>
                
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                   
                     <h4>Administrador:</h4>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" ><?php echo $nombre?> </a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" ><?php echo $apellido?> </a></li>
                    <br><h4>Contenido:</h4>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="Estudiantes.php">Estudiantes</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#">Libros</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="PrestamosA.php">Prestamos</a></li>
                    
                   
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
                    
                <span class="d-none d-lg-block"><img class="img-fluid img-profile  mx-auto mb-2" src="../assets/img/libro.png" width="150px" height="150px" " /></span>
                    <h1 class="libro display-4 fw-bolder">Bibliotecary Mercedary</h1>
                    <p class="libro2 lead fw-normal -50 mb-0">Sabiduría en páginas</p>
                </div>
            </div>
        </header>
        <section>
    <!-- Section-->
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php
if (isset($_GET["busqueda"]) && $_GET["busqueda"] != '') {
    $busqueda = $_GET['busqueda'];
    $sql = "SELECT * FROM libros WHERE Nombre LIKE '%$busqueda%'";
} else {
    $sql = "SELECT * FROM libros";
}

$result = mysqli_query($conexion, $sql);
$counter = 0; // Counter to create unique IDs

while ($mostrar = mysqli_fetch_array($result)) {
    $counter++;
    $modalId = "modal" . $counter;
?>
    <div class="col mb-5">
        <div class="card h-100">
            <!-- Sale badge-->
            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Año: <?php echo $mostrar['Epoca'] ?></div>
            <!-- Product Image-->
            <img class="ima" src="../<?php echo $mostrar['Imagen'] ?>"  />
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder">Autor:</h5>
                    <!-- Product price-->
                    <?php echo $mostrar['Autor'] ?>
                </div>
            </div>
            <!-- Product actions-->
            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                <div class="text-center">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-dark mt-auto" data-toggle="modal" data-target="#<?php echo $modalId; ?>">
                        Ver Libro
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="<?php echo $modalId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="exampleModalLongTitle"><?php echo $mostrar['Nombre'] ?></h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img class="ima" src="../<?php echo $mostrar['Imagen'] ?>" width="350px" />
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
