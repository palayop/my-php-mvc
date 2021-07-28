<?php

require_once 'Config/config.php';

session_name('demomvc');
session_start();

use Palayop\Demomvc\Core\App;

$app = new App();