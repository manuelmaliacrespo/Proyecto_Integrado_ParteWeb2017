<?php

session_start();

if($_SESSION["rol"] != "admin") {

 header ("Location: ../paginas/index.php");
}
//Si el rol "NO" es admin mandame a index.php






$connection = new mysqli($host, $usuario, $clave, $nombre);
//Conexion a la base de datos (localhost, usuario, contraseña, bd).



//Si queremos eliminar
if (isset($_GET["eliminar"])) {
  $connection->query("delete from reservas where id_reserva=".$_GET["eliminar"]."");
}


//Una vez eliminada -> Redirigir a Reservas.php
header ('Location: reservas.php');

?>
