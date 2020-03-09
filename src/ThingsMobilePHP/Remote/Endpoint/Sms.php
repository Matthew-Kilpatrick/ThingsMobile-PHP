<?php


namespace ThingsMobilePHP\Remote\Endpoint;


use ThingsMobilePHP\Remote\Endpoint;

class Sms extends Endpoint
{
  /**
   * Send a SMS message to specified number
   * @param \ThingsMobilePHP\Models\Sim $sim
   * @param string $message
   * @return bool
   */
  public function send(\ThingsMobilePHP\Models\Sim $sim, string $message) : bool
  {
    // TODO: limit message to 160 chars
    $client = $this->getHttpClient();
    $body = $this->getSimGuzzleParams($sim);
    $body['form_params']['message'] = $message;
    $req = $client->request('POST', $this->client->getApiBaseUrl() . 'sendSms', $body);
    return $this->parseNoneDataXml($req->getBody());
  }
}