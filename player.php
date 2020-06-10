<?php
include 'boat.php';
include 'square.php';
class player
{
  private $name;
  private $board;
  private $boats;
  private $xAxisLabel;
  private $yAxisLabel;

  public function __construct($name)
  {
    $this->name = $name;
    $this->board = array();
    $this->xAxisLabel = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J");
    $this->yAxisLabel = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "10");
    $this->initShips();
    $this->initSquares();
    $this->putRandomShips();
  }

  function getName()
  {
    return $this->name;
  }

  function getBoard()
  {
    return $this->board;
  }

  function getBoats()
  {
    return $this->boats;
  }

  function getShoot($X, $Y)
  {
    if ($this->board[$X][$Y]->getWasAttacked()) 
    {
      return false;
    }
    echo "Disparo: Casilla(" . $this->xAxisLabel[$X] . ", " . $this->yAxisLabel[$Y] . ")<br>";
    if ($this->board[$X][$Y]->getUnderShip()) 
    {
      $index = $this->getIndexedShip($this->board[$X][$Y]->getInitialShip());
      $this->boats[$index]->hit($this->board[$X][$Y]->getPositionShip());

      if ($this->boats[$index]->getIsSunk()) 
      {
        echo "Resultado: Hundido<br>";
      } 
      else 
      {
        echo "Resultado: Tocado<br>";
      }
    } 
    else 
    {
      echo "Resultado: Agua<br>";
    }

    $this->board[$X][$Y]->setWasAttacked();

    return true;
  }

  function Shoot($player)
  {
    do 
    {
      $X = random_int(0, 9);
      $Y = random_int(0, 9);
    } while (!$player->getShoot($X, $Y));
  }

  function getIndexedShip($ini)
  {
    if ($ini == "D") 
    {
      return 0;
    }

    if ($ini == "S") 
    {
      return 1;
    }

    if ($ini == "P") 
    {
      return 2;
    }
  }

  function setName($name)
  {
    $this->name = $name;
  }

  public function initSquares()
  {
    for ($i = 0; $i < 10; $i++) 
    {
      for ($j = 0; $j < 10; $j++) 
      {
        $this->board[$i][$j] = new square();
      }
    }
  }

  public function initShips()
  {
    $this->boats[0] = new boat("Destructor", "D", 2);
    $this->boats[1] = new boat("Submarino", "S", 3);
    $this->boats[2] = new boat("Portaviones", "P", 4);
  }

  public function putRandomShips()
  {
    $index = 0;
    while ($index < 3) 
    {
      $X = random_int(0, 9);
      $Y = random_int(0, 9);
      if (random_int(0, 1) == 1) 
      {
        $X = random_int(0, 9 - $this->boats[$index]->getSize());
        $orientation = "horizontal";
      } 
      else 
      {
        $Y = random_int(0, 9 - $this->boats[$index]->getSize());
        $orientation = "vertical";
      }
      if ($this->placeShips($X, $Y, $this->boats[$index], $orientation)) 
      {
        $index++;
      }
    }
  }

  public function placeShips($xAxisLabel, $yAxisLabel, $boat, $orientation)
  {
    for ($i = 0; $i < $boat->getSize(); $i++) 
    {
      if ($orientation == "horizontal") 
      {
        if ($this->board[$xAxisLabel + $i][$yAxisLabel]->getUnderShip()) 
        {
          return false;
        }
      }
      else 
      {
        if ($this->board[$xAxisLabel][$yAxisLabel + $i]->getUnderShip()) 
        {
          return false;
        }
      }
    }

    for ($i = 0; $i < $boat->getSize(); $i++) 
    {
      if ($orientation == "horizontal") 
      {
        $this->board[$xAxisLabel + $i][$yAxisLabel]->setUnderShip($boat->getInitial(), $i);
      } 
      else 
      {
        $this->board[$xAxisLabel][$yAxisLabel + $i]->setUnderShip($boat->getInitial(), $i);
      }
    }

    return true;
  }

  function getSunks()
  {
    $c = 0;
    if ($this->boats[0]->getIsSunk()) 
    {
      $c++;
    }
    if ($this->boats[1]->getIsSunk()) 
    {
      $c++;
    }
    if ($this->boats[2]->getIsSunk()) 
    {
      $c++;
    }
    return $c;
  }

  function getDamaged()
  {
    $count = 0;
    for ($i = 0; $i < 3; $i++) 
    {
      for ($j = 0; $j < $this->boats[$i]->getSize(); $j++) 
      {
        if ($this->boats[$i]->getIsHit()[$j]) 
        {
          $count++;
        }
      }
    }
    return $count;
  }

  function getWaters()
  {
    $count = 0; 
    for ($i=0; $i < 10 ; $i++) 
    { 
      for ($j=0; $j < 10; $j++) 
      { 
        if($this->board[$i][$j]->getWasAttacked() && !$this->board[$i][$j]->getUnderShip()) 
        {
          $count++;
        }
      }
    }
    return $count;
  }
}
