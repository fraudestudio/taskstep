<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

use TaskStep\Middleware\{Services, FakeAuthentication};
use TaskStep\Logic\Data\MySql\Dao\{ProjectDao, UserDao};
use TaskStep\Controllers\ProjectController;


Services::instance()
    ->add('projectDao', ProjectDao::class);


$app = AppFactory::create();

$app->add(new FakeAuthentication());
$app->addErrorMiddleware(displayErrorDetails: true, logErrors: true, logErrorDetails: true);


$app->group('/api', function ($group) {
    $group->get('/projects', ProjectController::bind('get'));
});


$app->run();
