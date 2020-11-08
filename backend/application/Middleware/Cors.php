<?php

namespace App\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class Cors
{
    public function __invoke(Request $req, Response $res, $next)
    {
        $response = $next($req, $res);

        return $response
                    ->withHeader('Access-Control-Allow-Origin', 'http://localhost')
                    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
    }
}