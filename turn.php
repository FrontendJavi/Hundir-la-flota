<?php
require_once 'player.php';
class turn
{
  private $number_of_turns;
  private $game_over;
  private $turn;
  private $player1;
  private $player2;
  private $winner;

  public function __construct($number_of_turns, $player1, $player2)
  {
    $this->number_of_turns = $number_of_turns;
    $this->game_over = false;
    $this->turn = 0;
    $this->player1 = $player1;
    $this->player2 = $player2;
  }

  public function getTurnNumber()
  {
    return $this->number_of_turns;
  }

  public function play()
  {
    while (!$this->game_over) 
    {
      echo "<br>";
      echo "Número del turno: " . ($this->turn + 1) . "<br>";
      echo "Nombre del jugador: " . $this->player1->getName() . "<br>";
      $this->player1->Shoot($this->player2);
      $this->setGameOver();

      echo "<br>";
      if (!$this->game_over) 
      {
        echo "Número del turno: " . ($this->turn + 1) . "<br>";
        echo "Nombre del jugador: " . $this->player2->getName() . "<br>";
        $this->player2->Shoot($this->player1);
        $this->turn++;
        $this->setGameOver();
      }
      echo "<br>";
      echo "-----<br>";
    }
    echo "<br>FIN DE LA PARTIDA<br>";
  }

  public function setGameOver() 
  {
    if ($this->turn == $this->number_of_turns) 
    {
      $this->game_over = true;
    }

    if ($this->player1->getBoats()[0]->getIsSunk() && $this->player1->getBoats()[1]->getIsSunk() && $this->player1->getBoats()[2]->getIsSunk()) 
    {
      $this->game_over = true;
      $this->winner = $this->player2;
    }
    if ($this->player2->getBoats()[0]->getIsSunk() && $this->player2->getBoats()[1]->getIsSunk() && $this->player2->getBoats()[2]->getIsSunk()) 
    {
      $this->game_over = true;
      $this->winner = $this->player1;
    }
  }

  public function getWinner() 
  {
    if ($this->winner != null) 
    {
      return $this->winner;
    }
    if ($this->countShoots($this->player1) > $this->countShoots($this->player2)) 
    {
      $this->winner = $this->player2->getName();
    } 
    else if ($this->countShoots($this->player1) < $this->countShoots($this->player2)) 
    {
      $this->winner = $this->player1->getName();
    } 
    else 
    {
      $this->winner = "Empate";
    }
    return $this->winner;
  }

  public function countShoots($player) 
  {
    $count = 0;

    for ($i = 0; $i < 3; $i++) 
    {
      for ($j = 0; $j < $player->getBoats()[$i]->getSize(); $j++) 
      {
        if ($player->getBoats()[$i]->getIsHit()[$j]) 
        {
          $count++;
        }
      }
    }
    return $count;
  }
}
