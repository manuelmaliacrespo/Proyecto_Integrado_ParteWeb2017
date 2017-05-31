<!-- Incluyendo la parte del código de la cabecera (principalmente menú)-->
<?php include '../cabecera.php'; ?>




<?php

$connection = new mysqli("localhost", "mmalia", "123456", "proyecto");
//Conexion a la base de datos.

if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}
//Validación.




    if (isset($_GET["id_vivienda"])) {
    //Si existe peticion $_GET "id_vivienda" -> index.php

      $consulta="select * from viviendas where id_vivienda = ".$_GET["id_vivienda"];
      //Consulta solicitando * vivienda segun su id_vivienda.

      if ($result = $connection->query($consulta)) {

          if ($result->num_rows===0) {
          //Si el resultado es = 0
          //Aparece la vivienda si o si ya que le paso la id.

          } else {

            //Muestrame la vivienda
            echo "<h4>Información</h4>";
            //Recupero el resultado de la consulta.
            $obj = $result->fetch_object();

            echo "<div>";
              echo "<align='center'>";
              echo "<img class='img-thumbnail' style='width:400px;' src='../images/viviendas/".$obj->foto1."'></img><br><br>";
              echo " <img class='img-thumbnail' style='width:200px;' src='../images/viviendas/".$obj->foto2."'></img>";
              echo " <img class='img-thumbnail' style='width:200px;' src='../images/viviendas/".$obj->foto3."'></img>";
              echo " <img class='img-thumbnail' style='width:200px;' src='../images/viviendas/".$obj->foto4."'></img>";
              echo " <img class='img-thumbnail' style='width:200px;' src='../images/viviendas/".$obj->foto5."'></img><br>";
              echo "<br><b>Nombre:</b> ".$obj->nombre;
              echo "<br><b>Ubicación:</b> ".$obj->localizacion;
              echo "<br><b>Descripcion:</b> ".$obj->descripcion;
              echo "<br><b>Temp. Baja:</b> ".$obj->precio_baja;
              echo "<br><b>Temp. Media:</b> ".$obj->precio_media;
              echo "<br><b>Temp. Alta:</b> ".$obj->precio_alta;
              //Mostar los datos (informacion) de la vivienda seleccionada junto a las fotos.
            echo "</div>";


            echo "<br>";

            //Recuperamos el mes actual.
            $mes_actual = date("n");
            //Creo $mes_actual "n" muestra el mes (1-12)

            //Si el mes actual es desde Julio a Septiembre: Guardar en variable el precio de alta.
            if($mes_actual >= 7 && $mes_actual <= 9) {
              $precio_cobrar = $obj->precio_alta;

            //Si el mes actual es Abril o Mayo: Guardar en variable el precio de media.
            } elseif ($mes_actual == 6 || $mes_actual == 7) {
              $precio_cobrar = $obj->precio_media;

            //Si no es ninguno de los anteriores: Guardar en variable el precio de baja.
            } else {
              $precio_cobrar = $obj->precio_baja;
            }



            //Formulario para reservar la vivienda.
            echo '<h4>Hacer Reserva</h4>';
            echo '<form action="reservar_vivienda.php" method="post">';
            //La accion se realiza en reservar_vivienda.php

              echo '<input type="hidden" name="id_vivienda" value="'.$obj->id_vivienda.'">';
              //No quiero que se muestre el id_vivienda.
              echo '<p>Fecha Entrada: <input type="date" name="fecha_entrada" required></p>';
              echo '<p>Fecha Salida: <input type="date" name="fecha_salida" required></p>';
              echo '<p>Precio/día: <input type="text" value="'.$precio_cobrar.'" name="dinero_reserva" readonly></p>';


              //Si está logado (Existe email en la variable SESSION) que muestre el botón. Sino que muestre el mensaje de más abajo.
              if (isset($_SESSION["email"])) {
                echo '<p><input type="submit" value="Reservar" class="btn btn-primary" name="reservar_vivienda"></p>';
              } else {
                echo '<i><b>Debe estar registrado para poder reservar la vivienda.</b></i>';
                //En caso de no estar logado se muestra este mensaje.
              }

            echo '</form>';

          }
      } else {
        echo "Wrong Query";
      }

  }
?>



<br>




<!-- Incluyendo la parte del código de la parte de abajo de la página. -->
<?php include '../piepagina.php'; ?>
