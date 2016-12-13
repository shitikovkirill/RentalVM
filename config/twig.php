<?php
/**
 * Create twig
 */

$loader = new Twig_Loader_Filesystem(__DIR__.'/../View');

$twig = new Twig_Environment(
    $loader,
    array('debug' => true)
);

$function = new \Twig_SimpleFunction(
    'show_massage',
    'show_massage'
);

$twig->addFunction($function);

/**
 * Add function to twig
 */
function show_massage()
{
    if (!session_id()) @session_start();
    $msg = new \Plasticbrain\FlashMessages\FlashMessages();
    $msg->display();
}

return $twig;