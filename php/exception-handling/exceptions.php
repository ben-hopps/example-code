<?php

class notGpsCoord extends Exception {}
class outOfBoundsCoord extends Exception {}

function drawPoint($p) {
	if(is_string($p))
		throw new notGpsCoord("Invalid GPS coord. Must be number.\n");

	if($p > 100000)
		throw new outOfBoundsCoord("Invalid GPS coord. Too great.\n");
}

try {
	//drawPoint(100001);
	drawPoint('foo');
} catch(notGpsCoord $e) {
	echo $e->getMessage();
} catch(outOfBoundsCoord $e) {
	echo $e->getMessage();
}
