<?php

use Core\Config as Config;

function config(string $data) {
  $payload = explode('.', $data);

  $state = new Config($payload[0], $payload[1]);
  return $state->get();
}