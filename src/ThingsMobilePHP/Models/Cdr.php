<?php


namespace ThingsMobilePHP\Models;


class Cdr
{
  /**
   * @var string
   */
  private $country;
  /**
   * @var \DateTime
   */
  private $startDate;
  /**
   * @var \DateTime
   */
  private $endDate;
  /**
   * @var int
   */
  private $imsi;
  /**
   * @var string
   */
  private $network;
  /**
   * @var string
   */
  private $operator;
  /**
   * @var int
   */
  private $traffic;

  /**
   * @return string
   */
  public function getCountry() : string
  {
    return $this->country;
  }

  /**
   * @param string $country
   * @return Cdr
   */
  public function setCountry(string $country) : self
  {
    $this->country = $country;
    return $this;
  }

  /**
   * @return \DateTime
   */
  public function getStartDate() : \DateTime
  {
    return $this->startDate;
  }

  /**
   * @param \DateTime $date
   * @return Cdr
   */
  public function setStartDate(\DateTime $date) : self
  {
    $this->startDate = $date;
    return $this;
  }

  /**
   * @return \DateTime
   */
  public function getEndDate() : \DateTime
  {
    return $this->endDate;
  }

  /**
   * @param \DateTime $date
   * @return Cdr
   */
  public function setEndDate(\DateTime $date) : self
  {
    $this->endDate = $date;
    return $this;
  }

  /**
   * @return int
   */
  public function getImsi() : int
  {
    return $this->imsi;
  }

  /**
   * @param int $imsi
   * @return Cdr
   */
  public function setImsi(int $imsi) : self
  {
    $this->imsi = $imsi;
    return $this;
  }

  /**
   * @return string
   */
  public function getNetwork() : string
  {
    return $this->network;
  }

  /**
   * @param string $network
   * @return Cdr
   */
  public function setNetwork(string $network) : self
  {
    $this->network = $network;
    return $this;
  }

  /**
   * @return string
   */
  public function getOperator() : string
  {
    return $this->operator;
  }

  /**
   * @param string $operator
   * @return Cdr
   */
  public function setOperator(string $operator) : self
  {
    $this->operator = $operator;
    return $this;
  }

  /**
   * @return int
   */
  public function getTraffic() : int
  {
    return $this->traffic;
  }

  /**
   * @param int $traffic
   * @return Cdr
   */
  public function setTraffic(int $traffic) : self
  {
    $this->traffic = $traffic;
    return $this;
  }
}