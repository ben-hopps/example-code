<?php

interface shape {
	public function getArea();
}

class rect implements shape {
	private $width;
	private $height;

	public function __construct($width, $height) {
		$this->width = $width;
		$this->height = $height;
	}

	public function getArea() {
		return $this->width * $this->height;
	}
}

class circle implements shape {
	private $radius;

	public function __construct($radius) {
		$this->radius = $radius;
	}

	public function getArea() {
		return $this->radius * $this->radius * 3.14156;
	}
}
