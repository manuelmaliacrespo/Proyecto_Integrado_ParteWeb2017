<?php include '../cabecera.php'; ?>


<?php

if($_SESSION["rol"] != "admin") {
  header ("Location: ../paginas/index.php");
}
//Si el rol "NO" es admin mandame a index.php
?>






<h3 align="center">Insertar Extras</h3>



<?php
//SI HACE CLIC EN EL INSERTAR
    if (isset($_POST["insertar_extras"])) {
    //Si existe el campo insertar_extras...
      $connection = new mysqli("localhost", "mmalia", "123456", "proyecto");
      //Conexion a la base de datos (localhost, usuario, contraseña, bd).

      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }
      //Validacion de la base de datos, en caso de error que lo muestre.

      $consulta="insert into extras (actividad, precio, foto, descripcion)
      VALUES ('".$_POST["actividad"]."', '".$_POST["precio"]."', '".$_POST["foto"]."',
      '".$_POST["descripcion"]."')";
      //Insertar en extras ( actividad , precio, foto, descripcion ).


      if ($result = $connection->query($consulta)) {

            //Consulta fallida -> Redireccionarme a "extras.php".
            header ("Location: extras.php");

      } else {
        echo "Wrong Query";
        echo $consulta;
      }

  }
?>




<?php

  /*  echo "<pre>";
    echo var_dump($_POST);
    echo "</pre>";*/


?>


<form action="extras_insertar.php" method="post">

          <p>ACTIVIDAD: <input type="text" value="" name="actividad" required=""></p>
          <p>PRECIO: <input type="text" value="" name="precio"></p>
          <p>FOTO: <input type="text" value="" name="foto"></p>
          <p>DESCRIPCION: <textarea name="descripcion"></textarea></p>
          <!--Campos para insertar ( actividad, precio ). -->

<p><input type="submit" value="Insertar nuevo" class="btn btn-primary" name="insertar_extras"></p>

</form>










<!-- Incluyendo la parte del código de la parte de abajo de la página. -->
<?php include '../piepagina.php'; ?>
