<?php


namespace ThingsMobilePHP\Remote\Exception;


class TooManyRequestsException extends \Exception
{
  protected $code = 60;
}