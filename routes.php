<?php
$routes =
    [
        "San Diego" =>
            [
                "Los Angeles" =>
                    [
                        "bus" => ["costo"=>11,"distanza"=>194, "tempo" => 118],
                        "airplane" => ["costo"=>142,"distanza"=>194, "tempo" => 89]
                    ]
            ],
        "Los Angeles" =>
            [
                "San Diego" =>
                    [
                        "bus" => ["costo"=>11,"distanza"=>194, "tempo" => 118],
                        "airplane" => ["costo"=>142,"distanza"=>194, "tempo" => 89]
                    ]
                ,
                "Portland" =>
                    [
                        "train" => ["costo"=>152,"distanza"=>1360, "tempo" => 618],
                        "airplane" => ["costo"=>276,"distanza"=>1360, "tempo" => 194]
                    ],
                "Washington D.C." =>
                    [
                        "bus" => ["costo"=>160,"distanza"=>3750, "tempo" => 1918],
                        "train" => ["costo"=>127,"distanza"=>3750, "tempo" => 1405],
                        "airplane" => ["costo"=>350,"distanza"=>3750, "tempo" => 375]
                    ]
            ],
        "Portland" =>
            [
                "Los Angeles" =>
                    [
                        "train" => ["costo"=>152,"distanza"=>1360, "tempo" => 618],
                        "airplane" => ["costo"=>276,"distanza"=>1360, "tempo" => 194]
                    ],
                "New York" =>
                    [
                        "bus" => ["costo"=>188,"distanza"=>3949, "tempo" => 2618],
                        "train" => ["costo"=>290,"distanza"=>3949, "tempo" => 1620]
                    ]
            ],
        "New York" =>
            [
                 "Portland" =>
                    [
                        "bus" => ["costo"=>188,"distanza"=>3949, "tempo" => 2618],
                        "train" => ["costo"=>290,"distanza"=>3949, "tempo" => 1620]
                    ],
                 "Washington D.C." =>
                    [
                        "bus" => ["costo"=>47,"distanza"=>328, "tempo" => 224],
                        "train" => ["costo"=>24,"distanza"=>328, "tempo" => 322],
                        "airplane" => ["costo"=>150,"distanza"=>328, "tempo" => 112]
                    ]
            ],
        "Washington D.C." =>
            [
                "New York" =>
                    [
                        "bus" => ["costo"=>47,"distanza"=>328, "tempo" => 224],
                        "train" => ["costo"=>24,"distanza"=>328, "tempo" => 322],
                        "airplane" => ["costo"=>150,"distanza"=>328, "tempo" => 112]
                    ],
                 "Los Angeles" =>
                    [
                        "bus" => ["costo"=>160,"distanza"=>3750, "tempo" => 1918],
                        "train" => ["costo"=>127,"distanza"=>3750, "tempo" => 1405],
                        "airplane" => ["costo"=>350,"distanza"=>3750, "tempo" => 375]
                    ]
            ]
    ];
?>
