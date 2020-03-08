<?php


namespace ThingsMobilePHP\Remote\Endpoint;


use ThingsMobilePHP\Remote\Endpoint;

class Sim extends Endpoint
{
  private function getSimAuthArray(\ThingsMobilePHP\Models\Sim $sim) : array
  {
    $arr = $this->getAuthArray();
    if ($sim->hasUpdatedProperty('msisdn'))
    {
      $arr['msisdn'] = $sim->getMsisdn();
    }
    else if ($sim->hasUpdatedProperty('iccid'))
    {
      $arr['iccid'] = $sim->getIccid();
    }
    else
    {
      // TODO: no auth provided, so throw exception
    }
    return $arr;
  }

  public function activate(\ThingsMobilePHP\Models\Sim $sim) : bool
  {
    $client = $this->getHttpClient();
    $body = $this->getAuthArray();
    $body['msisdn'] = $sim->getMsisdn();
    $body['simBarcode'] = $sim->getIccid();
    $req = $client->request('POST', $this->client->getApiBaseUrl() . 'activateSim', [
      'form_params' => $body
    ]);
    return $this->parseNoneDataXml($req->getBody());
  }

  public function block(\ThingsMobilePHP\Models\Sim $sim) : bool
  {
    $client = $this->getHttpClient();
    $body = $this->getSimAuthArray($sim);
    $req = $client->request('POST', $this->client->getApiBaseUrl() . 'blockSim', [
      'form_params' => $body
    ]);
    return $this->parseNoneDataXml($req->getBody());
  }

  public function unblock(\ThingsMobilePHP\Models\Sim $sim) : bool
  {
    $client = $this->getHttpClient();
    $body = $this->getSimAuthArray($sim);
    $req = $client->request('POST', $this->client->getApiBaseUrl() . 'unblockSim', [
      'form_params' => $body
    ]);
    return $this->parseNoneDataXml($req->getBody());
  }

  public function status(\ThingsMobilePHP\Models\Sim $sim) : \ThingsMobilePHP\Models\Sim
  {

  }

  public function list($search=[]) : array // search for name or tag
  {

  }

  public function update(\ThingsMobilePHP\Models\Sim $sim) : bool
  {
    // will combine 3.8 [name update], 3.9 [tag update], 3.10 [expiration date], 3.11 [traffic threshold], 3.15 [associate plan] API endpoints if the associated parameter is modified
  }

}