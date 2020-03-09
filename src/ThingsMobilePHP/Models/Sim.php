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
  /**
   * @var DateTime
   */
  private $activationDate;
  /**
   * @var int
   */
  private $balance;
  /**
   * @var bool Whether to block sim after expiration date
   */
  private $blockSimAfterExpirationDate;
  /**
   * @var bool Whether to block sim after exceeding daily traffic threshold
   */
  private $blockSimDaily;
  /**
   * @var bool Whether to block sim after exceeding monthly traffic threshold
   */
  private $blockSimMonthly;
  /**
   * @var bool Whether to block sim after exceeding total traffic threshold
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
   * @var DateTime When SIM card expires
   */
  private $expirationDate;
  /**
   * @var DateTime When SIM card last connected to network
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

  /**
   * @return mixed
   */
  public function getActivationDate()
  {
    return $this->activationDate;
  }

  /**
   * @param mixed $activationDate
   * @return Sim
   */
  public function setActivationDate($activationDate): self
  {
    $this->activationDate = $activationDate;
    return $this;
  }

  /**
   * @return int
   */
  public function getBalance(): int
  {
    return $this->balance;
  }

  /**
   * @param int $balance
   * @return Sim
   */
  public function setBalance(int $balance): self
  {
    $this->balance = $balance;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getBlockSimAfterExpirationDate() : bool
  {
    return $this->blockSimAfterExpirationDate;
  }

  /**
   * @param mixed $blockSimAfterExpirationDate
   * @return Sim
   */
  public function setBlockSimAfterExpirationDate(bool $blockSimAfterExpirationDate): self
  {
    $this->blockSimAfterExpirationDate = $blockSimAfterExpirationDate;
    $this->updateProperty('blockSimAfterExpirationDate', $blockSimAfterExpirationDate);
    return $this;
  }

  /**
   * @return mixed
   */
  public function getBlockSimDaily() : bool
  {
    return $this->blockSimDaily;
  }

  /**
   * @param mixed $blockSimDaily
   * @return Sim
   */
  public function setBlockSimDaily(bool $blockSimDaily): self
  {
    $this->blockSimDaily = $blockSimDaily;
    $this->updateProperty('blockSimDaily', $blockSimDaily);
    return $this;
  }

  /**
   * @return mixed
   */
  public function getBlockSimMonthly() : bool
  {
    return $this->blockSimMonthly;
  }

  /**
   * @param mixed $blockSimMonthly
   * @return Sim
   */
  public function setBlockSimMonthly(bool $blockSimMonthly): self
  {
    $this->blockSimMonthly = $blockSimMonthly;
    $this->updateProperty('blockSimMonthly', $blockSimMonthly);
    return $this;
  }

  /**
   * @return mixed
   */
  public function getBlockSimTotal() : bool
  {
    return $this->blockSimTotal;
  }

  /**
   * @param mixed $blockSimTotal
   * @return Sim
   */
  public function setBlockSimTotal(bool $blockSimTotal): self
  {
    $this->blockSimTotal = $blockSimTotal;
    $this->updateProperty('blockSimTotal', $blockSimTotal);
    return $this;
  }

  /**
   * @return int
   */
  public function getDailyTraffic(): int
  {
    return $this->dailyTraffic;
  }

  /**
   * @param int $dailyTraffic
   * @return Sim
   */
  public function setDailyTraffic(int $dailyTraffic): self
  {
    $this->dailyTraffic = $dailyTraffic;
    return $this;
  }

  /**
   * @return int
   */
  public function getDailyTrafficThreshold(): int
  {
    return $this->dailyTrafficThreshold;
  }

  /**
   * @param int $dailyTrafficThreshold
   * @return Sim
   */
  public function setDailyTrafficThreshold(int $dailyTrafficThreshold): self
  {
    $this->dailyTrafficThreshold = $dailyTrafficThreshold;
    $this->updateProperty('dailyTrafficThreshold', $dailyTrafficThreshold);
    return $this;
  }

  /**
   * @return \DateTime
   */
  public function getExpirationDate(): \DateTime
  {
    return $this->expirationDate;
  }

  /**
   * @param \DateTime $expirationDate
   * @return Sim
   */
  public function setExpirationDate(\DateTime $expirationDate): self
  {
    $this->expirationDate = $expirationDate;
    $this->updateProperty('expirationDate', $expirationDate);
    return $this;
  }

  /**
   * @return \DateTime
   */
  public function getLastConnectionDate(): \DateTime
  {
    return $this->lastConnectionDate;
  }

  /**
   * @param \DateTime $lastConnectionDate
   * @return Sim
   */
  public function setLastConnectionDate(\DateTime $lastConnectionDate): self
  {
    $this->lastConnectionDate = $lastConnectionDate;
    return $this;
  }

  /**
   * @return int
   */
  public function getMonthlyTraffic(): int
  {
    return $this->monthlyTraffic;
  }

  /**
   * @param int $monthlyTraffic
   * @return Sim
   */
  public function setMonthlyTraffic(int $monthlyTraffic): self
  {
    $this->monthlyTraffic = $monthlyTraffic;
    return $this;
  }

  /**
   * @return int
   */
  public function getMonthlyTrafficThreshold(): int
  {
    return $this->monthlyTrafficThreshold;
  }

  /**
   * @param int $monthlyTrafficThreshold
   * @return Sim
   */
  public function setMonthlyTrafficThreshold(int $monthlyTrafficThreshold): self
  {
    $this->monthlyTrafficThreshold = $monthlyTrafficThreshold;
    $this->updateProperty('monthlyTrafficThreshold', $monthlyTrafficThreshold);
    return $this;
  }

  /**
   * @return string
   */
  public function getName(): string
  {
    return $this->name;
  }

  /**
   * @param string $name
   * @return Sim
   */
  public function setName(string $name): self
  {
    $this->name = $name;
    $this->updateProperty('name', $name);
    return $this;
  }

  /**
   * @return string
   */
  public function getPlan(): string
  {
    return $this->plan;
  }

  /**
   * @param string $plan
   * @return Sim
   */
  public function setPlan(string $plan): self
  {
    $this->plan = $plan;
    return $this;
  }

  /**
   * @return bool
   */
  public function isStatus(): bool
  {
    return $this->status;
  }

  /**
   * @param bool $status
   * @return Sim
   */
  public function setStatus(bool $status): self
  {
    $this->status = $status;
    return $this;
  }

  /**
   * @return string
   */
  public function getType(): string
  {
    return $this->type;
  }

  /**
   * @param string $type
   * @return Sim
   */
  public function setType(string $type): self
  {
    $this->type = $type;
    return $this;
  }

  /**
   * @return string
   */
  public function getTag(): string
  {
    return $this->tag;
  }

  /**
   * @param string $tag
   * @return Sim
   */
  public function setTag(string $tag): self
  {
    $this->tag = $tag;
    $this->updateProperty('tag', $tag);
    return $this;
  }

  /**
   * @return int
   */
  public function getTotalTraffic(): int
  {
    return $this->totalTraffic;
  }

  /**
   * @param int $totalTraffic
   * @return Sim
   */
  public function setTotalTraffic(int $totalTraffic): self
  {
    $this->totalTraffic = $totalTraffic;
    return $this;
  }

  /**
   * @return int
   */
  public function getTotalTrafficThreshold(): int
  {
    return $this->totalTrafficThreshold;
  }

  /**
   * @param int $totalTrafficThreshold
   * @return Sim
   */
  public function setTotalTrafficThreshold(int $totalTrafficThreshold): self
  {
    $this->totalTrafficThreshold = $totalTrafficThreshold;
    $this->updateProperty('totalTrafficThreshold', $totalTrafficThreshold);
    return $this;
  }




}