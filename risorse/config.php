<?php
ob_start();
session_start();

ini_set('memory_limit', '128M');

require_once("funzioni.php");

defined('FRONT_END') ? null : define('FRONT_END', __DIR__ . '/templates/front');
defined('BACK_END') ? null : define('BACK_END', __DIR__ . '/templates/back');
