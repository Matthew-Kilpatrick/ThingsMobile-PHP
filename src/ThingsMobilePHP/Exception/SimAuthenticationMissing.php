<?php


namespace ThingsMobilePHP\Exception;


class SimAuthenticationMissing extends \Exception
{
  protected $message = 'SIM ICCID or MSISDN must be provided';
}