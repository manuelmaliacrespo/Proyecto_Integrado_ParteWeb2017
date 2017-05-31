<!-- Incluyendo la parte del código de la cabecera (principalmente menú)-->
<?php include '../cabecera.php'; ?>




<div align="">
<h4 align="">Registro</h4><br>
<!--Titulo-->

<?php

    if (isset($_POST["registro"])) {
    //Si existe el campo registro (name= formulario).
      $connection = new mysqli("localhost", "mmalia", "123456", "proyecto");
      //Conexion a la base de datos (localhost, usuario, contraseña, bd).

      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }
      //Validacion de la base de datos, en caso de error que lo muestre.

      $consulta="insert into usuarios (email, clave, nombre, apellidos, dni, rol)
      values ('".$_POST["email"]."', md5('".$_POST["clave"]."'), '".$_POST["nombre"]."', '".$_POST["apellidos"]."', '".$_POST["dni"]."', 'usuario')";
      //USUARIO (rol o admin).

      //echo $consulta;

      if ($result = $connection->query($consulta)) {

            //Resultado OK, que me redirección a "index.php"
            header ("Location: index.php");

      } else {
        echo "Wrong Query";
        //Error consulta.
      }

  }
?>

<!--Formulario con los datos que solicito.-->
<form action="registro.php" method="post">

  <p>EMAIL: <input name="email" required></p>
  <p>CONTRASEÑA: <input name="clave" type="password" required></p>
  <p>NOMBRE: <input name="nombre" type="text" required></p>
  <p>APELLIDOS: <input name="apellidos" type="text" required></p>
  <p>DNI: <input name="dni" type="text" required></p>


  <p><input type="submit" value="Registrar" class="btn btn-primary" name="registro"></p>

</form>


</div>





<!-- Incluyendo la parte del código de la parte de abajo de la página. -->
<?php include '../piepagina.php'; ?>
