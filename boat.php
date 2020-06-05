<?php
class boat
{
  private $name;
  private $initial; 
  private $size;
  private $isHit;
  private $isSunk;

  public function __construct($name, $initial, $size)
  {
    $this->name = $name;
    $this->initial = $initial; 
    $this->size = $size;
    $this->isHit = array($size);
    for ($i=0; $i < $size ; $i++) 
    { 
     $this->isHit[$i] = false; 
    }
    $this->isSunk = false;
  }

  public function getName()
  {
    return $this->name; 
  }

  public function getSize()
  {
    return $this->size;
  }

  public function getInitial()
  {
    return $this->initial;
  }

  public function getIsHit()
  {
    return $this->isHit;
  }

  public function getIsSunk()
  {
    for ($i=0; $i < $this->size ; $i++) 
    { 
      if (!$this->isHit[$i]) 
      {
        return false; 
      }
    }
    return true; 
  }

  public function hit($position)
  {
    $this->isHit[$position] = true;
  }
}
?>