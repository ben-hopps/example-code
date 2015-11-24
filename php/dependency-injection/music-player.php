<?php

class musicPlayer {
	private $track;

	public function __construct($track) {
		$this->track = $track;
	}
	
	public function setTrack($track) {
		$this->track = $track;
	}
	
	public function play() {
		echo "playing file ".$this->track."\n";
	}
}
