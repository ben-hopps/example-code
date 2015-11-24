<?php

require 'shape.php';

function getPrice(shape $shape) {
	return $shape->getArea() * 0.25;
}

$rect = new rect(5, 7);
$circ = new circle(5);

echo getPrice($rect)."\n";
echo getPrice($circ)."\n";
