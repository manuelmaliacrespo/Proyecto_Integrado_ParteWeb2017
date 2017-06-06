
<?php
require('fpdf.php');

$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->SetMargins(30, 25 , 30); 

          $connection = new mysqli("localhost", "mmalia", "123456", "proyecto");
          //Conexion a la base de datos (localhost, usuario, contraseña, bd).


          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
          //Validacion de la base de datos, en caso de error que lo muestre.

          $consulta="select * from extras";


          if ($result = $connection->query($consulta)) {

              if ($result->num_rows===0) {
              //Si el resultado es = 0 que me muestre que no hay actividades.
                echo "Sin extras";
              } else {
                //Pintame la tabla.



                while($obj = $result->fetch_object()) {
       				
       			
                     $pdf->Cell(40,5,$obj->actividad);
                     $pdf->Ln();
                     $pdf->Cell(40,5,$obj->descripcion);
                     $pdf->Ln();
                        /*echo "<p><b>Actividad:</b> ".$obj->actividad."</p>";
                        echo "<p><b>Precio:</b> ".$obj->precio." €</p>";
                        echo "<p><b>Descripción:</b> ".$obj->descripcion."</p>";*/
               



                };





              }
          } else {
            echo "Wrong Query";
          }


$pdf->Output();
?>