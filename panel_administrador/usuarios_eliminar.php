<?php

session_start();

if($_SESSION["rol"] != "admin") {

 header ("Location: ../paginas/index.php");
}
//Si el rol "NO" es admin redirigir a index.php






$connection = new mysqli($host, $usuario, $clave, $nombre);
//Conexion a la base de datos (localhost, usuario, contraseña, bd).



//Si queremos eliminar
if (isset($_GET["eliminar"])) {
  $connection->query("delete from usuarios where id_usuario=".$_GET["eliminar"]."");
  //Borrar usuario ( id_usuario )
}


 //Si se ha eliminado -> Redirigir a usuarios.php
 header ('Location: usuarios.php');

?>
