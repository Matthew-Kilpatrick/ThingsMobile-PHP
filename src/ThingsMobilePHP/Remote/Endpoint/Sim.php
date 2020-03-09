<?php


namespace ThingsMobilePHP\Remote\Endpoint;


use ThingsMobilePHP\Remote\Endpoint;

class Sim extends Endpoint
{
  /**
   * Get authentication (username+token) and SIM details (msisdn or iccid) array for making requests
   * @param \ThingsMobilePHP\Models\Sim $sim
   * @return array
   */
  private function getSimGuzzleParams(\ThingsMobilePHP\Models\Sim $sim) : array
  {
    $arr = $this->getGuzzleParams();
    if ($sim->hasUpdatedProperty('msisdn'))
    {
      $arr['form_params']['msisdn'] = $sim->getMsisdn();
    }
    else if ($sim->hasUpdatedProperty('iccid'))
    {
      $arr['form_params']['iccid'] = $sim->getIccid();
    }
    else
    {
      // TODO: no auth provided, so throw exception
    }
    return $arr;
  }

  /**
   * Activate a specified SIM
   * @param \ThingsMobilePHP\Models\Sim $sim Sim card model to activate
   * @return bool Whether activation request was successful
   * @throws \ThingsMobilePHP\Remote\Exception\GenericErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\InputErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\SharedCreditAccountErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\SimErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\TooManyRequestsException
   * @throws \ThingsMobilePHP\Remote\Exception\UserErrorException
   */
  public function activate(\ThingsMobilePHP\Models\Sim $sim) : bool
  {
    $client = $this->getHttpClient();
    $body = $this->getSimGuzzleParams($sim);
    $body['form_params']['msisdn'] = $sim->getMsisdn();
    $body['form_params']['simBarcode'] = $sim->getIccid();
    $req = $client->request('POST', $this->client->getApiBaseUrl() . 'activateSim', $body);
    return $this->parseNoneDataXml($req->getBody());
  }

  /**
   * Block a specified sim card
   * @param \ThingsMobilePHP\Models\Sim $sim SIM card model to block
   * @return bool Whether block request was successful
   * @throws \ThingsMobilePHP\Remote\Exception\GenericErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\InputErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\SharedCreditAccountErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\SimErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\TooManyRequestsException
   * @throws \ThingsMobilePHP\Remote\Exception\UserErrorException
   */
  public function block(\ThingsMobilePHP\Models\Sim $sim) : bool
  {
    $client = $this->getHttpClient();
    $body = $this->getSimGuzzleParams($sim);
    $req = $client->request('POST', $this->client->getApiBaseUrl() . 'blockSim', $body);
    return $this->parseNoneDataXml($req->getBody());
  }

  /**
   * Unblock a specified sim card
   * @param \ThingsMobilePHP\Models\Sim $sim SIM card model to unblock
   * @return bool Whether unblock request was successful
   * @throws \ThingsMobilePHP\Remote\Exception\GenericErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\InputErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\SharedCreditAccountErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\SimErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\TooManyRequestsException
   * @throws \ThingsMobilePHP\Remote\Exception\UserErrorException
   */
  public function unblock(\ThingsMobilePHP\Models\Sim $sim) : bool
  {
    $client = $this->getHttpClient();
    $body = $this->getSimGuzzleParams($sim);
    $req = $client->request('POST', $this->client->getApiBaseUrl() . 'unblockSim', $body);
    return $this->parseNoneDataXml($req->getBody());
  }

  /**
   * Get status of a specified SIM
   * @param \ThingsMobilePHP\Models\Sim $sim Sim model to get status of
   * @return \ThingsMobilePHP\Models\Sim Sim model with all status information
   * @throws \ThingsMobilePHP\Remote\Exception\GenericErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\InputErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\SharedCreditAccountErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\SimErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\TooManyRequestsException
   * @throws \ThingsMobilePHP\Remote\Exception\UserErrorException
   */
  public function status(\ThingsMobilePHP\Models\Sim $sim) : \ThingsMobilePHP\Models\Sim
  {
    $client = $this->getHttpClient();
    $body = $this->getSimGuzzleParams($sim);
    $req = $client->request('POST', $this->client->getApiBaseUrl() . 'simStatus', $body);
    if ($this->parseNoneDataXml($req->getBody()))
    {
      return $this->simModelFromXmlResponse($req->getBody())[0];
    }
  }

  /**
   * List all SIM cards in account matching provided search parameters
   * @param array $search Search parameters for the list method. Usable values are
   *    - name: name of Sim
   *    - tag: tag of Sim
   * @return \ThingsMobilePHP\Models\Sim[]
   * @throws \ThingsMobilePHP\Remote\Exception\GenericErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\InputErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\SharedCreditAccountErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\SimErrorException
   * @throws \ThingsMobilePHP\Remote\Exception\TooManyRequestsException
   * @throws \ThingsMobilePHP\Remote\Exception\UserErrorException
   */
  public function list($search=[]) : array // search for name or tag
  {
    $client = $this->getHttpClient();
    $body = $this->getGuzzleParams();
    if (isset($search['name']))
    {
      $body['form_params']['name'] = $search['name'];
    }
    if (isset($serach['tag']))
    {
      $body['form_params']['tag'] = $search['tag'];
    }
    $req = $client->request('POST', $this->client->getApiBaseUrl() . 'simList', $body);
    if ($this->parseNoneDataXml($req->getBody()))
    {
      return $this->simModelFromXmlResponse($req->getBody());
    }
  }

  /**
   * @param \ThingsMobilePHP\Models\Sim $sim
   * @return bool
   */
  public function update(\ThingsMobilePHP\Models\Sim $sim) : bool
  {
    // combines 3.8 [name update], 3.9 [tag update], 3.10 [expiration date], 3.11 [traffic threshold],
    // 3.15 [associate plan] API endpoints if the associated parameter is modified
    $client = $this->getHttpClient();
    // Update SIM name if changed
    if ($sim->hasUpdatedProperty('name'))
    {
      $body = $this->getSimGuzzleParams($sim);
      $body['form_params']['name'] = $sim->getName();
      $req = $client->request('POST', $this->client->getApiBaseUrl() . 'updateSimName', $body);
      if ($this->parseNoneDataXml($req->getBody()))
      {
        $sim->unsetUpdatedProperty('name');
      }
    }
    // Update tag if changed
    if ($sim->hasUpdatedProperty('tag'))
    {
      $body = $this->getSimGuzzleParams($sim);
      $body['form_params']['tag'] = $sim->getTag();
      $req = $client->request('POST', $this->client->getApiBaseUrl() . 'updateSimTag', $body);
      if ($this->parseNoneDataXml($req->getBody()))
      {
        $sim->unsetUpdatedProperty('tag');
      }
    }
    // Update sim expiration date if changed
    if ($sim->hasUpdatedProperty('expirationDate') || $sim->hasUpdatedProperty('blockSimAfterExpirationDate'))
    {
      $body = $this->getSimGuzzleParams($sim);
      $body['form_params']['expirationDate'] = $sim->getExpirationDate()->format('Y-m-d');
      $body['form_params']['blockSim'] = $sim->getBlockSimAfterExpirationDate() ? 1 : 0;
      $req = $client->request('POST', $this->client->getApiBaseUrl() . 'setupSimExpirationDate', $body);
      if ($this->parseNoneDataXml($req->getBody()))
      {
        $sim->unsetUpdatedProperty('expirationDate');
        $sim->unsetUpdatedProperty('blockSimAfterExpirationDate');
      }
    }
    // Update sim traffic threshold data if changed
    if (
      $sim->hasUpdatedProperty('dailyTrafficThreshold') ||
      $sim->hasUpdatedProperty('blockSimDaily') ||
      $sim->hasUpdatedProperty('monthlyTrafficThreshold') ||
      $sim->hasUpdatedProperty('blockSimMonthly') ||
      $sim->hasUpdatedProperty('totalTrafficThreshold') ||
      $sim->hasUpdatedProperty('blockSimTotal')
    )
    {
      $body = $this->getSimGuzzleParams($sim);
      $body['form_params']['dailyLimit'] = $sim->getDailyTrafficThreshold();
      $body['form_params']['blockSimDaily'] = $sim->getBlockSimDaily() ? 1 : 0;
      $body['form_params']['monthlyLimit'] = $sim->getMonthlyTrafficThreshold();
      $body['form_params']['blockSimMonthly'] = $sim->getBlockSimMonthly() ? 1 : 0;
      $body['form_params']['totalLimit'] = $sim->getTotalTrafficThreshold();
      $body['form_params']['blockSimTotal'] = $sim->getBlockSimTotal() ? 1 : 0;
      $req = $client->request('POST', $this->client->getApiBaseUrl() . 'setupSimTrafficThreshold', $body);
      if ($this->parseNoneDataXml($req->getBody()))
      {
        $sim->unsetUpdatedProperty('dailyTrafficThreshold');
        $sim->unsetUpdatedProperty('blockSimDaily');
        $sim->unsetUpdatedProperty('monthlyTrafficThreshold');
        $sim->unsetUpdatedProperty('blockSimMonthly');
        $sim->unsetUpdatedProperty('totalTrafficThreshold');
        $sim->unsetUpdatedProperty('blockSimTotal');
      }
    }
    return true;
  }

  /**
   * @param string $response HTTP response body
   * @return \ThingsMobilePHP\Models\Sim[] Array of Sim objects
   * @throws \Exception
   */
  private function simModelFromXmlResponse($response) : array
  {
    $sims = [];
    $xml = simplexml_load_string($response);
    foreach ($xml->sims as $simData) {
      $simData = $simData->sim;
      $sim = new \ThingsMobilePHP\Models\Sim();
      $sim->setActivationDate(new \DateTime((string)$simData->activationDate)) // TODO: if not activated, this is null
        ->setBalance((int)$simData->balance)
        ->setBlockSimAfterExpirationDate((bool)$simData->blockSimAfterExpirationDate)
        ->setBlockSimDaily((bool)$simData->blockSimDaily)
        ->setBlockSimMonthly((bool)$simData->blockSimMonthly)
        ->setBlockSimTotal((bool)$simData->blockSimTotal)
        ->setDailyTraffic((int)$simData->dailyTraffic)
        ->setDailyTrafficThreshold((int)$simData->dailyTrafficThreshold)
        ->setExpirationDate(new \DateTime((string)$simData->expirationDate)) // TODO: if never expires, this is null
        ->setIccid((string)$simData->iccid)
        ->setLastConnectionDate(new \DateTime((string)$simData->lastConnectionDate)) // TODO: if never connected, this is null
        ->setMonthlyTraffic((int)$simData->monthlyTraffic)
        ->setMsisdn((string)$simData->msisdn)
        ->setName((string)$simData->name)
        ->setplan((string)$simData->plan)
        ->setStatus((string)$simData->status == 'active')
        ->setType((string)$simData->type)
        ->setTag((string)$simData->tag)
        ->setTotalTraffic((int)$simData->totalTraffic)
        ->setTotalTrafficThreshold((int)$simData->totalTrafficThreshold);
      $sims[] = $sim;
    }
    return $sims;
  }
}