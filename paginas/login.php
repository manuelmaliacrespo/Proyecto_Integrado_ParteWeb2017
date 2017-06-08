

  <!-- Incluyendo la parte del código de la cabecera (principalmente menú)-->
  <?php include '../cabecera.php'; ?>


  <div align="left">
    <h4 align="">Inserte sus datos</h4>
    <?php

        //FORM SUBMITTED
        //Si esxiste el login (name= formulario) por $ POST conectarse a la base de datos.
        if (isset($_POST["login"])) {
          //CREATING THE CONNECTION
          $connection = new mysqli($host, $usuario, $clave, $nombre);
          //Conexion a la base de datos (localhost, usuario, contraseña, bd).

          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          //Validacion de la base de datos, en caso de error que lo muestre.

          $consulta="select * from usuarios where
          email='".$_POST["email"]."' and clave=md5('".$_POST["clave"]."');";
          //Email y clave encriptada, datos que paso para el Login.


          if ($result = $connection->query($consulta)) {

              if ($result->num_rows===0) {
              //Si el resultado de la consulta = 0 mostrarme "LOGIN INVALIDO".
                echo "LOGIN INVALIDO";
              } else {


                //Recuperamos el resultado de la consulta.
                $obj = $result->fetch_object();

                //Incluimos cada campo en session.
                //Incluimos en la $SESSION cada uno de los resultados del formulario.
                $_SESSION["id_usuario"] = $obj->id_usuario;
                $_SESSION["email"] = $obj->email;
                $_SESSION["nombre"] = $obj->nombre;
                $_SESSION["apellidos"] = $obj->apellidos;
                $_SESSION["dni"] = $obj->dni;
                $_SESSION["rol"] = $obj->rol;
                $_SESSION['tema'] = $obj->tema;
                $_SESSION["language"]="es";


                header("Location: index.php");
                //Redireccion a index.php
              }
          } else {
            echo "Wrong Query";
          }

      }
    ?>

    <form action="login.php" method="post">

      <p>EMAIL: <input name="email" required></p>
      <p>CONTRASEÑA: <input name="clave" type="password" required></p>
      <p><input type="submit" value="Identificarme" class="btn btn-primary" name="login"></p>

    </form>
</div>



    <!-- Incluyendo la parte del código de la parte de abajo de la página. -->
    <?php include '../piepagina.php'; ?>
