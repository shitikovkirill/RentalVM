<?php
/**
 * Create dependencies fo injection to app
 */
error_reporting(-1);
ini_set('display_errors', 'On');

$twig   = require_once __DIR__.'/twig.php';
$sqlite = require_once __DIR__.'/sqlite.php';

return [
    'template' => $twig,
    'db' => $sqlite,
];