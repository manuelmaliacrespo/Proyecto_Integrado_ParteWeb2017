<?php

session_start();

if($_SESSION["rol"] != "admin") {

 header ("Location: ../paginas/index.php");
}
//Si el rol "NO" es admin mandame a index.php






$connection = new mysqli($host, $usuario, $clave, $nombre);
//Conexion a la base de datos (localhost, usuario, contraseña, bd).



//Si queremos eliminar un extra.
if (isset($_GET["eliminar"])) {
  $connection->query("delete from extras where id_extras=".$_GET["eliminar"]."");
}


//Redireccion a index.php
header ('Location: extras.php');

?>
