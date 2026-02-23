<?php
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (App $app) { 
    $app->group('/app/v1', function (Group $group) {
        $group->get('/produtos', function (Request $request, Response $response) {
            $data = ['nome' => 'Moto G'];
            $payload = json_encode($data);

            $response->getBody()->write($payload);
            
            return $response
                    ->withHeader('Content-Type', 'application/json')
                    ->withStatus(200);
        });
    });
};