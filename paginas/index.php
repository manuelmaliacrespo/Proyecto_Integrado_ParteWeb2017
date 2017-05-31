<!-- Incluyendo la parte del código de la cabecera (principalmente menú)-->
<?php include '../cabecera.php'; ?>



<?php
//ABRIMOS CONEXIÓN A LA BASE DE DATOS.
$connection = new mysqli("localhost", "mmalia", "123456", "proyecto");

if ($connection->connect_errno) {
  printf("Connection failed: %s\n", $connection->connect_error);
  exit();
}
//Validacion de la conexion a la base de datos.
?>



<!-- CONTENIDO INDEX -->
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
  </ol>
  <!--PARTE DEL CARRUSEL -->
  <div class="carousel-inner" role="listbox">
    <div class="item active">
      <img style="height:400px; width:100%;" src="../images/carrusel/montana.jpeg" alt="...">
      <div class="carousel-caption">
        Pinares y Mar en Caños de Meca
      </div>
    </div>
    <div class="item">
      <img style="height:400px; width:100%;" src="../images/carrusel/faro_izquierda.jpeg" alt="...">
      <div class="carousel-caption">
        El verde se funde con el turquesa
      </div>
    </div>

    <div class="item">
      <img style="height:400px; width:100%;" src="../images/carrusel/noche.jpg" alt="...">
      <div class="carousel-caption">
        La Luna te envuelve
      </div>
    </div>

    <div class="item">
      <img style="height:400px; width:100%;" src="../images/carrusel/surf.png" alt="...">
      <div class="carousel-caption">
        Deportes acuáticos
      </div>
    </div>

  </div>

  <!-- Controls -->
  <!--HACIA DELANTE Y HACIA ATRAS DEL CARRUSEL-->
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>




<br><br>



<!-- MOSTRANDO VIVIENDAS -->
<?php
if ($result = $connection->query("SELECT * FROM viviendas")) {

  //Si la consulta devuelve 0 filas, mostrar "Sin viviendas".
  if ($result->num_rows===0) {
      echo "Sin viviendas";

  } else {
    //Mostramos contenido.
    echo '<div class="row">';
    while($obj = $result->fetch_object()) {
    //Recorrer los objetos.
      echo '
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <img style="height:220px; width:400px;" src="../images/viviendas/'.$obj->foto1.'" alt="...">
          <div class="caption">
            <h3>'.$obj->nombre.'</h3>
            <p>'.$obj->localizacion.'</p>
            <p><a href="ver_vivienda.php?id_vivienda='.$obj->id_vivienda.'" class="btn btn-primary" role="button">Ver vivienda</a> <a href="ver_comentarios.php?id_vivienda='.$obj->id_vivienda.'" class="btn btn-default" role="button">Comentarios</a></p>
          </div>
        </div>
      </div>';

    }
    //Bucle de cada casa con (foto, nombre, localizacion).
    //Ver_vivienda $_GET
    //Ver comentarios $_GET

    echo '</div>';


  }

} else {
    echo "Wrong Query";
}


?>



<!-- Incluyendo la parte del código de la parte de abajo de la página. -->
<?php include '../piepagina.php'; ?>
