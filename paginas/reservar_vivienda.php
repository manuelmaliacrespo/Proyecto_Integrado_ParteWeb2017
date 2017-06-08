<!-- Incluyendo la parte del código de la cabecera (principalmente menú)-->
<?php include '../cabecera.php'; ?>




<?php

    if (isset($_POST["reservar_vivienda"])) {
    //Si existe petición $_POST reservar_vivienda (name= ver_vivienda)

      $connection = new mysqli($host, $usuario, $clave, $nombre);
      //Conexion base de datos

      if ($connection->connect_errno) {
          printf("Connection failed: %s\n", $connection->connect_error);
          exit();
      }
      //Validación







      $consulta_comprobar = "SELECT * FROM reservas
      WHERE (fecha_entrada BETWEEN '".$_POST["fecha_entrada"]."' AND '".$_POST["fecha_salida"]."' OR fecha_salida BETWEEN '".$_POST["fecha_entrada"]."' AND '".$_POST["fecha_salida"]."') AND id_vivienda='".$_POST["id_vivienda"]."'";


      if ($result2 = $connection->query($consulta_comprobar)) {

          //Si el resultado es 0, significa que no hay reservas en ese rango y por lo tanto, se puede hacer la nueva reserva:
          if ($result2->num_rows===0) {
          //Si el resultado es 0 (se puede reservar)



                            $consulta="INSERT INTO reservas (fecha_entrada, fecha_salida, estado, dinero_reserva, fecha_reserva, id_usuario, id_vivienda)
                            VALUES ('".$_POST["fecha_entrada"]."', '".$_POST["fecha_salida"]."', 'PENDIENTE', '".$_POST["dinero_reserva"]."', now(), '".$_SESSION["id_usuario"]."', '".$_POST["id_vivienda"]."')";
                            //Consulta para insertar "reserva" con campos de reserva.
                            //now(fecha actual)

                            if ($result = $connection->query($consulta)) {
                            //Si es ok...
                            //Copiado de internet. Funcion para sacar los dias que hay entre dos fechas. Fecha_entrada a Fecha_salida.
                            function dias_transcurridos($fecha_i,$fecha_f) {
                                $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
                                $dias 	= abs($dias); $dias = floor($dias);
                                return $dias;
                            }
                            //86400 = para sacar los dias.
                            $dias = dias_transcurridos($_POST["fecha_entrada"], $_POST["fecha_salida"]);
                            //Fecha entrada y fecha salida ( saber dias transcurridos entre una fecha y otra ).



                            $dinero_reserva = $_POST["dinero_reserva"];
                            //Saco de la consulta.
                            $dinero_porcentaje = $dinero_reserva*0.3;
                            //Calcular el 30% de los dias que se haya elegido.
                            $resultado = $dinero_porcentaje*$dias;
                            //Multiplico por el numero de dias.

                            echo "Se ha hecho la reserva correctamente. Aquí metemos los datos bancarios para hacer el ingreso.";
                            echo "<br>Haz el ingreso en BBVA: <b>ES00 0000 0000 00 0000000000</b> de la señal: <b>".$resultado." Euros</b>.";

                            echo "<br><br>Especificar en concepto el Email: <b>".$_SESSION["email"]."</b>";

                            echo "<br><br>Cualquier duda, ponte en contacto con <b>Manuel Malia Crespo</b> al <b>606 96 49 28</b>.";



                            } else {
                              echo "Wrong Query";
                              //Fallo en la query.
                            }




          //En caso contrario mostramos que no se puede realizar la reserva.
          } else {
            echo "No se puede hacer una reserva del <b>".$_POST["fecha_entrada"]."</b> al <b>".$_POST["fecha_salida"]."</b> debido a una reserva anteriormente realizada en esta vivienda.";
          }



      }





  }
?>







<!-- Incluyendo la parte del código de la parte de abajo de la página. -->
<?php include '../piepagina.php'; ?>
