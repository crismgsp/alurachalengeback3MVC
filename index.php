<?php
session_start();

ob_start();

require './vendor/autoload.php';

$home = new Core\ConfigController();
$home->loadPage();
