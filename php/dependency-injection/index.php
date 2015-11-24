<?php

require "music-player.php";

$player = new MusicPlayer("jazz.mp3");

$player->play();

$player->setTrack("blues.mp3");

$player->play();
