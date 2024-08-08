<?php
// Conectar a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'bibliotecav2');

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}
?>

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
<html lang="es">
<head>
<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Libros - biblioteca</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    
</head>
<body id="page-top">
    <!-- Navigation-->
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
<div >
<form action="" method="GET">
   
</form>
</div>

<section class="py-5 ">
    
    <div class="container  px-4 px-lg-5 my-5">
        <?php
        
        if (isset($_GET["busqueda"]) && $_GET["busqueda"] != '') {
            $busqueda = $_GET['busqueda'];
            $sql = "SELECT * FROM libros WHERE Nombre LIKE '%$busqueda%'";
        } else {
            $sql = "SELECT * FROM libros";
        }
        
        $result = mysqli_query($conexion, $sql);
       

        while ($mostrar = mysqli_fetch_array($result)) {
        ?>
            <div class="row  gx-4 gx-lg-5 align-items-center">
                <div class="col-md-4 bg"> <img class="card-img-top mb-5 mb-md-0" src="<?php echo $mostrar['Imagen'] ?>" alt="..." /> </div>
                <div class="col-md-6">
                <div class="small mb-1 bg">Año: <?php echo $mostrar['Epoca'] ?></div>
                   
                    <h1 class="display-5 fw-bolder bg"><?php echo $mostrar['Nombre'] ?></h1>
                    
                    <div class="fs-5 mb-5 bg">
                    <div class="small mb-1">Autor: <?php echo $mostrar['Autor'] ?></div>
                        <span>Género: <?php echo $mostrar['Genero'] ?></span>
                        
                    </div>
                    <p class="lead bg"> <?php echo $mostrar['Descripcion'] ?></p>
                    <div class="d-flex ">
                        <input class="form-control text-center me-3 bg" id="inputQuantity" type="num" value="1" style="max-width: 3rem" readonly/>
                        
                       

                        <!-- Button trigger modal -->
<button type="button" class="btn btn-outline-dark flex-shrink-0 bg" data-toggle="modal" data-target="#exampleModalCenter">
<i class="bi-cart-fill me-1"></i>
  Solicitar prestamo
</button>
<style>
    body.modal-open .bg{
        filter: blur(5px);
        -webkit-filter: blur(5px);
    }
</style>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title " id="exampleModalLongTitle">Prestamo de la obra "<?php echo $mostrar['Nombre'] ?>"</h4>
      </div>
      <div class="modal-body">
      <img class="ima" src="<?php echo $mostrar['Imagen'] ?>" width="230px" height="305px"  />

   <form action="" method="POST" class="formulario">

   <?php
// Conectar a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'bibliotecav2');

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (!empty($_POST["registrop"])) {
    if (empty($_POST["foto"]) || empty($_POST["unidad"]) || empty($_POST["estudiante"]) || empty($_POST["autor"]) || empty($_POST["diap"]) || empty($_POST["diae"])) {
        echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">';
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo '<script>
        Swal.fire({
            title: "¡Préstamo no solicitado!",
            text: "Fecha no colocada",
            icon: "error",
            confirmButtonText: "OK",
            dangerMode: true,
        });
        </script>';
    } else {
        $foto = $_POST["foto"];
        $unidad = $_POST["unidad"];
        $estudiante = $_POST["estudiante"];
        $autor = $_POST["autor"];
        $diap = $_POST["diap"];
        $diae = $_POST["diae"];
        
        // Verificar si el estudiante ya ha solicitado un préstamo del mismo autor
        $check_sql = $conexion->query("SELECT * FROM prestamos WHERE Estudiante='$estudiante' AND Autor='$autor'");
        
        if ($check_sql->num_rows > 0) {
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">';
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
            Swal.fire({
                title: "¡Ya tienes este libro en Prestamos!",
                text: "Ya ha solicitado un préstamo de esta obra.",
                icon: "warning",
                confirmButtonText: "OK",
                dangerMode: true,
            });
            </script>';
        } else {
            // Insertar el registro
            $sql = $conexion->query("INSERT INTO prestamos (Obra, Unidad, Estudiante, Autor, FechaPedido, FechaEntrega) VALUES ('$foto', '$unidad', '$estudiante', '$autor', '$diap', '$diae')");
            if ($sql) {
                echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">';
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo '<script>
                Swal.fire({
                    title: "¡Préstamo Realizado!",
                    text: "Revisar mis préstamos",
                    icon: "success",
                    confirmButtonText: "OK",
                    dangerMode: true,
                });
                </script>';
            } else {
                echo 'Error en el registro: ' . mysqli_error($conexion);
            }
        }
    }
}
?>



   <style>
   .show-example-btn {
    padding: 0.9em 2.1875em;
    border: 0;
    border-radius: 0.1875em;
    background-color: black;
    box-shadow: none;
    color: #fff;
    font-size: 1.125em;
    font-weight: 500;
    white-space: nowrap;
}

/* Este es el bloque importante */
.swal2-styled {
  transition: none !important;
  box-shadow: none !important;
}
</style>
      <div class="input-field1">
          <input  type="text" value="<?php echo $mostrar['Imagen']; ?>" name="foto" required />
        </div>
      <h5> Unidad: </h5>
          <div class="input-field">
              <input type="text"  value="Unidad(1)" name="unidad" id="unidad"required readonly/>
        </div>
        <h5> Pedido de estudiante: </h5>
          <div class="input-field">
              <input type="text" value="<?php echo $apellido?> <?php echo $nombre?>"id="Nombre" name="estudiante" required readonly/>
          </div>
          <h5> Autor: </h5>
          <div class="input-field">
              <input type="text" value="<?php echo $mostrar['Autor'] ?>" id="autor"name="autor" required readonly/>
        </div>
        <h5> Día pedido:  <input type="date" id="startDate" onchange="updateDates()"> </h5>
          <div class="input-field">
              <input type="text"   id="selectedDate" readonly name="diap" required />
        </div>
        <h5> Día entrega: </h5>
          <div class="input-field">
              <input type="text" id="endDate" readonly name="diae" required />
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-danger"  onclick="fntDelPersona()" data-dismiss="modal">Cerrar</button>
        <input class="input-fieldb boton" type="submit" value="Pedir Obra" name="registrop">
        
      </div>

    </form>
    </div>
  </div>
</div>
<script>
        function updateDates() {
            const startDate = document.getElementById('startDate').value;
            if (startDate) {
                // Crear un nuevo objeto de fecha en UTC para evitar problemas de zona horaria
                const selectedDate = new Date(startDate + 'T00:00:00Z');
                const selectedDateString = formatDate(selectedDate);
                document.getElementById('selectedDate').value = selectedDateString;
                
                // Calcular la fecha 7 días después
                const endDate = new Date(selectedDate);
                endDate.setUTCDate(endDate.getUTCDate() + 7);
                
                // Formatear la fecha en DD-MM-YYYY
                const endDateString = formatDate(endDate);
                document.getElementById('endDate').value = endDateString;
            }
        }

        function formatDate(date) {
            const day = String(date.getUTCDate()).padStart(2, '0');
            const month = String(date.getUTCMonth() + 1).padStart(2, '0'); // Los meses son 0-indexados
            const year = date.getUTCFullYear();
            return `${day}-${month}-${year}`;
        }
    </script>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    </div>
</section>

<!-- Related items section-->
<section class="py-5 bg-light bg">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Próximas Obras</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <div class="col mb-5">
                <div class="card h-100">
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">1872</div>
                    <!-- Product image-->
                    <img class="card-img-top" src="assets/img/80dias.png" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Autor:</h5>
                            <!-- Product price-->
                            Julio Verne
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Próximamente..</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">1941</div>
                    <!-- Product image-->
                    <img class="card-img-top" src="assets/img/Yawar.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Autor:</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                            </div>
                            <!-- Product price-->
                          
                           José María Arguedas
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="">Próximamente...</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">1963</div>
                    <!-- Product image-->
                    <img class="card-img-top" src="assets/img/cuiperros.png" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Autor:</h5>
                            <!-- Product price-->
                            
                            Mario Vargas Llosa
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Próximamente...</a></div>
                    </div>
                </div>
            </div>
            <div class="col mb-5">
                <div class="card h-100">
                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">1637</div>
                    <!-- Product image-->
                    <img class="card-img-top" src="assets/img/elcid.jpg" alt="..." />
                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <h5 class="fw-bolder">Autor:</h5>
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                
                            </div>
                            <!-- Product price-->
                            Pierre Corneille
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Próximamente...</a></div>
                    </div>
                </div>
            </div>
        </div>
    
</section>
<style>
.input-field {
  max-width: 380px;
  width: 100%;
  background-color: #f0f0f0;
  margin: 10px 0;
  height: 40px;
  border-radius: 55px;
  display: grid;
 
  padding: 0 0.4rem;
  position: relative;
}

.input-field i {
  text-align: center;
  line-height: 55px;
  color: #acacac;
  transition: 0.5s;
  font-size: 1.1rem;
}

.input-field input {
  background: none;
  outline: none;
  border: none;
  line-height: 1;
  font-weight: 600;
  font-size: 1.1rem;
  color: #333;
}

.input-field input::placeholder {
  color: #aaa;
}
.input-field1{
    visibility:hidden;
}

.input-fieldb {
            background-color: #f0f0f0; /* Match "Pedir Obra" button */
            border: 1px solid #dcdcdc;
            color: black;
            padding: 10px 20px;
            font-size: 16px;
            margin: 4px 2px;
            border-radius: 5px;
            outline: none;
        }

        .input-field:focus {
            border-color: black; /* Optional: Change border color on focus */
        }
     
</style>
<!-- Footer-->
<footer class="py-5 bg-dark bg">
    <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2024</p></div>
</footer>


<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>


</body>
</html>
