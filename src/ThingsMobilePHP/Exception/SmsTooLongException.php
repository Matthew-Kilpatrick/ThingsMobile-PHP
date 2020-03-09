<?php


namespace ThingsMobilePHP\Exception;


class SmsTooLongException extends \Exception
{
  protected $message = 'SMS exceeds 160 characters';
}