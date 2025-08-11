<?php

declare(strict_types=1);

use App\Application\Controllers\Planta\PlantaController;
use App\Application\Controllers\Riego\RiegoController;
use App\Application\Controllers\User\UserController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hola Adrian!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', [UserController::class, 'index']);
        $group->get('/{id}', [UserController::class, 'findById']);
        $group->post('', [UserController::class, 'create']);
        $group->put('/{id}', [UserController::class, 'update']);
        $group->delete('/{id}', [UserController::class, 'delete']);
    });

    $app->group('/plantas', function (Group $group) {
        $group->get('', [PlantaController::class, 'index']);
        $group->get('/{id}', [PlantaController::class, 'findById']);
        $group->get('/categoria/{categoria}', [PlantaController::class, 'findByCategory']);
        $group->post('', [PlantaController::class, 'create']);
        $group->put('/{id}', [PlantaController::class, 'update']);
        $group->delete('/{id}', [PlantaController::class, 'delete']);
    });

    $app->group('/riegos', function (Group $group) {
        $group->get('', [RiegoController::class, 'index']);
        $group->get('/{id}', [RiegoController::class, 'findById']);
        $group->post('', [RiegoController::class, 'create']);
        $group->put('/{id}', [RiegoController::class, 'update']);
        $group->delete('/{id}', [RiegoController::class, 'delete']);
    });
};
