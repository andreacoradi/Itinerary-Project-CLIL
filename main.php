<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Solution</title>
</head>
<body>

<div class="sidenav">
	  <a href="index.html" class="logo1"><img src="./pics/LOGO1.png"</a>
      <a href="mete.html"><span class="icon-location"></span> Explore</a>
	</div>
	
	
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
	// echo "<h1>" . $usr_important . "</h1>";
	$routes_temp = $routes;
	foreach($routes as $cityStart => $cityEnd) {

		foreach($cityEnd as $cityName => $mezzi) {
			$min_value = 99999999999;
			// echo "<p>" . $cityName ."</p>";

			foreach($mezzi as $mezzo => $dati) {
				$del = $mezzo;
				if($min_value == 99999999999)
					$best = $mezzo;
				// Qua voglio controllare se posso togliere qualche mezzo
				if(!in_array($mezzo, $usr_mezzi)) {
					unset($routes_temp[$cityStart][$cityName][$mezzo]);
					continue;
				}
				foreach($dati as $campo => $value) {
					if($campo == $usr_important) {
						if($value < $min_value) {
							// Abbiamo trovato un valore migliore
							//echo "<p>" . $mezzo . "</p>";
							//echo "<p>" . $value ." < " . $min_value . "</p>";
							if($min_value != 99999999999) {
								$best = $mezzo;
							}

							$min_value = $value;
							// echo "<p>Min value is now: " . $min_value . "</p>";
						} else {
							// echo "<p>" . $value ." > " . $min_value . "</p>";
							// Abbiamo trovato un valore peggiore

							unset($routes_temp[$cityStart][$cityName][$del]);
						}
					} else {
						// Questo campo non è importante

						// unset($routes_temp[$cityStart][$cityName][$mezzo][$campo]);
					}
				}
			}

			foreach($mezzi as $m => $d) {
				if($m != $best){
					//echo "<p>Togliaml " . $m . " da " . $cityStart . " => " . $cityName . "</p>";
					unset($routes_temp[$cityStart][$cityName][$m]);
				}
			}
		}
	}
	/*
	echo "<br><pre>";
	print_r($routes);
	echo "</pre>";

	echo "<br><pre>";
	print_r($routes_temp);
	echo "</pre>";*/


	require("./lib/Dijkstra.php");
	$g = new Graph();

	// Aggiungiaml
	foreach($routes_temp as $cityStart => $cityEnd) {
		foreach($cityEnd as $cityName => $mezzi) {
			if(count($routes_temp[$cityStart][$cityName]) == 0) {
				unset($routes_temp[$cityStart][$cityName]);
			}
			foreach($mezzi as $mezzo => $value) {
				$g->addedge($cityStart, $cityName, $value[$usr_important]);
				$g->addedge($cityName, $cityStart, $value[$usr_important]);
			}
		}
	}

	//echo "<p>Per andare da " . $start . " a " . $end . ":</p>";
	list($distances, $prev) = $g->paths_from($start);
	$path = $g->paths_to($prev, $end);
	//echo "Soluzione: ";
	//echo "<br><pre>";


	//print_r($path);

	if(count($path) == 0) {
		echo "<h1>There is no way to reach that destination</h1>";
	}
	//echo "</pre>";
	$tipo = ucfirst($tipo);
	function fileName($string) {
		return str_replace(".", "", str_replace(" ", "", strtolower($string)));
	}

	echo "<h1>Your itinerary</h1>";
	$startLink = "<a href='./cities/" . fileName($start) . ".html'>$start</a>";
	$endLink = "<a href='./cities/" . fileName($end) . ".html'>$end</a>";

	echo "<p>You chose to go from $startLink to $endLink</p>";
	echo "<h3>$tipo itinerary</h3>";


	$costo = 0;
	for($i = 0; $i < count($path)-1; $i++) {
		$c1 = $path[$i];
		$c2 = $path[$i+1];
		foreach($routes_temp[$c1][$c2] as $key=> $value){
			/*$durata = strval(number_format((float)$value["tempo"] / 60, 2, '.', ''));
			$durata = str_replace(".", ":", $durata);*/
			$durata = gmdate("i:s", $value["tempo"]);
			echo "<p>$c1 to $c2 by $key: $" . $value["costo"] . ", duration " . $durata . " hours</p>";
			$costo += $value["costo"];
		}
		//var_dump($routes_temp[$c1][$c2][array_keys($routes_temp[$c1][$c2])]);
	}
	echo "<p>Total cost: $$costo</p>";
?>
</body>
</html>