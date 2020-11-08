<?php
declare(strict_types=1);

namespace App\Application\Middleware;

use App\Interfaces\User\UserRepositoryInterface;
use App\Interfaces\UserToken\UserTokenRepositoryInterface;
use Exception;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Exception\HttpUnauthorizedException;
use Slim\Routing\RouteContext;

class AuthenticationMiddleware implements Middleware
{
    /** @var UserRepositoryInterface */
    private $userRepository;

    /** @var UserTokenRepositoryInterface */
    private $userTokenRepository;

    public function __construct(UserRepositoryInterface $userRepository, UserTokenRepositoryInterface $userTokenRepository)
    {   
        $this->userRepository = $userRepository;
        $this->userTokenRepository = $userTokenRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $route = $routeContext->getRoute();

        if ($route->getName() == 'login' || $route->getName() == 'user.create') {
            return $handler->handle($request);
        }

        $headers = $request->getHeaders();
        if (!isset($headers['X-AUTH-TOKEN'])) {
            throw new HttpUnauthorizedException($request, 'Authentication token not found.');
        }

        $authToken = $headers['X-AUTH-TOKEN'][0];

        try {
            $userToken = $this->userTokenRepository->findByToken($authToken, true);
        } catch (Exception $e) {
            throw new HttpUnauthorizedException($request, 'Authentication token not found.');
        }

        if (!$userToken->user()->active(true)->exists()) {
            throw new HttpUnauthorizedException($request, 'User not found.');
        }

        $userToken->touch();

        $request = $request->withAttribute('user', $userToken->user);
        
        return $handler->handle($request);
    }
}
