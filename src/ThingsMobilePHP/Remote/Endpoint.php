<?php


namespace ThingsMobilePHP\Remote;


use ThingsMobilePHP\Client;
use ThingsMobilePHP\Remote\Exception\GenericErrorException;
use ThingsMobilePHP\Remote\Exception\InputErrorException;
use ThingsMobilePHP\Remote\Exception\SharedCreditAccountErrorException;
use ThingsMobilePHP\Remote\Exception\SimErrorException;
use ThingsMobilePHP\Remote\Exception\TooManyRequestsException;
use ThingsMobilePHP\Remote\Exception\UserErrorException;

class Endpoint
{
  /**
   * @var Client
   */
  protected $client;
  /**
   * Model constructor.
   * @param Client $client
   */
  public function __construct(Client $client)
  {
    $this->client = $client;
  }

  /**
   * @return Client
   */
  protected function getHttpClient() : \GuzzleHttp\Client
  {
    $client = new \GuzzleHttp\Client();
    return $client;
  }

  /**
   * @return array POST body for authentication
   */
  protected function getAuthArray() : array
  {
    return [
      'username' => $this->client->getUsername(),
      'token' => $this->client->getToken()
    ];
  }

  /**
   * @param int $errorCode Error code of exception to throw
   * @param string $errorMessage Message of error
   */
  protected function throwException(int $errorCode, string $errorMessage) : void
  {
    switch ($errorCode) {
      case 10:
        throw new GenericErrorException($errorMessage);
      case 20:
        throw new InputErrorException($errorMessage);
      case 30:
        throw new UserErrorException($errorMessage);
      case 40:
        throw new SimErrorException($errorMessage);
      case 50:
        throw new SharedCreditAccountErrorException($errorMessage);
      case 60:
        throw new TooManyRequestsException($errorMessage);
    }
  }

  /**
   * Parse XML simple endpoint (no data, only 'done') to determine if action successful
   * @param string $response
   * @return bool
   * @throws GenericErrorException
   * @throws InputErrorException
   * @throws SharedCreditAccountErrorException
   * @throws SimErrorException
   * @throws TooManyRequestsException
   * @throws UserErrorException
   */
  protected function parseNoneDataXml(string $response) : bool
  {
    $xml = simplexml_load_string($response);
    if ($xml->done == 'true') {
      return true;
    } else {
      $this->throwException((int)$xml->errorCode, (string)$xml->errorMessage);
    }
    return false;
  }
}