<?php
session_start();


session_destroy();
header("Location: login.php");
//Cuando se cierre la sesion redirigirme a login.php

?>
