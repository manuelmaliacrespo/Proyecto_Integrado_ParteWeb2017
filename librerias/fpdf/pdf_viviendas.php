
<?php
require('fpdf.php');


$connection = new mysqli($host, $usuario, $clave, $nombre);

$pdf = new FPDF();
$pdf -> AddPage();
$pdf -> SetFont('Arial', '', 14);
$pdf -> Cell(165, 10, 'TRAFALGAR ERES TU', 0);

$pdf -> Ln(15);

$pdf -> Cell(70, 8, 'Nombre', 0);
$pdf -> Cell(60, 8, 'Localizacion', 0);

$pdf -> Ln(8);
$pdf -> SetFont('Arial', '', 9);


          $connection = new mysqli($host, $usuario, $clave, $nombre);
          //Conexion a la base de datos (localhost, usuario, contraseña, bd).


          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          //Validacion de la base de datos, en caso de error que lo muestre.

          $consulta="select * from viviendas";


          if ($result = $connection->query($consulta)) {

              if ($result->num_rows===0) {
                echo "Sin extras";
              } else {
              

                while($obj = $result->fetch_object()) {
       				
       			
                        $pdf -> SetFont('Arial', '', 9);
                        $pdf -> Cell(70, 8, utf8_decode($obj->nombre), 0);
                        $pdf -> Cell(40, 8, utf8_decode($obj->localizacion), 0);

                        $pdf -> Ln(8);


                };


              }
          } else {
            echo "Wrong Query";
          }


$pdf->Output();
?>


