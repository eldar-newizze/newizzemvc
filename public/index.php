<?php
/**
 * @version php 7.3
 */

require_once __DIR__ . '/../' . 'vendor/autoload.php';

new Core\App();

ini_set('display_errors', env('APP_DEBUG'));
