<?php

require __DIR__ . '/../vendor/autoload.php';


foreach (scandir(__DIR__) as $filename) {
    if (preg_match("#^input([0-9]{3})\.dat$#", $filename, $matches)) {
        $file = file(__DIR__ . '/' . $filename);
        $regularCube = new \Hexomino\Cube(
            $file[0][0],
            $file[0][2],
            $file[1][0],
            $file[1][2],
            $file[2][0],
            $file[2][2]
        );

        $hexominoCube = new \Hexomino\Cube(
            $file[6][2], //front
            $file[4][2], //rear
            $file[4][0], //left
            $file[4][4], //right
            $file[5][2],
            $file[7][2]
        );

        echo $regularCube->isEquivalent($hexominoCube) ? 'true' : 'false';
        echo PHP_EOL;
    }
}

