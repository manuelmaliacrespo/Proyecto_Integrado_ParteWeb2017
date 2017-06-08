
<!-- Incluyendo la parte del código de la cabecera (principalmente menú)-->
<?php include '../cabecera.php'; ?>


<?php

if($_SESSION["rol"] != "admin") {
  header ("Location: ../paginas/index.php");
}




?>


  <div align="">
    <h3 align="center">Usuarios</h3>
    <p><a href="../paginas/registro.php">Para añadir un nuevo usuario ir al registro</a></p>

    <?php


          $connection = new mysqli($host, $usuario, $clave, $nombre);
          //Conexion a la base de datos (localhost, usuario, contraseña, bd).


          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          //Validacion de la base de datos, en caso de error que lo muestre.

          $consulta="select * from usuarios";


          if ($result = $connection->query($consulta)) {

              if ($result->num_rows===0) {
              //Si el resultado es = 0 que me muestre que no hay usuarios.
                echo "Sin usuarios";
              } else {
                //TABLA HTML
                //Si existen que me muestre los usuarios en una tabla.

                echo "<table class='table table-bordered'>";
                  echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>EMAIL</th>";
                    echo "<th>NOMBRE</th>";
                    echo "<th>APELLIDOS</th>";
                    echo "<th>DNI</th>";
                    echo "<th>ROL</th>";
                    echo "<th></th>";
                    echo "<th></th>";
                  echo "</tr>";

                while($obj = $result->fetch_object()) {

                  echo "<tr>";
                    echo "<td>".$obj->id_usuario."</td>";
                    echo "<td>".$obj->email."</td>";
                    echo "<td>".$obj->nombre."</td>";
                    echo "<td>".$obj->apellidos."</td>";
                    echo "<td>".$obj->dni."</td>";
                    echo "<td>".$obj->rol."</td>";
                    echo "<td><a href='usuarios_editar.php?editar=$obj->id_usuario'>Editar</a></td>";
                    //id_usuario -> Editar
                    echo "<td><a href='usuarios_eliminar.php?eliminar=$obj->id_usuario'>Eliminar</a></td>";
                    //id_usuario -> Eliminar
                  echo "</tr>";


                };


              echo "</table>";


              }
          } else {
            echo "Wrong Query";
          }


    ?>






</div>

<!-- Incluyendo la parte del código de la parte de abajo de la página. -->
<?php include '../piepagina.php'; ?>
