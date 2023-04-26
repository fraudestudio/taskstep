<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use TaskStep\Middleware\Helpers\Services;
use TaskStep\Middleware\Authentication\FakeAuthentication;
use TaskStep\Logic\Data\MySql\Dao\{ProjectDao, UserDao, ContextDao};
use TaskStep\Controllers\{ProjectController, ContextController};


$services = Services::instance()
    ->add('projectDao', ProjectDao::class)
    ->add('contextDao', ContextDao::class);

$app = AppFactory::create();

$app->add(new FakeAuthentication());
$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(displayErrorDetails: true, logErrors: true, logErrorDetails: true);


$app->group('/api', function ($group) {
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
});


$services->addInstance('routeParser', $app->getRouteCollector()->getRouteParser());

$app->run();
