<!-- Incluyendo la parte del código de la cabecera (principalmente menú)-->
<?php include '../cabecera.php'; ?>


<?php

if($_SESSION["rol"] != "admin") {
  header ("Location: ../paginas/index.php");
}




?>


  <div align="">
    <h3 align="center">Reservas</h3>



    <?php


          $connection = new mysqli("localhost", "mmalia", "123456", "proyecto");
          //Conexion a la base de datos (localhost, usuario, contraseña, bd).


          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          //Validacion de la base de datos, en caso de error que lo muestre.

          $consulta= "SELECT usuarios.email, viviendas.nombre AS nombre_vivienda, reservas.* FROM usuarios, reservas, viviendas
                      WHERE usuarios.id_usuario=reservas.id_usuario
                      AND reservas.id_vivienda=viviendas.id_vivienda";

          if ($result = $connection->query($consulta)) {

              if ($result->num_rows===0) {
              //Si el resultado es = 0 que me muestre "No hay usuarios".
                echo "Sin Reservas";
              } else {
                //TABLA HTML
                //Si existen que me muestre los usuarios en una tabla con los datos de ( usuario, reserva, vivienda ).

                echo "<table class='table table-bordered'>";
                  echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>ESTADO</th>";
                    echo "<th>CLIENTE</th>";
                    echo "<th>CASA</th>";
                    echo "<th>F. RESERVA</th>";
                    echo "<th>ENTRADA</th>";
                    echo "<th>SALIDA</th>";
                    echo "<th>CANTIDAD</th>";
                  echo "</tr>";

                while($obj = $result->fetch_object()) {

                  echo "<tr>";
                    echo "<td>".$obj->id_reserva."</td>";
                    echo "<td>".$obj->estado."</td>";
                    echo "<td>".$obj->email."</td>";
                    echo "<td>".$obj->nombre_vivienda."</td>";
                    echo "<td>".$obj->fecha_reserva."</td>";
                    echo "<td>".$obj->fecha_entrada."</td>";
                    echo "<td>".$obj->fecha_salida."</td>";
                    echo "<td>".$obj->dinero_reserva."</td>";
                    echo "<td><a href='reservas_editar.php?editar=$obj->id_reserva'>Editar</a></td>";
                    echo "<td><a href='reservas_eliminar.php?eliminar=$obj->id_reserva'>Eliminar</a></td>";
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
