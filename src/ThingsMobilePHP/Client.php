<?php


namespace ThingsMobilePHP;


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
  private function getApiBaseUrl() {
    return 'https://' + $this->environment == 'dev' ? 'coll' : 'www' + '.thingsmobile.com/services/business-api/';
  }
}