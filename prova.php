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

	$a = $routes[$start][$end];
	$t = 0;
	$key = "distanza";
	if($tipo == "shortest") {
		$t = $a[$mezzi[0]];
	} elseif ($tipo == "fastest") {
		$key = "tempo";
	} elseif ($tipo == "cheapest") {
		$key = "costo";
	}

	$best = $routes[$start][$end][$mezzi[0]];
	$m = $mezzi[0];

	foreach($mezzi as $mezzo) {
		$linea = $routes[$start][$end][$mezzo];

		if($linea != NULL) {
			echo $linea[$key] . " " . $t;
			if($linea[$key] < $t) {
				$best = $linea;
				$m = $mezzo;
			}
			//echo "<p>Andando in " . $mezzo . " costa " . $linea["costo"] . " e ci metti " . $linea["tempo"] ."</p>";
			//echo $routes[$start][$end][$mezzo];
		}
	}

	echo "<p>Andando in " . $m . " costa " . $best["costo"] . " e ci metti " . $best["tempo"] . " in distanza ". $best["distanza"] . "</p>";

?>
</body>
</html>