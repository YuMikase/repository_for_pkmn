<?php

return [
    //1** => PC, 2** => Drink,

    //PC
    101 => [
        'id' => 101,
        'name' => 'しょぼいPC',
        'type' => 'PC',
        'barning' => 10,
        'progress' => -10,
        'time' => 1,
    ],
    102 => [
        'id' => 102,
        'name' => 'ふつうのPC',
        'type' => 'PC',
        'barning' => -10,
        'progress' => 10,
        'time' => 1,
    ],
    103 => [
        'id' => 103,
        'name' => 'いいPC',
        'type' => 'PC',
        'barning' => -20,
        'progress' => 20,
        'time' => 1,
    ],

    //Drink
    201 => [
        'id' => 201,
        'name' => 'コーヒー',
        'type' => 'Drink',
        'barning' => -10,
        'progress' => 10,
        'time' => 1,
    ],
    202 => [
        'id' => 202,
        'name' => 'RedBull',
        'type' => 'Drink',
        'barning' => -20,
        'progress' => 20,
        'time' => 1,
    ],
    203 => [
        'id' => 203,
        'name' => 'Monster',
        'type' => 'Drink',
        'barning' => -30,
        'progress' => 30,
        'time' => 1,
    ],
    
];
