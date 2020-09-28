<?php
/**
 * @version php 7.3
 */

session_start();

require_once __DIR__ . '/../' . 'vendor/autoload.php';

new Core\App();

ini_set('display_errors', env('APP_DEBUG'));
