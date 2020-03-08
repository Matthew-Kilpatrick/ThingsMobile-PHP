<?php


namespace ThingsMobilePHP;


class Model
{
  /**
   * @var Client
   */
  private $client;
  /**
   * @var array Changed properties to submit to API
   */
  private $updatedProperties = [];

  /**x
   * Model constructor.
   * @param Client $client
   */
  public function __construct(Client $client)
  {
    $this->client = $client;
  }

  /**
   * @param string $key Key of property to update
   * @param mixed $value New value of property
   */
  public function updateProperty(string $key, $value)
  {
    $this->updatedProperties[$key] = $value;
  }
}