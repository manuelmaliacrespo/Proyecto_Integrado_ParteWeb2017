<?php
  session_start();
  

  require('configuracion.php');


?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title>Escápate al Sur</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="../css/navbar.css" rel="stylesheet">
    <script src="../js/ie-emulation-modes-warning.js"></script>



    <style type="text/css">
      /* TEMA 1 */
      <?php if (isset($_SESSION["tema"]) && $_SESSION["tema"]== 1):?>
        body {
          /*background-color: white;*/
          color:green;
          font-family: courier;
        }
        .navbar-default {
          border:1px solid green;
        }

      <?php endif;?>

      /* TEMA 2 */
      <?php if (isset($_SESSION["tema"]) && $_SESSION["tema"]== 2):?>
        body {
          background-color: black;
          color:white;
          font-family: times;
        }
        .navbar-default {
          border:2px solid gray;
        }
        input {
          color:black;
        }
        select {
          color:black;
        }
      <?php endif;?>

      /* TEMA 3 */
      <?php if (isset($_SESSION["tema"]) && $_SESSION["tema"]== 3):?>

        .container {
          width: 90%;
        }

      <?php endif;?>

    </style>

  </head>

  <body>

    <div class="container">

      <!--Logo "Trafalgar eres tu"-->
      <a href="../paginas/index.php"><img style="width:350px;" src="../images/logo.png"></img></a><br><br>

      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">


            <!--Nombre de la web.-->
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
              <li><a href="../paginas/index.php">Inicio</a></li>
              <li><a href="../paginas/actividades.php">Actividades</a></li>

              <?php
                //Si el rol es admin, muestrame el boton Panel de Control (--).
                if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin") {
                  echo '<li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Panel Administración <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="../panel_administrador/usuarios.php">Usuarios</a></li>
                      <li><a href="../panel_administrador/viviendas.php">Viviendas</a></li>
                      <li><a href="../panel_administrador/extras.php">Extras</a></li>
                      <li><a href="../panel_administrador/reservas.php">Reservas</a></li>
                    </ul>
                  </li>';
                }
              ?>

            </ul>
            <ul class="nav navbar-nav navbar-right">


            <?php
            //Si existe email, lo mostramos y añadimos boton para deslogarse.
            //En caso contrario añadimos el boton login y registro.
            if (isset($_SESSION["email"])) {
              echo '<li><a href="../paginas/perfil.php"><u>'.$_SESSION["email"].'</u></a></li>';
              echo '<li><a href="../paginas/logout.php">Salir</a></li>';
            } else {
              echo '<li><a href="login.php">Entrar</a></li>';
              echo '<li><a href="registro.php">Registrarme</a></li>';
            }

            ?>



            </ul>
          </div>
        </div>
      </nav>
