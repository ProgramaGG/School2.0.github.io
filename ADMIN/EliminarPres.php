<?php
// Conectar a la base de datos
$conexion = mysqli_connect('localhost', 'root', '', 'bibliotecav2');

$id=$_GET['id'];
$eliminar="DELETE FROM prestamos WHERE Idprestamo='$id'";

$resultado=mysqli_query($conexion,$eliminar);

if($resultado){
    
 header("location:PrestamosA.php");
}
?>
