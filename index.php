<?php
use Core\Application;

define("BASE_DIR", __DIR__);

try {
    require_once 'vendor/autoload.php';
    $container = require_once __DIR__ . '/config/config.php';

    $application = new Application($container);
    $application->run();
} catch (\Core\Exception\UrlNotFoundException $e){
    echo $container['template']->render('error/404.twig');
} catch (\Exception $e) {
    $message = $e->getMessage() . '<br>';
    $trace = '<pre>' . $e->getTraceAsString() . '</pre>';
    echo $container['template']->render(
        'error/exception.twig',
        ['message'=>$message,
        'trace' => $trace,]
    );
}





