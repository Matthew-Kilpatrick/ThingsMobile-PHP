<?php


namespace ThingsMobilePHP\Remote\Endpoint;


use ThingsMobilePHP\Exception\SmsTooLongException;
use ThingsMobilePHP\Remote\Endpoint;

class Sms extends Endpoint
{
  /**
   * Send a SMS message to specified number
   * @param \ThingsMobilePHP\Models\Sim $sim
   * @param string $message
   * @return bool Whether SMS was sent successfully
   */
  public function send(\ThingsMobilePHP\Models\Sim $sim, string $message) : bool
  {
    if (strlen($message) > 160) {
      throw new SmsTooLongException();
    }
    $client = $this->getHttpClient();
    $body = $this->getSimGuzzleParams($sim);
    $body['form_params']['message'] = $message;
    $req = $client->request('POST', $this->client->getApiBaseUrl() . 'sendSms', $body);
    return $this->parseNoneDataXml($req->getBody());
  }
}