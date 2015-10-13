<?php
/**
 * This is a Idun front controller for my personal site.
 *
 */

// Get the enviroment, autoloader and the $app object
require __DIR__.'/config_with_app.php';



// Inject the database service into the app
$di->setShared('db', function() use ($di) {
    $db = new \Mos\Database\CDatabaseBasic();
    $db->setOptions(require ANAX_APP_PATH . 'config/database_mysql.php');
    $db->connect();
    return $db;
});

// Inject the comment service into the app
$di->set('SurveyController', function() use ($di) {
    $controller = new \Idun\Survey\SurveyController();
    $controller->setDI($di);
    return $controller;
});



// Set link creation to 'clean' for a nice, clean link displayment
$app->url->setUrlType(\Anax\Url\CUrl::URL_CLEAN);

// Add site specifik configurations
$app->theme->configure(ANAX_APP_PATH . '/config/theme.php');



// Home route, the new grid theme page
$app->router->add('', function() use ($app) {
    
    $app->theme->setTitle("Visa alla undersökningsformulär");
    
    // Display all surveys in database
    $app->dispatcher->forward([
        'controller' => 'survey',
        'action'     => 'view-all'
    ]);
    
});



// Router to setup/restore default surveys
$app->router->add('setup', function () use ($app) {

    //$app->db->setVerbose();
    $app->dispatcher->forward([
        'controller' => 'survey',
        'action'     => 'setup-surveys',
    ]);

});



// Check for matching routes and dispatch to controller/handler of route
$app->router->handle();

// Leave the rest to the rendering phase
$app->theme->render();