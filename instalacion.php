<html>
<head>
 <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/navbar.css" rel="stylesheet">
    <script src="js/ie-emulation-modes-warning.js"></script>
</head>
<body>



<?php 
//PASO 1 
$_GET["paso"] = 1;
?>


<div class="container">

	<img src="images/logo.png" style="width: 400px"></img>




	<?php 

		//PRIMERA PARTE DE LA INSTALACIÓN
		if (isset($_POST['comprobar'])) {
			
			$connection = new mysqli($_POST["host"], $_POST["usuario"], $_POST["clave"], $_POST["nombre"]);


			if ($connection->connect_errno) {
	              echo "No se ha podido conectar a la base de datos";
	              echo "<br><br>";

	        } else {

				$configuracion = fopen("configuracion.php", "w");
				fwrite($configuracion, "<?php" . PHP_EOL);
				fwrite($configuracion, "\$nombre='".$_POST["nombre"]."';" . PHP_EOL);
				fwrite($configuracion, "\$host='".$_POST["host"]."';" . PHP_EOL);
				fwrite($configuracion, "\$usuario='".$_POST["usuario"]."';" . PHP_EOL);
				fwrite($configuracion, "\$clave='".$_POST["clave"]."';" . PHP_EOL);
				fwrite($configuracion, "?>" . PHP_EOL);
				fclose($configuracion);


				 //CREACION DE LA BASE DE DATOS
				$connection->query("CREATE TABLE `extras` (
				  `id_extras` int(11) NOT NULL,
				  `foto` varchar(50) NOT NULL,
				  `actividad` varchar(255) DEFAULT NULL,
				  `precio` float DEFAULT NULL,
				  `descripcion` text NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=latin1");



				$connection->query("INSERT INTO `extras` (`id_extras`, `foto`, `actividad`, `precio`, `descripcion`) VALUES
				(5, 'extras/cetaceo.jpg', 'Avistamiento cetÃ¡ceos', 50, 'El Estrecho de Gibraltar es paso obligado para ballenas piloto, orcas, cachalotes y delfines que cambian las frÃ­as aguas atlÃ¡nticas por el cÃ¡lido mar MediterrÃ¡neo. SÃºbete a uno de los barcos de avistamiento desde los que vivirÃ¡s una experiencia inolvidable.'),
				(6, 'extras/bici.jpg', 'Ruta en bici', 30, 'Rutas que ofrecen una perfecta combinaciÃ³n de deporte, relax y aventura, en un entorno ideal y con un clima templado. Recorridos con la bici por las costas con calas escondidas y largas playas y acantilados, donde podrÃ¡s disfrutar de las magnÃ­ficas vistas de Ãfrica.'),
				(7, 'extras/caballo.jpg', 'Ruta en caballo', 100, 'Si te gusta disfrutar de la naturaleza sin ruidos y sin las interrupciones de la ciudad, los paseos a caballo serÃ¡n tu deporte favorito. Estas rutas estÃ¡n muy bien pensadas y diseÃ±adas para disfrutar al mÃ¡ximo de esta experiencia.'),
				(8, 'extras/4x4.jpg', 'Ruta en 4x4', 70, 'Las rutas 4x4, estÃ¡n abiertas a todas las personas amantes de la naturaleza, de cualquier edad y condiciÃ³n fÃ­sica. Es una forma accesible para todos de conocer el paisaje y disfrutarlo en las distintas estaciones del aÃ±o.'),
				(9, 'extras/kitesurf.jpg', 'Kitesurf', 60, 'CaÃ±os de Meca es uno de los lugares mÃ¡s destacados para la prÃ¡ctica de kitesurf. Junto al faro de Trafalgar, cuando sopla el levante, los surfistas toman sus cometas y constituyen un impresionante espectÃ¡culo para ver.'),
				(10, 'extras/windsurf.jpg', 'Windsurf', 60, 'Los fuertes vientos de levante y de poniente que recorren este litoral ofrecen enormes posibilidades para los amantes de este deporte. Las playas del Faro, en CaÃ±os de Meca, son escenarios Ãºnicos donde iniciarse en este apasionante deporte.'),
				(11, 'extras/buceo.jpg', 'Buceo', 100, 'Nos encontramos en uno de los enclaves mÃ¡s paradisÃ­acos y vÃ­rgenes que aÃºn se pueden encontrar en EspaÃ±a, un litoral de excepcional calidad, con playas muy diversas y aguas limpias y transparentes para disfrutar al mÃ¡ximo de esta actividad.')");


				$connection->query("CREATE TABLE `reservas` (
				  `id_reserva` int(11) NOT NULL,
				  `fecha_reserva` date DEFAULT NULL,
				  `fecha_entrada` date DEFAULT NULL,
				  `fecha_salida` date DEFAULT NULL,
				  `dinero_reserva` float DEFAULT NULL,
				  `estado` varchar(40) NOT NULL,
				  `id_usuario` int(11) NOT NULL,
				  `id_vivienda` int(11) DEFAULT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=latin1");


				$connection->query("INSERT INTO `reservas` (`id_reserva`, `fecha_reserva`, `fecha_entrada`, `fecha_salida`, `dinero_reserva`, `estado`, `id_usuario`, `id_vivienda`) VALUES
				(13, '2017-03-06', '2017-03-23', '2017-03-26', 80, 'PENDIENTE', 1, 11),
				(14, '2017-03-06', '2017-04-05', '2017-03-24', 40, 'ACEPTADO', 1, 12),
				(15, '2017-03-06', '2017-03-30', '2017-03-31', 80, 'PENDIENTE', 1, 11),
				(16, '2017-03-06', '2017-03-15', '2017-03-18', 80, 'PENDIENTE', 1, 11),
				(17, '2017-03-06', '2017-03-06', '2017-03-07', 50, 'PENDIENTE', 1, 8),
				(18, '2017-03-06', '2017-03-15', '2017-03-17', 60, 'CANCELADO', 1, 7),
				(19, '2017-03-06', '2017-03-06', '2017-03-09', 80, 'PENDIENTE', 1, 11),
				(20, '2017-03-09', '2017-03-30', '2017-03-31', 50, 'PENDIENTE', 1, 8),
				(21, '2017-03-09', '2017-03-01', '2017-03-15', 40, 'PENDIENTE', 1, 12)");


				$connection->query("CREATE TABLE `usuarios` (
				  `id_usuario` int(11) NOT NULL,
				  `dni` varchar(255) DEFAULT NULL,
				  `email` varchar(255) DEFAULT NULL,
				  `rol` varchar(20) DEFAULT NULL,
				  `clave` varchar(100) DEFAULT NULL,
				  `nombre` varchar(50) NOT NULL,
				  `apellidos` varchar(50) NOT NULL,
				  `tema` int(2) NOT NULL DEFAULT '0'
				) ENGINE=InnoDB DEFAULT CHARSET=latin1");



				$connection->query("INSERT INTO `usuarios` (`id_usuario`, `dni`, `email`, `rol`, `clave`, `nombre`, `apellidos`, `tema`) VALUES
				(1, '44048888R', 'malia@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Manuel', 'Malia Crespo', 0),
				(8, '56456456e', 'antonio@gmail.com', 'usuario', 'e10adc3949ba59abbe56e057f20f883e', 'antonio', 'gomez', 0),
				(10, '44445555R', 'bea@gmail.com', 'usuario', 'e10adc3949ba59abbe56e057f20f883e', 'beatriz', 'garcia', 0),
				(11, '21212121R', 'carmen@gmail.com', 'usuario', 'e10adc3949ba59abbe56e057f20f883e', 'carmen', 'crespo', 0),
				(14, '11111123L', 'suzamora@gmail.com', 'usuario', 'e10adc3949ba59abbe56e057f20f883e', 'Jesus', 'Zamora', 0),
				(15, '12131415R', 'rebollo@gmail.com', 'usuario', 'e10adc3949ba59abbe56e057f20f883e', 'miguel', 'rebollo', 0),
				(18, 'das', '22malia@gmail.com', 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'dasd', 'das', 0)");


				$connection->query("CREATE TABLE `valoracion` (
				  `id_valoracion` int(11) NOT NULL,
				  `puntuacion` tinyint(4) DEFAULT NULL,
				  `comentario` varchar(255) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
				  `fecha` date NOT NULL,
				  `id_vivienda` int(11) DEFAULT NULL,
				  `id_usuario` int(11) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=latin1");



				$connection->query("INSERT INTO `valoracion` (`id_valoracion`, `puntuacion`, `comentario`, `fecha`, `id_vivienda`, `id_usuario`) VALUES
				(1, 4, 'To use the min, max, and step attributes the input first needs a type of number, range or one of the date/time values. In the case of type=\"number\", small arrow widgets are applied after the input which increment the current value of the input up or down.', '2017-02-28', 11, 1),
				(12, 4, 'hola que tal esto es otro comentario', '2017-02-28', 7, 1)");



				$connection->query("CREATE TABLE `viviendas` (
				  `id_vivienda` int(11) NOT NULL,
				  `nombre` varchar(50) NOT NULL,
				  `localizacion` varchar(100) DEFAULT NULL,
				  `dormitorios` varchar(30) DEFAULT NULL,
				  `personas` varchar(30) DEFAULT NULL,
				  `mascotas` varchar(30) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
				  `precio_baja` varchar(30) DEFAULT NULL,
				  `precio_media` varchar(30) DEFAULT NULL,
				  `precio_alta` varchar(30) DEFAULT NULL,
				  `descripcion` varchar(500) DEFAULT NULL,
				  `foto1` varchar(50) NOT NULL,
				  `foto2` varchar(50) NOT NULL,
				  `foto3` varchar(50) NOT NULL,
				  `foto4` varchar(50) NOT NULL,
				  `foto5` varchar(50) NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=latin1");


				$connection->query("INSERT INTO `viviendas` (`id_vivienda`, `nombre`, `localizacion`, `dormitorios`, `personas`, `mascotas`, `precio_baja`, `precio_media`, `precio_alta`, `descripcion`, `foto1`, `foto2`, `foto3`, `foto4`, `foto5`) VALUES
				(7, 'Torre de Meca', 'CaÃ±os de Meca, nÂº 101', '2', '4', 'SI', '60', '100', '120', 'La casaÂ Torre de Meca Â tiene una superficie construida de 70 m2 en parcela de 250 m2. Dispone de 2Â \r\ndormitorios con capacidad para 4 personas, salÃ³n, cocina totalmente equipada y cuarto de baÃ±o. Porche,Â \r\njardÃ­n con tumbonas, patio trasero con barbacoa y aparcamiento para varios vehÃ­culos.Vistas al\r\nParque Natural de la BreÃ±a y a tan sÃ³lo 100 m. de la playa. Se alquila ademÃ¡s otroÂ \r\nchalet igual llamado Torre del Tajo.Â ', 'meca/1.jpg', 'meca/2.jpg', 'meca/3.jpg', 'meca/4.jpg', 'meca/5.jpg'),
				(8, 'Casa Arahal', 'CaÃ±os de Meca, nÂº 87', '2', '4', 'SI', '50', '80', '100', 'Casitas Arahal\r\n\r\nLas Casa Arahal se encuentran situadas en CaÃ±os de Meca, en la zona denominada CaÃ±ada del Alamo, en pleno Parque Natural de la BreÃ±a y frente a las playas de Trafalgar. Alquiler de dos casas rurales de 2 dormitorios en un ambiente rural Ãºnico donde podrÃ¡ disfrutar de unas vacaciones inolvidable y disfrutar de todo tipo de actividades de naturaleza y de playa como paseos a caballo, senderismo, bicicleta, buceo, kitesurfing... Se admiten mascotas.', 'arahal/1.jpg', 'arahal/2.jpg', 'arahal/3.jpg', 'arahal/4.jpg', 'arahal/5.jpg'),
				(9, 'Lapa', 'UrbanizaciÃ³n Cabo de Trafalgar', '3', '6', 'SI', '70', '100', '130', 'Chalet nuevo, muy equipado, cuidado y acogedor, en parcela cerrada con cÃ©sped y aparcamiento interior. Tiene tres dormitorios, uno de matrimonio y dos con dos camas cada uno, todos con armarios empotrados y ventanas con vistas al jardÃ­n, el salÃ³n es amplio con chimenea, mesa comedor y dos sofÃ¡s con mesa central, la TV dispone de antena parabÃ³lica, el cuarto de baÃ±o tiene baÃ±era, lavabo con encimera y pequeÃ±o armario, la cocina es cÃ³moda y muy funcional, en el exterior de la casa se encu', 'lapa/1.jpg', 'lapa/2.jpg', 'lapa/3.jpg', 'lapa/4.jpg', 'lapa/5.jpg'),
				(10, 'La BreÃ±a', 'UrbanizaciÃ³n Cabo de Trafalgar', '2', '4', 'SI', '60', '90', '130', 'Alquiler de chalet \"La BreÃ±a\" en Los CaÃ±os de Meca con vistas al mar y al Parque Natural de la BreÃ±a. Ubicados en un entorno privilegiado junto al Faro de Trafalgar y a tan solo 100 m. de la playa.', 'brena/1.jpg', 'brena/2.jpg', 'brena/3.jpg', 'brena/4.jpg', 'brena/5.jpg'),
				(11, 'Domus', 'UrbanizaciÃ³n Cabo de Trafalgar', '3', '6', 'SI', '80', '130', '160', 'Con 180 m2 construidos, cuenta con una decoraciÃ³n cuidada y exquisita y todo lujo de detalles para que no te falte absolutamente nada en tus vacaciones: â€¢ Tres dormitorios, uno de matrimonio y dos con dos camas individuales. â€¢ Cocina, salÃ³n, comedor, porche y terraza, 2 cuartos de baÃ±os, uno con ducha y otro con baÃ±era. â€¢ Cocina con lavavajillas, lavadora, horno microondas, vitrocerÃ¡mica, freidora y agua potable depurada por osmosis inversa. â€¢ CalefacciÃ³n por radiadores y A.A. â€¢ ', 'domus/1.jpg', 'domus/2.jpg', 'domus/3.jpg', 'domus/4.jpg', 'domus/5.jpg'),
				(12, 'El Mero', 'CaÃ±os de Meca, nÂº 123', '2', '4', 'SI', '40', '60', '100', 'Una magnÃ­fica casa rural de dos dormitorios con capacidad para 4 plazas con salÃ³n comedor, amplia cocina, dormitorios con armarios empotrados, gran cuarto de baÃ±o con hidromasaje, porche, jardÃ­n, barbacoa y aparcamiento privado. Y dos magnÃ­ficos bungalows de un dormitorio 2 plazas en el entorno rural de CaÃ±os de Meca, cerca de la playa. Con salÃ³n comedor, cocina americana totalmente equipada, un dormitorio con armario empotrado, sofÃ¡ cama, cuarto de baÃ±o, porche, jardÃ­n y aparcamiento ', 'mero/1.jpg', 'mero/2.jpg', 'mero/3.jpg', 'mero/4.jpg', 'mero/5.jpg'),
				(13, 'Trafalgar', 'Cabo de Trafalgar', '2', '6', 'SI', '50', '90', '140', 'Se alquila casa \"Trafalgar\" en CaÃ±os de Meca con dos dormitorios,1 baÃ±o, salÃ³n , cocina totalmente equipada y terraza. Capacidad para 6 personas. Solarium con preciosas vistas al Parque natural de la BreÃ±a, a la playa y al Faro de Trafalgar. UrbanizaciÃ³n privada y muy tranquila. Precios y disponibilidad consultar. Preciosas playas de arena blanca. Posibilidad de alquiler conjunto con Casa Lele 1, con una capacidad mÃ¡xima para 12 personas. Los CaÃ±os de Meca es una pedanÃ­a de Barbate, en l', 'trafalgar/1.jpg', 'trafalgar/2.jpg', 'trafalgar/3.jpg', 'trafalgar/4.jpg', 'trafalgar/5.jpg')");


				$connection->query("ALTER TABLE `extras`
				  ADD PRIMARY KEY (`id_extras`)");


				$connection->query("ALTER TABLE `reservas`
				  ADD PRIMARY KEY (`id_reserva`),
				  ADD KEY `id_usuario` (`id_usuario`),
				  ADD KEY `id_vivienda` (`id_vivienda`)");


				$connection->query("ALTER TABLE `usuarios`
				  ADD PRIMARY KEY (`id_usuario`),
				  ADD UNIQUE KEY `email` (`email`)");


				$connection->query("ALTER TABLE `valoracion`
				  ADD PRIMARY KEY (`id_valoracion`),
				  ADD KEY `id_vivienda` (`id_vivienda`),
				  ADD KEY `id_usuario` (`id_usuario`)");


				$connection->query("ALTER TABLE `viviendas`
				  ADD PRIMARY KEY (`id_vivienda`)");


				$connection->query("ALTER TABLE `extras`
				  MODIFY `id_extras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12");


				$connection->query("ALTER TABLE `reservas`
				  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22");




				$connection->query("ALTER TABLE `usuarios`
				  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19");


				$connection->query("ALTER TABLE `valoracion`
				  MODIFY `id_valoracion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13");


				$connection->query("ALTER TABLE `viviendas`
				  MODIFY `id_vivienda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14");


				$connection->query("ALTER TABLE `reservas`
				  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
				  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`id_vivienda`) REFERENCES `viviendas` (`id_vivienda`) ON DELETE CASCADE ON UPDATE CASCADE");


				$connection->query("ALTER TABLE `valoracion`
				  ADD CONSTRAINT `valoracion_ibfk_1` FOREIGN KEY (`id_vivienda`) REFERENCES `viviendas` (`id_vivienda`) ON DELETE CASCADE ON UPDATE CASCADE,
				  ADD CONSTRAINT `valoracion_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE");



	        	$_GET["paso"]=2;

	        }
	
		}




		//SEGUNDA PARTE REGISTRO
		if (isset($_POST["registro"])) {

			include "configuracion.php";
			$connection = new mysqli($host, $usuario, $clave, $nombre);

		    $consulta="insert into usuarios (email, clave, nombre, apellidos, dni, rol)
		      values ('".$_POST["email"]."', md5('".$_POST["clave"]."'), '".$_POST["nombre"]."', '".$_POST["apellidos"]."', '".$_POST["dni"]."', 'admin')";

	      	if ($result = $connection->query($consulta)) {
	            $_GET["paso"]=3;

	      	} else {
	      		$_GET["paso"]=2;
	        	echo "<br>Error en la consulta<br><br>";
	        }

  		}




	?>


	<!-- PASO 1 COMPROBACIÓN CONEXION BASE DE DATOS -->
	<?php if($_GET["paso"]==1): ?>
		
	<form method="post">

	Nombre de la base de datos:<br>
	<input name="nombre" required></input>
	<br><br>

	Host donde se encuentra:<br>
	<input name="host" required></input>
	<br><br>

	Usuario:<br>
	<input name="usuario" required></input>
	<br><br>

	Contraseña:<br>
	<input name="clave" required></input>

	<br><br>
	<input type="submit" value="Comprobar Datos" class="btn btn-primary" name="comprobar">

	</form>
	<?php endif; ?>



	<!-- PASO 2 CREACIÓN DEL USUARIO -->
	<?php if($_GET["paso"]==2): ?>
		

	<form method="post">

		Email:<br>
		<input name="email" required></input>
		<br><br>
		
		Contraseña:<br>
		<input name="clave" type="password" required></input>
		<br><br>

		Nombre:<br>
		<input name="nombre" type="text" required></input>
		<br><br>

		Apellidos:<br>
		<input name="apellidos" type="text" required></input>
		<br><br>

		DNI:<br>
		<input name="dni" type="text" required></input>
		<br><br>


	  <p><input type="submit" value="Registrar administrador" class="btn btn-primary" name="registro"></p>

	</form>
	<?php endif; ?>









	<!-- PASO 3 -->
	<?php if($_GET["paso"]==3): ?>
		
	<?php endif; ?>

</div>



</body>
</html>