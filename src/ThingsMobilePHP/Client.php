<?php


namespace ThingsMobilePHP;


use ThingsMobilePHP\Remote\Endpoint\Sim;
use ThingsMobilePHP\Remote\Endpoint\Sms;

class Client
{
  const ENVIRONMENT_PRODUCTION = 'www';
  const ENVIRONMENT_DEVELOPMENT = 'coll';
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
  public function __construct(string $username, string $token, string $environment=self::ENVIRONMENT_PRODUCTION)
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
    return 'https://' . $this->environment . '.thingsmobile.com/services/business-api/';
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
   * @return string
   */
  public function getEnvironment() : string
  {
    return $this->environment;
  }

  /**
   * @return Sim SIM endpoints for API
   */
  public function sim() : Sim
  {
    return new Sim($this);
  }

  /**
   * @return Sms SMS endpoint for API
   */
  public function sms() : Sms
  {
    return new Sms($this);
  }
}