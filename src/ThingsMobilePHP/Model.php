<?php


namespace ThingsMobilePHP;


class Model
{
  /**
   * @var array Changed properties to submit to API
   */
  private $updatedProperties = [];

  /**
   * @param string $key Key of property to update
   * @param mixed $value New value of property
   */
  public function updateProperty(string $key, $value) : void
  {
    $this->updatedProperties[$key] = $value;
  }

  /**
   * @param string $key Key to check for
   * @return bool Whether specified key exists
   */
  public function hasUpdatedProperty(string $key) : bool
  {
    return isset($this->updatedProperties[$key]);
  }

  /**
   * @param string $key Key of property to unset
   */
  public function unsetUpdatedProperty(string $key) : void
  {
    if ($this->hasUpdatedProperty($key)) {
      unset($this->updatedProperties[$key]);
    }
  }

  /**
   * Unset all updated properties
   */
  public function unsetAllUpdatedProperty() : void
  {
    $this->updatedProperties = [];
  }
}