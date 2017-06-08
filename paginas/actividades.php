<!-- Incluyendo la parte del código de la cabecera (principalmente menú)-->
<?php include '../cabecera.php'; ?>







  <div align="">
    <h3 align="center">Actividades</h3><br>
    <h4><a href="../librerias/fpdf/pdf_actividades.php">Exportar PDF</a></h4>
    <br>
    <?php


          $connection = new mysqli($host, $usuario, $clave, $nombre);
          //Conexion a la base de datos (localhost, usuario, contraseña, bd).


          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          //Validacion de la base de datos, en caso de error que lo muestre.

          $consulta="select * from extras";


          if ($result = $connection->query($consulta)) {

              if ($result->num_rows===0) {
              //Si el resultado es = 0 que me muestre que no hay actividades.
                echo "Sin extras";
              } else {
                //Pintame la tabla.



                while($obj = $result->fetch_object()) {
                  echo "<table>";
                  echo "<tr>";
                    echo "<td>";
                      echo "<img class='img-rounded' style='margin-right:20px;' src='../images/".$obj->foto."'> </img> ";
                    echo "</td>";
                    echo "<td>";
                        echo "<p><b>Actividad:</b> ".$obj->actividad."</p>";
                        echo "<p><b>Precio:</b> ".$obj->precio." €</p>";
                        echo "<p><b>Descripción:</b> ".$obj->descripcion."</p>";
                      echo "</td>";
                  echo "</tr>";
                  echo "</table><br><br>";
                  echo "<br><br>";
                  //Foto - actividad - precio- descripcion.



                };





              }
          } else {
            echo "Wrong Query";
          }


    ?>




<!-- Incluyendo la parte del código de la parte de abajo de la página. -->
<?php include '../piepagina.php'; ?>
