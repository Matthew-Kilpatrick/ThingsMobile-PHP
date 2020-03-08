<?php


namespace ThingsMobilePHP;


use ThingsMobilePHP\Remote\Endpoint\Sim;

class Client
{
  /**
   * @var string Username
   */
  private $username;
  /**
   * @var string Token
   */
  private $token;
  /**
   * @var string API Environment
   */
  private $environment;

  /**
   * Client constructor.
   * @param $username
   * @param $token
   * @param string $environment Environment to connect to (dev/prod)
   */
  public function __construct(string $username, string $token, string $environment='prod')
  {
    $this->username = $username;
    $this->token = $token;
    $this->environment = $environment;
  }

  /**
   * Get base URL to API
   * @return string API base URL
   */
  public function getApiBaseUrl() {
    return 'https://' . (($this->environment == 'dev') ? 'coll' : 'www') . '.thingsmobile.com/services/business-api/';
  }

  /**
   * @return string
   */
  public function getUsername() : string
  {
    return $this->username;
  }

  /**
   * @return string
   */
  public function getToken() : string
  {
    return $this->token;
  }

  /**
   * @return Sim SIM endpoints for API
   */
  public function sim() : Sim
  {
    return new Sim($this);
  }
}