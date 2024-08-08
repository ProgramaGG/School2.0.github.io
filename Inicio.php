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
        <title>Inicio - biblioteca</title>
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

    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
<df-messenger
  chat-icon="https:&#x2F;&#x2F;i.imgur.com&#x2F;jplQlPm.png"
  intent="WELCOME"
  chat-title="📚 Bibliotecary Mercedary"
  agent-id="4818c96a-3122-4e2f-a076-38148e2d622b"
  language-code="es"
></df-messenger>

<style>
  df-messenger {
   
   --df-messenger-bot-message:#f2e8e1;
   --df-messenger-button-titlebar-color: #EB4F44;
   --df-messenger-chat-background-color: #fafafa;
   --df-messenger-font-color: black;
   --df-messenger-send-icon: #878fac;
   --df-messenger-user-message:#E87571;
  }
</style>
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
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#">Libros</a></li>
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
                    
                <span class="d-none d-lg-block"><img class="img-fluid img-profile  mx-auto mb-2" src="assets/img/libro.png" width="150px" height="150px" " /></span>
                    <h1 class="libro display-4 fw-bolder">Bibliotecary Mercedary</h1>
                    <p class="libro2 lead fw-normal -50 mb-0">Sabiduría en páginas</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <?php
// Conectar a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'bibliotecav2');

// Verificar si la conexión fue exitosa
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if (!empty($_POST["registroI"])) {
    if (empty($_POST["estudiante"]) || empty($_POST["nobra"]) || empty($_POST["autor"]) || empty($_POST["año"]) || empty($_POST["obra"])) {
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
        $estudiante = $_POST["estudiante"];
        $nobra = $_POST["nobra"];
        $autor = $_POST["autor"];
        $año = $_POST["año"];
        $obra = $_POST["obra"];
        
        // Verificar si el registro ya existe
        $check_sql = $conexion->query("SELECT * FROM intereses WHERE Estudiante2='$estudiante' AND Nobra='$nobra' AND Autor2='$autor' AND Año2='$año' AND Obra2='$obra'");
        
        if ($check_sql->num_rows > 0) {
            echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">';
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
            Swal.fire({
                title: "¡Ya está en tus Intereses!",
                text: "Este libro ya está registrado.",
                icon: "warning",
                confirmButtonText: "OK",
                dangerMode: true,
            });
            </script>';
        } else {
            // Insertar el registro
            $sql = $conexion->query("INSERT INTO intereses (Estudiante2, Nobra, Autor2, Año2, Obra2) VALUES ('$estudiante', '$nobra', '$autor', '$año', '$obra')");
            if ($sql) {
                echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">';
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo '<script>
                Swal.fire({
                    title: "¡Agregado a mis Intereses!",
                    text: "El libro ' . $nobra . ' ha sido agregado a tus intereses.",
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
    .inbtn{
        left: 6%;
        bottom: 4%;
        position:absolute;
        background-color: #EB4F44;
        padding: 1px 15px;
        border: 0;
        border-radius: 25px;
        color: white;
        font-size: 30px;
    }
    .inbtn:hover{
        background-color: #212529;
    }
    
    @media (max-width: 1366px) {
        .inbtn{
            left: 40%;
            bottom: 18.5%;
            padding: 1px 15px;
            font-size: 20px;
        }
        
    }
   </style>
        <section class="py-5">
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                             <!-- Sale badge-->
                             <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Año: 1472</div>
                            <!-- Product Interes-->
                            <img class="card-img-top" src="assets/img/divina comedia.png" alt="" />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="La Divina Comedia" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="Dante Alighieri" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="1472" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/divina comedia.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                     <br/><br>
                                    <h5 class="fw-bolder">Autor:</h5>
                                    <!-- Product price-->
                                    Dante Alighieri
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=Divina&enviar=Buscar">Detalles de la obra</a></div>
                                <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                            
                        </div>
                        
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Edición: 2007</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/la odisea.png" alt="" />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="La ODISEA" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="Homero" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="Edición: 2007" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/la odisea.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <br/><br>
                                    <h5 class="fw-bolder">Autor:</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through"></span>
                                    Homero
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=ODISEA&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Año: 1890</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/Dorian.png" alt="" />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="El retrato de Dorian Gray" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="Oscar Wilde" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="1890" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/Dorian.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Autor:</h5>
                                    <!-- Product price-->
                                    <span class="text-muted text-decoration-line-through"></span>
                                    Oscar Wilde
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=retrato&enviar=Buscar">Detalles de la obra</a></div>
                              <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5 ">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Año: 1843</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/ElGATO.png" alt="" />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="El Gato Negro" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="Edgar Allan Poe" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="1843" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/ElGATO.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Autor:</h5>
                                    <!-- Product price-->
                                    Edgar Allan Poe
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=gato&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Año: 1913</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/carmelo.png" alt="..." />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="El caballero Carmelo" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="Abraham Valdelomar" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="1913" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/carmelo.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <br/><br>
                                    <h5 class="fw-bolder">Autor:</h5>
                                    <!-- Product price-->
                                    Abraham Valdelomar
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=caballero&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Año: 1605</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/don.png" alt="..." />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="Don Quijote de La Mancha" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="Miguel de Cervantes" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="1605" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/don.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Autor:</h5>
                                    <!-- Product price-->
                                    Miguel de Cervantes
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=quijote&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Edición: 1945</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/lasmil.png" alt="..." />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="Las mil y una noches" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="Abu abd-Allah" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="Edición 1945" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/lasmil.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <br/><br>
                                    <h5 class="fw-bolder">Autor:</h5>
                                    <!-- Product price-->
                                    Abu abd-Allah
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=noches&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Año: 1597</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/Romeo.png" alt="..." />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="Romeo y Julieta" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="William Shakespeare" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="1597" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/Romeo.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Autor</h5>
                                    <!-- Product price-->
                                    William Shakespeare
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=romeo&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Año: 1968</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/planta.png" alt="..." />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="Mi planta de naranja lima" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="José Mauro de Vasconcelos" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="1968" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/planta.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Autor</h5>
                                   
                                    <!-- Product price-->
                                    José Mauro de Vasconcelos
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto"href="Libros.php?busqueda=planta&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Año: 1906</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/colmillo.png" alt="..." />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="Colmillo Blanco" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="Jack London" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="1906" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/colmillo.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Autor</h5>
                                    <!-- Product price-->
                                    Jack London
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto"href="Libros.php?busqueda=colmillo&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Año: 1958</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/RIOS.png" alt="..." />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="Los ríos profundos" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="José María Arguedas" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="1958" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/RIOS.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Autor</h5>
                                    <!-- Product price-->
                                    José María Arguedas
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=rios&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Año: 1967</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/años.png" alt="..." />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="Cien años de soledad" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="Gabriel García Márquez" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="1967" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/años.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Autor</h5>
                                    <!-- Product price-->
                                    Gabriel García Márquez
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=años&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Año: 1915</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/meta.png" alt="..." />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="La metamorfosis" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="Franz Kafka" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="1915" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/meta.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Autor</h5>
                                    <!-- Product price-->
                                    Franz Kafka
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=meta&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/libelula.png" alt="..." />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="El informe libélula" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="Alicia B. Torres, Alfonso F. Quero" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="2024" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/libelula.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">Autor</h5>
                                    <!-- Product price-->
                                    Alicia B. Torres, Alfonso F. Quero
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=libelula&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                    <form action="" method="POST" class="formulario">
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Sale badge-->
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                            <!-- Product image-->
                            <img class="card-img-top" src="assets/img/cuervo.png" alt="..." />
                            <input type="text"style="display: none;" value="<?php echo $apellido?> <?php echo $nombre?>" name="estudiante" required readonly/>
                            <input type="text"style="display: none;" value="El cuervo" name="nobra" required readonly/>
                            <input type="text"style="display: none;" value="Edgar Allan Poe" name="autor" required readonly/>
                            <input type="text"style="display: none;" value="1845" name="año" required readonly/>
                            <input type="text"style="display: none;" value="assets/img/cuervo.png" name="obra" required readonly/>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <br/><br>
                                    <h5 class="fw-bolder">Autor</h5>
                                    
                                    <!-- Product price-->
                                    Edgar Allan Poe
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ ‎ <a class="btn btn-outline-dark mt-auto" href="Libros.php?busqueda=cuervo&enviar=Buscar">Detalles de la obra</a></div>
                            <input class="inbtn" type="submit" value="♡" name="registroI">
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2024</p></div>
        </footer>
       

        <!-- Bootstrap core JS-->
         
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
