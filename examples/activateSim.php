<?php
  // Include composer libraries (path may vary)
  require('vendor/autoload.php');
  // Create client instance with credentials (included are credentials for the sandbox API)
  $client = new \ThingsMobilePHP\Client(
    'TMTEST',
    '91c6ce3c-a848-4f0e-bfca-ab9eeff5d1e6',
    \ThingsMobilePHP\Client::ENVIRONMENT_DEVELOPMENT
  );
  // Create new valid sim (MSISDN from API documentation)
  $sim = new \ThingsMobilePHP\Models\Sim();
  $sim->setMsisdn('882360000000004');
  // Send request to API to activate SIM
  if ($client->sim()->activate($sim)) {
    echo 'Sim successfully activated';
  }