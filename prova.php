<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
<?php
	include "routes.php";
	$start = $_POST["start"];
	$end = $_POST["end"];
	$mezzi = $_POST["mezzo"];
	$tipo = $_POST["tipo"];
	// var_dump($mezzi);
	//var_dump($routes);
	echo "<p>Da " . $start . " a " . $end . " dista " . $routes[$start][$end][$mezzi[0]]["distanza"];
	foreach($mezzi as $mezzo) {
		$linea = $routes[$start][$end][$mezzo];
		if($linea != NULL) {
			echo "<p>Andando in " . $mezzo . " costa " . $linea["costo"] . " e ci metti " . $linea["tempo"] ."</p>";
			//echo $routes[$start][$end][$mezzo];
		}
	}

?>
</body>
</html>