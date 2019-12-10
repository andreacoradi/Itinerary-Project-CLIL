<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Risultato</title>
</head>
<body>
<?php
	include "routes.php";
	$start = $_POST["start"];
	$end = $_POST["end"];
	$usr_mezzi = $_POST["mezzo"];
	$tipo = $_POST["tipo"];

	if($tipo == "shortest") {
		$usr_important = "distanza";
	} elseif ($tipo == "fastest") {
		$usr_important = "tempo";
	} elseif ($tipo == "cheapest") {
		$usr_important = "costo";
	}

	$routes_temp = $routes;
	foreach($routes as $cityStart => $cityEnd) {

		foreach($cityEnd as $cityName => $mezzi) {
			$min_value = 99999999999;
			foreach($mezzi as $mezzo => $dati) {
				$del = $mezzo;

				// Qua voglio controllare se posso togliere qualche mezzo
				if(!in_array($mezzo, $usr_mezzi)) {
					unset($routes_temp[$cityStart][$cityName][$mezzo]);
					continue;
				}
				foreach($dati as $campo => $value) {
					if($campo == $usr_important) {
						if($value < $min_value) {
							// Abbiamo trovato un valore migliore

							if($min_value != 99999999999) {
								unset($routes_temp[$cityStart][$cityName][$del]);
							}

							$min_value = $value;
						} else {
							// Abbiamo trovato un valore peggiore

							unset($routes_temp[$cityStart][$cityName][$del]);
						}
					} else {
						// Questo campo non è importante

						unset($routes_temp[$cityStart][$cityName][$mezzo][$campo]);
					}
				}
			}
		}
	}
	echo "<br><pre>";
	print_r($routes_temp);
	echo "</pre>";


	require("Dijkstra.php");
	$g = new Graph();

	// Aggiungiaml
	foreach($routes_temp as $cityStart => $cityEnd) {
		foreach($cityEnd as $cityName => $mezzi) {
			//var_dump($mezzi);
			foreach($mezzi as $mezzo => $value) {

				$g->addedge($cityStart, $cityName, $value[$usr_important]);
				$g->addedge($cityName, $cityStart, $value[$usr_important]);
			}
		}
	}

	echo "<p>Per andare da " . $start . " a " . $end . ":</p>";
	list($distances, $prev) = $g->paths_from($start);
	$path = $g->paths_to($prev, $end);
	echo "Soluzione: ";
	echo "<br><pre>";
	print_r($path);
	echo "</pre>";
?>
</body>
</html>