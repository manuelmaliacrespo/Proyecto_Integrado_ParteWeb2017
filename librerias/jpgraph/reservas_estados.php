<?php

require_once('jpgraph/jpgraph.php');
require_once('jpgraph/jpgraph_bar.php');


$connection = new mysqli($host, $usuario, $clave, $nombre);



if($result = $connection->query("select estado, count(*) as cantidad from reservas 
left join viviendas on viviendas.id_vivienda=reservas.id_vivienda 
GROUP BY estado")) {
  while($obj = $result->fetch_object()) {
    $label[]=$obj->estado;
    $datos[]=$obj->cantidad;
  }
}


$reservas_jpgraph = new Graph(400,150,'auto');

$reservas_jpgraph->SetScale("textint");

$reservas_jpgraph->xaxis->SetTickLabels($label);

$reservas_jpgraph->img->SetMargin(25,25,25,25);

$barplot1 = new BarPLot($datos);
$barplot1->SetWeight(0);

$barplot1->SetFillGradient("#1d57ab","#3866a9",GRAD_HOR);

$barplot1->SetWidth(25);

$reservas_jpgraph->add($barplot1);

$reservas_jpgraph->stroke();


?>


