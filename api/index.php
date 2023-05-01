<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../includes/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use TaskStepApi\Middleware\Helpers\Services;
use TaskStepApi\Middleware\Authentication\
    {BearerAuthentication, BasicAuthentication};
use TaskStep\Logic\Data\MySql\Dao\{ProjectDao, UserDao, ContextDao, ItemDao};
use TaskStepApi\Controllers\
    {ProjectController, ContextController, AccountController, ItemController};


$services = Services::instance()
    ->add('projectDao', ProjectDao::class)
    ->add('contextDao', ContextDao::class)
    ->add('userDao', UserDao::class)
    ->add('itemDao', ItemDao::class);

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(displayErrorDetails: true, logErrors: true, logErrorDetails: true);


// Pas d'authentification
$app->group('/api', function ($group) {
    $group->post('/signup', AccountController::bind('signup'));
});

// Authentification par mot de passe
$app->group('/api', function ($group) {
    $group->post('/signin', AccountController::bind('signin'));    
    $group->put('/account/password', AccountController::bind('changePassword'));
})
->add(new BasicAuthentication());

// Authentification par jeton
$app->group('/api', function ($group) {
    $group->get('/items', ItemController::bind('getAll'));
    $group->post('/items', ItemController::bind('post'));
    $group->delete('/items/done', ItemController::bind('deleteAllDone'));
    $group->get('/items/count/undone', ItemController::bind('countUndone'));
    $group->get('/items/count/by-section', ItemController::bind('countBySection'));
    $group->get('/items/{id}', ItemController::bind('getOne'))->setName('item');
    $group->put('/items/{id}', ItemController::bind('putOne'));
    $group->delete('/items/{id}', ItemController::bind('deleteOne'));

    $group->get('/projects', ProjectController::bind('getAll'));
    $group->post('/projects', ProjectController::bind('post'));
    $group->get('/projects/{id}', ProjectController::bind('getOne'))->setName('project');
    $group->put('/projects/{id}', ProjectController::bind('putOne'));
    $group->delete('/projects/{id}', ProjectController::bind('deleteOne'));

    $group->get('/contexts', ContextController::bind('getAll'));
    $group->post('/contexts', ContextController::bind('post'));
    $group->get('/contexts/{id}', ContextController::bind('getById'))->setName('context');
    $group->put('/contexts/{id}', ContextController::bind('update'));
    $group->delete('/contexts/{id}', ContextController::bind('delOne'));

    $group->put('/account/settings', AccountController::bind('updateSettings'));
})
->add(new BearerAuthentication());


$services->addInstance('routeParser', $app->getRouteCollector()->getRouteParser());

$app->run();
