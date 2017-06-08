<?php include '../cabecera.php'; ?>




<?php

$connection = new mysqli($host, $usuario, $clave, $nombre);
//Conexion a la base de datos.

if ($connection->connect_errno) {
    printf("Connection failed: %s\n", $connection->connect_error);
    exit();
}
//Validación.




    if (isset($_GET["id_vivienda"])) {
    //Si existe peticion $_GET "id_vivienda" -> index.php

      $consulta='SELECT usu.nombre, usu.apellidos, va.*, vi.nombre as nombre_vivienda
      FROM valoracion va, usuarios usu, viviendas vi
      WHERE va.id_vivienda=vi.id_vivienda
      AND va.id_usuario=usu.id_usuario
      AND va.id_vivienda='.$_GET["id_vivienda"].'
      ORDER BY va.fecha desc';
      //Consulta solicitando * vivienda para extraer el id de vivienda.
      //Multitabla (usuario - vivienda - valoracion)
      //Va = valoracion

      if ($result = $connection->query($consulta)) {

          if ($result->num_rows===0) {
          //Si el resultado es = 0, sin comentarios.
          echo "No hay comentarios.<br>";
          } else {


            echo '<h3 align="center">Valoraciones</h3>';

            while($obj = $result->fetch_object()) {


                    echo ' <blockquote>
                      <p>'.$obj->comentario.' ';

                      for ($i=0; $i < $obj->puntuacion; $i++) {
                        echo '<span class="glyphicon glyphicon-star" aria-hidden="true"></span>';
                      }
                      //Estrellas, rango (min - max).

                    echo '
                      </p>
                      <footer>'.$obj->nombre.' '.$obj->apellidos.', <cite title="Source Title">'.$obj->fecha.'


                      </cite></footer>
                    </blockquote>';


            }


          }
      } else {
        echo "Wrong Query";
      }

  }
?>


<br>



<?php

    if (isset($_POST["comentar_vivienda"])) {
    //Si existe petición $_POST comentar_vivienda (name = formulario)

      $connection = new mysqli($host, $usuario, $clave, $nombre);
      //Conexion base de datos

      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }
      //Validación

      $consulta="INSERT INTO valoracion (puntuacion, comentario, fecha, id_vivienda, id_usuario)
      VALUES ('".$_POST["puntuacion"]."','".$_POST["comentario"]."', now(),'".$_POST["id_vivienda"]."','".$_SESSION["id_usuario"]."')";
      //Consulta para insertar "comentario".

      if ($result = $connection->query($consulta)) {

        header("Location: ver_comentarios.php?id_vivienda=".$_POST["id_vivienda"]."");
        //Redirigir a Ver_comentarios.php pasando el id_vivienda.

      } else {
        echo "Wrong Query";
        //Fallo en la query.
      }

  }
?>

<!-- FORMULARIO DE COMENTAR -->
<?php
/* SI ESTA (LOGADO) MOSTRAR EL FORMULARIO SI NO NADA.*/
if (isset($_SESSION["email"])) {
echo '<form method="post" action="ver_comentarios.php">
      <input type="hidden" name="id_vivienda" value="'.$_GET["id_vivienda"].'"></input>
      <p><b>Puntuación:</b> <input style="width:200px;" name="puntuacion" type="range" min="1" max="5"></input></p>
      <p><b>Comentario:</b> <textarea style="width:200px;" class="form-control" rows="2" name="comentario"></textarea></p>
      <p><input type="submit" value="Comentar" class="btn btn-primary" name="comentar_vivienda"></p>

</form>';
}
?>






<!-- Incluyendo la parte del código de la parte de abajo de la página. -->
<?php include '../piepagina.php'; ?>
