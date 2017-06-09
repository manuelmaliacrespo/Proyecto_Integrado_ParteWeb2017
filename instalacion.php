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

	        	$_GET["paso"]=2;

	        }

		
		}

	?>



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

</div>



</body>
</html>