<!-- Incluyendo la parte del código de la cabecera (principalmente menú)-->
<?php include '../cabecera.php'; ?>


<?php
//Si no está logado redirigir a index.php
if (!isset($_SESSION["email"])) {
  header("Location: index.php");
}
?>



  <h3 align="center">Mi Perfil</h3>
  <!--Titulo-->



<!-- PARTE PARA EDITAR MI DATOS-->

  <?php
  //SI HACE CLIC EN EL EDITAR
      if (isset($_POST["editar_usuario"])) {
      //Si existe el campo editar (name= formulario)
        $connection = new mysqli("localhost", "mmalia", "123456", "proyecto");
        //Conexion a la base de datos (localhost, usuario, contraseña, bd).

        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }
        //Validacion de la base de datos, en caso de error que lo muestre.


        $consulta="update usuarios set email='".$_POST["email"]."',
        nombre='".$_POST["nombre"]."',
        apellidos='".$_POST["apellidos"]."',
        dni='".$_POST["dni"]."',
        tema='".$_POST["tema"]."'
        where
        id_usuario='".$_POST["id_usuario"]."'";
        //ACTUALIZAR campos del usuario.


        if ($result = $connection->query($consulta)) {

              //Actualizar la variable SESSION con los nuevos datos, si es que los hubiera.
              $_SESSION['email'] = $_POST["email"];
              $_SESSION['nombre'] = $_POST["nombre"];
              $_SESSION['apellidos'] = $_POST["apellidos"];
              $_SESSION['dni'] = $_POST["dni"];
              $_SESSION['tema'] = $_POST["tema"];

              //Redirigir a perfil.php


        } else {
          echo "Algunos datos están incorrectos o el email ya existe en nuestra base de datos.";
        }

    }
  ?>





  <!-- formulario de la pagina perfil -->
  <h4>Mis datos</h4>

  <form action="perfil.php" method="post">

    <input type="hidden" value="<?php echo $_SESSION['id_usuario'];?>" name="id_usuario" readonly>
    <p>EMAIL: <input value="<?php echo $_SESSION['email'];?>" name="email" required></p>
    <p>NOMBRE: <input value="<?php echo $_SESSION['nombre'];?>" name="nombre" type="text" required></p>
    <p>APELLIDOS: <input value="<?php echo $_SESSION['apellidos'];?>" name="apellidos" type="text" required></p>
    <p>DNI: <input value="<?php echo $_SESSION['dni'];?>" name="dni" type="text" required></p>
    <p>TEMA: <select name="tema">
      <option value="0" <?php if($_SESSION['tema'] == 0){echo "selected";}?>>Por defecto</option>
      <option value="1" <?php if($_SESSION['tema'] == 1){echo "selected";}?>>Perfil 1</option>
      <option value="2" <?php if($_SESSION['tema'] == 2){echo "selected";}?>>Perfil 2</option>
    </select></p>

    <p><input type="submit" value="Editar mis datos" class="btn btn-primary" name="editar_usuario"></p>

  </form>
  <!--Formulario para modificar el perfil -->





<br><br>








<!-- PARTE PARA VER MIS RESERVAS -->


<h4>Mis reservas</h4>

<?php


      $connection = new mysqli("localhost", "mmalia", "123456", "proyecto");
      //Conexion a la base de datos (localhost, usuario, contraseña, bd).

      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }
      //Validacion de la base de datos, en caso de error que lo muestre.


      $consulta="select viviendas.nombre, reservas.* from viviendas, reservas
      where reservas.id_vivienda=viviendas.id_vivienda and id_usuario='".$_SESSION["id_usuario"]."'";
      //Saco el id_usuario y el id_vivienda de la vivienda que el usuario ha seleccionado.



      if ($result = $connection->query($consulta)) {


              if ($result->num_rows===0) {
              //Si el resultado es = 0 que me muestre que no hay usuarios.
                echo "Sin reservas";
              } else {
                //TABLA HTML
                //Si existen que me muestre los usuarios en una tabla.

                echo "<table class='table table-bordered'>";
                  echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>FECHA RESERVA</th>";
                    echo "<th>FECHA ENTRADA</th>";
                    echo "<th>FECHA SALIDA</th>";
                    echo "<th>CANTIDAD</th>";
                    echo "<th>ESTADO</th>";
                    echo "<th>VIVIENDA</th>";


                  echo "</tr>";

                while($obj = $result->fetch_object()) {

                  echo "<tr>";
                    echo "<td>".$obj->id_reserva."</td>";
                    echo "<td>".$obj->fecha_reserva."</td>";
                    echo "<td>".$obj->fecha_entrada."</td>";
                    echo "<td>".$obj->fecha_salida."</td>";
                    echo "<td>".$obj->dinero_reserva."</td>";
                    echo "<td>".$obj->estado."</td>";
                    echo "<td>".$obj->nombre."</td>";

                  echo "</tr>";


                };


              echo "</table>";

              echo '<p>Haz el ingreso en BBVA: <b>ES00 0000 0000 00 0000000000</b>, de la señal <b>(30%)</b> y especificar en concepto el Email</p>
              <p>Cualquier duda, póngase en contacto con el Administrador <b>Manuel Malia Crespo</b> al 606 96 49 28 </p>';

            }

      } else {
        echo "Wrong Query";

      }


?>






<!-- Incluyendo la parte del código de la parte de abajo de la página. -->
<?php include '../piepagina.php'; ?>
