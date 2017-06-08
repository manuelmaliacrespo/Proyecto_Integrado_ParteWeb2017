<!-- Incluyendo la parte del código de la cabecera (principalmente menú)-->
<?php include '../cabecera.php'; ?>


<?php

if($_SESSION["rol"] != "admin") {
  header ("Location: ../paginas/index.php");
}
//Si el rol "NO" es admin mandame a index.php
?>




<h3 align="center">Editar Reservas</h3>


<?php
//SI HACE CLIC EN EL EDITAR
    if (isset($_POST["editar_reservas"])) {
    //Si existe el campo reserva...
      $connection = new mysqli($host, $usuario, $clave, $nombre);
      //Conexion a la base de datos (localhost, usuario, contraseña, bd).

      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }
      //Validacion de la base de datos, en caso de error que lo muestre.

      $consulta="update reservas set estado='".$_POST["estado"]."',
       fecha_reserva='".$_POST["fecha_reserva"]."',
       fecha_entrada='".$_POST["fecha_entrada"]."',
       fecha_salida='".$_POST["fecha_salida"]."',
       estado='".$_POST["estado"]."',
       dinero_reserva='".$_POST["dinero_reserva"]."'
       WHERE id_reserva='".$_POST["id_reserva"]."'";



      if ($result = $connection->query($consulta)) {

            //VALID LOGIN. SETTING SESSION VARS
            header ("Location: reservas.php");

      } else {
        echo "Wrong Query";
        echo $consulta;
      }

  }
?>







<?php
//1º VIENE DE RESERVAS.PHP RELLENAMOS EL FORMULARIO CON LOS DATOS DEL USUARIO.
if (isset($_GET["editar"])) {

  $connection = new mysqli($host, $usuario, $clave, $nombre);
  //Conexion a la base de datos (localhost, usuario, contraseña, bd).

  $consulta = "select * from reservas where id_reserva=".$_GET["editar"]."";


  if ($result = $connection->query($consulta)) {

      if ($result->num_rows===0) {
      //Si el resultado de la consulta = 0, mostrar "No existe la reserva".

        echo "No existe la reserva";
      } else {

        //Si existe rellenar los datos en el formulario.
        //$_POST necesito todos los values y necesito id para usarla en la consulta.
        //No quiero que se use por eso el HIDDEN.
        $obj = $result->fetch_object();

        echo '<form action="reservas_editar.php" method="post">

          <input type="hidden" value="'.$obj->id_reserva.'" name="id_reserva" readonly>
          ESTADO: <input type="text" value="'.$obj->estado.'" name="estado"><br><br>
          FECHA RESERVA: <input type="text" value="'.$obj->fecha_reserva.'" name="fecha_reserva"><br><br>
          FECHA ENTRADA: <input type="text" value="'.$obj->fecha_entrada.'" name="fecha_entrada"><br><br>
          FECHA SALIDA: <input type="text" value="'.$obj->fecha_salida.'" name="fecha_salida"><br><br>
          CANTIDAD: <input type="text" value="'.$obj->dinero_reserva.'" name="dinero_reserva"><br><br>


          <p><input type="submit" value="Editar" class="btn btn-primary" name="editar_reservas"></p>
        </form>';

      }
  } else {
    echo "Wrong Query";
  }

}

?>


<!-- Incluyendo la parte del código de la parte de abajo de la página. -->
<?php include '../piepagina.php'; ?>
