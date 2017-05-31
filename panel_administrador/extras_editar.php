<!-- Incluyendo la parte del código de la cabecera (principalmente menú)-->
<?php include '../cabecera.php'; ?>


<?php

if($_SESSION["rol"] != "admin") {
  header ("Location: ../paginas/index.php");
}
//Si el rol "NO" es admin mandame a index.php
?>





<h3 align="center">Editar Extras</h3>

<?php
//SI HACE CLIC EN EL EDITAR
    if (isset($_POST["editar_extras"])) {
    //Si existe el campo editar_extras...
      $connection = new mysqli("localhost", "mmalia", "123456", "proyecto");
      //Conexion a la base de datos (localhost, usuario, contraseña, bd).

      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }
      //Validacion de la base de datos, en caso de error que lo muestre.

      $consulta="update extras set actividad='".$_POST["actividad"]."',
       foto='".$_POST["foto"]."',
       descripcion='".$_POST["descripcion"]."',
       precio='".$_POST["precio"]."'
       WHERE id_extras='".$_POST["id_extras"]."'";
      //Actualizar datos con los campos de la tabla extras (id_extras, actividad, precio).

      if ($result = $connection->query($consulta)) {

            //Si el resultado OK consulta, redirigirme a EXTRAS.PHP
            header ("Location: extras.php");

      } else {
        echo "Wrong Query";
      }

  }
?>







<?php
//VENGO DE EXTRAS.PHP (Nos trae por GET el id_extras que queremos editar) RELLENAMOS EL FORMULARIO CON LOS DATOS DEL USUARIO.
if (isset($_GET["editar"])) {

  $connection = new mysqli("localhost", "mmalia", "123456", "proyecto");
  //Conexion a la base de datos (localhost, usuario, contraseña, bd).

  $consulta = "select * from extras where id_extras=".$_GET["editar"]."";
  //Sacar todo de extras donde el id_extras = editar.


  if ($result = $connection->query($consulta)) {

      if ($result->num_rows===0) {
      //Si el resultado es = 0 mostar "No existe el extra".

        echo "No existe el extra";
      } else {

        //Si existe...
        $obj = $result->fetch_object();

        echo '<form action="extras_editar.php" method="post">

          <input type="hidden" value="'.$obj->id_extras.'" name="id_extras" readonly>
          <p>ACTIVIDAD: <input value="'.$obj->actividad.'" name="actividad" required></p>
          <p>FOTO: <input value="'.$obj->foto.'" name="foto"></p>
          <p>PRECIO: <input value="'.$obj->precio.'" name="precio"></p>
          <p>DESCRIPCION: <textarea name="descripcion">'.$obj->descripcion.'</textarea></p>


          <p><input type="submit" value="Editar" class="btn btn-primary" name="editar_extras"></p>

        </form>';

      }
  } else {
    echo "Wrong Query";
  }

}

?>


<!-- Incluyendo la parte del código de la parte de abajo de la página. -->
<?php include '../piepagina.php'; ?>
