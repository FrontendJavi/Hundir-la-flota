<?php

require_once 'player.php';
require_once 'turn.php';

$player1 = new player("Pepebot");
$player2 = new player("Jorgebot");

$game = new turn(10, $player1, $player2);
$game->play();
echo "<br>Jugador ganador : " . $game->getWinner();
echo "<br><br>ESTADÍSTICAS: <br><br>";
echo "Jugador " . $player1->getName() . ": " . $player1->getSunks() . "H, " . $player1->getDamaged() . "T, " . $player1->getWaters() . "A";
echo "<br>";
echo "Jugador " . $player2->getName() . ": " . $player2->getSunks() . "H, " . $player2->getDamaged() . "T, " . $player2->getWaters() . "A";   