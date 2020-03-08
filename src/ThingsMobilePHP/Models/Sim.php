<?php


namespace ThingsMobilePHP\Models;


use ThingsMobilePHP\Model;

class Sim extends Model
{
  /**
   * @var string SIM number
   */
  private $msisdn;
  /**
   * @var string SIM ICCID (19 or 20 digits)
   */
  private $iccid;
  private $activationDate;
  /**
   * @var int
   */
  private $balance;
  /**
   * @var
   */
  private $blockSimAfterExpirationDate;
  /**
   * @var
   */
  private $blockSimDaily;
  /**
   * @var
   */
  private $blockSimMonthly;
  /**
   * @var
   */
  private $blockSimTotal;
  /**
   * @var int Daily traffic usage in bytes
   */
  private $dailyTraffic;
  /**
   * @var int Daily traffic threshold in bytes
   */
  private $dailyTrafficThreshold;
  /**
   * @var \DateTime When SIM card expires
   */
  private $expirationDate;
  /**
   * @var \DateTime When SIM card last connected to network
   */
  private $lastConnectionDate;
  /**
   * @var int Monthly traffic usage in bytes
   */
  private $monthlyTraffic;
  /**
   * @var int Monthly traffic usage threshold in bytes
   */
  private $monthlyTrafficThreshold;
  /**
   * @var string
   */
  private $name;
  /**
   * @var string
   */
  private $plan;
  /**
   * @var bool Whether sim is active (1) or not (0)
   */
  private $status;
  /**
   * @var string SIM card type
   */
  private $type;
  /**
   * @var string
   */
  private $tag;
  /**
   * @var int Total traffic usage in bytes
   */
  private $totalTraffic;
  /**
   * @var int Total traffic usage threshold in bytes
   */
  private $totalTrafficThreshold;
  // TODO: CDRs

  /**
   * @return string MSISDN of sim card
   */
  public function getMsisdn() : string
  {
    return $this->msisdn;
  }

  /**
   * @param string $msisdn
   * @return Sim
   */
  public function setMsisdn(string $msisdn) : self
  {
    $this->msisdn = $msisdn;
    $this->updateProperty('msisdn', $msisdn);
    return $this;
  }

  /**
   * @return string ICCID of sim
   */
  public function getIccid() : string
  {
    return $this->iccid;
  }

  /**
   * @param string $iccid
   * @return Sim
   */
  public function setIccid(string $iccid) : self
  {
    $this->iccid = $iccid;
    $this->updateProperty('iccid', $iccid);
    return $this;
  }



}