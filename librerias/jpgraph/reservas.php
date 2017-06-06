<?php

require_once('jpgraph/jpgraph.php');
require_once('jpgraph/jpgraph_bar.php');


$connection = new mysqli("localhost", "mmalia", "123456", "proyecto");



if($result = $connection->query("select nombre, count(*) as cantidad from reservas 
left join viviendas on viviendas.id_vivienda=reservas.id_vivienda 
GROUP BY reservas.id_vivienda")) {
  while($obj = $result->fetch_object()) {
    $label[]=$obj->nombre;
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


