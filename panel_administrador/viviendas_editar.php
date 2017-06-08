<?php include '../cabecera.php'; ?>


<?php

if($_SESSION["rol"] != "admin") {
  header ("Location: ../paginas/index.php");
}
//Si el rol "NO" es admin redirigir a index.php
?>





<h3 align="center">Editar Viviendas</h3>




<?php
//SI HACE CLIC EN EL EDITAR
    if (isset($_POST["editar_viviendas"])) {
    //Si existe el campo registro...
      $connection = new mysqli($host, $usuario, $clave, $nombre);
      //Conexion a la base de datos (localhost, usuario, contraseña, bd).

      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }
      //Validacion de la base de datos, en caso de error que lo muestre.

      $consulta="update viviendas set nombre='".$_POST["nombre"]."',
      localizacion='".$_POST["localizacion"]."',
      dormitorios='".$_POST["dormitorios"]."',
      personas='".$_POST["personas"]."',
      mascotas='".$_POST["mascotas"]."',
      precio_baja='".$_POST["precio_baja"]."',
      precio_media='".$_POST["precio_media"]."',
      precio_alta='".$_POST["precio_alta"]."',
      foto1='".$_POST["foto1"]."',
      foto2='".$_POST["foto2"]."',
      foto3='".$_POST["foto3"]."',
      foto4='".$_POST["foto4"]."',
      foto5='".$_POST["foto5"]."',
      descripcion='".$_POST["descripcion"]."'

      where id_vivienda='".$_POST["id_vivienda"]."'";



      if ($result = $connection->query($consulta)) {

            //VALID LOGIN. SETTING SESSION VARS
            header ("Location: viviendas.php");

      } else {
        echo "Wrong Query";
        echo $consulta;
      }

  }
?>






<?php
//VIENE DE VIVIENDAS.PHP RELLENAMOS EL FORMULARIO CON LOS DATOS DE LA VIVIENDA.
if (isset($_GET["editar"])) {

  $connection = new mysqli($host, $usuario, $clave, $nombre);
  //Conexion a la base de datos (localhost, usuario, contraseña, bd).

  $consulta = "select * from viviendas where id_vivienda=".$_GET["editar"]."";


  if ($result = $connection->query($consulta)) {

      if ($result->num_rows===0) {

        echo "No existe la vivienda";
      } else {


        $obj = $result->fetch_object();

        echo '<form action="viviendas_editar.php" method="post">

          <input type="hidden" value="'.$obj->id_vivienda.'" name="id_vivienda" readonly>
          <p>NOMBRE: <input type="text" value="'.$obj->nombre.'" name="nombre" required></p>
          <p>LOCALIZACIÓN: <input type="text" value="'.$obj->localizacion.'" name="localizacion"></p>
          <p>DORMITORIOS: <input type="text" value="'.$obj->dormitorios.'" name="dormitorios"></p>
          <p>PERSONAS: <input type="text" value="'.$obj->personas.'" name="personas"></p>
          <p>MASCOTAS: <input type="text" value="'.$obj->mascotas.'" name="mascotas"></p>
          <p>TEMP. BAJA: <input type="text" value="'.$obj->precio_baja.'" name="precio_baja"></p>
          <p>TEMP. MEDIA: <input type="text" value="'.$obj->precio_media.'" name="precio_media"></p>
          <p>TEMP. ALTA: <input type="text" value="'.$obj->precio_alta.'" name="precio_alta"></p>
          <p>FOTO: <input type="text" name="foto1" value="'.$obj->foto1.'"required></p>
          <p>FOTO2: <input type="text" name="foto2" value="'.$obj->foto2.'"></p>
          <p>FOTO3: <input type="text" name="foto3" value="'.$obj->foto3.'"></p>
          <p>FOTO4: <input type="text" name="foto4" value="'.$obj->foto4.'"></p>
          <p>FOTO5: <input type="text" name="foto5" value="'.$obj->foto5.'"></p>
          <p>DESCRIPCIÓN: <textarea name="descripcion" style="width:250px">'.$obj->descripcion.'</textarea></p>


          <p><input type="submit" value="Aceptar" class="btn btn-primary" name="editar_viviendas"></p>

        </form>';

      }
  } else {
    echo "Wrong Query";
  }

}

?>


<!-- Incluyendo la parte del código de la parte de abajo de la página. -->
<?php include '../piepagina.php'; ?>
