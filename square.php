<?php
class square
{
  private $under_ship;
  private $was_attacked;
  private $initial_ship;
  private $position_ship;

  public function __construct()
  {
    $this->under_ship = false;
    $this->was_attacked = false; 
  }

  public function getUnderShip()
  {
    return $this->under_ship;
  }

  public function getInitialShip()
  {
    return $this->initial_ship;
  }

  public function getPositionShip()
  {
    return $this->position_ship;
  }

  public function getWasAttacked()
  {
    return $this->was_attacked;
  }

  public function setUnderShip($initial_ship, $position_ship) 
  {
    $this->initial_ship = $initial_ship;
    $this->position_ship = $position_ship;
    $this->under_ship = true; 
  }

  public function setWasAttacked()
  {
    $this->was_attacked = true;
  }
}
?>