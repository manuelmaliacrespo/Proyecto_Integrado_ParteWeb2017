<!-- Incluyendo la parte del código de la cabecera (principalmente menú)-->
<?php include '../cabecera.php'; ?>

<?php

  if($_SESSION["rol"] != "admin") {
    header ("Location: ../paginas/index.php");
  }
  //Si el rol "NO" es admin mandame a index.php
?>

  <div align="">
    <h3 align="center">Viviendas</h3>
    <p><a href="viviendas_insertar.php">Añadir nueva vivienda</a></p>
    <?php

          //CREATING THE CONNECTION
          $connection = new mysqli("localhost", "mmalia", "123456", "proyecto");
          //Conexion a la base de datos (localhost, usuario, contraseña, bd).

          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          //Validacion de la base de datos, en caso de error que lo muestre.

          $consulta="select * from viviendas";

          if ($result = $connection->query($consulta)) {

              if ($result->num_rows===0) {
              //Si el resultado es = 0 que me muestre que no hay viviendas.
                echo "Sin viviendas";
              } else {

                //TABLA HTML
                echo "<table class='table table-bordered'>";
                  echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>NOMBRE</th>";
                    echo "<th>LOCALIZACIÓN</th>";
                    echo "<th>DORMITORIOS</th>";
                    echo "<th>PERSONAS</th>";
                    echo "<th>MASCOTAS</th>";
                    echo "<th>TEMP. BAJA</th>";
                    echo "<th>TEMP. MEDIA</th>";
                    echo "<th>TEMP. ALTA</th>";

                  echo "</tr>";

                while($obj = $result->fetch_object()) {

                  echo "<tr>";
                    echo "<td>".$obj->id_vivienda."</td>";
                    echo "<td>".$obj->nombre."</td>";
                    echo "<td>".$obj->localizacion."</td>";
                    echo "<td>".$obj->dormitorios."</td>";
                    echo "<td>".$obj->personas."</td>";
                    echo "<td>".$obj->mascotas."</td>";
                    echo "<td>".$obj->precio_baja."</td>";
                    echo "<td>".$obj->precio_media."</td>";
                    echo "<td>".$obj->precio_alta."</td>";



                    echo "<td><a href='viviendas_editar.php?editar=$obj->id_vivienda'>Editar</a></td>";
                    echo "<td><a href='viviendas_eliminar.php?eliminar=$obj->id_vivienda'>Eliminar</a></td>";
                  echo "</tr>";
              //Si hay datos pues que me los muestre en una tabla.


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
