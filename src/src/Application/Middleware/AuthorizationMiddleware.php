<?php
declare(strict_types=1);

namespace App\Application\Middleware;

use App\Interfaces\UserToken\UserTokenRepositoryInterface;
use Exception;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Interfaces\RouteParserInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Translation\Translator;

class AuthorizationMiddleware implements Middleware
{
    /** @var UserTokenRepositoryInterface */
    private $userTokenRepository;

    /** @var SessionInterface */
    private $sessionInterface;

    /** @var FlashBagInterface */
    private $flashbag;

    /** @var Translator */
    private $translator;

    /** @var RouteParserInterface */
    private $routeParser;

    /** @var ResponseFactoryInterface */
    private $responseFactory;

    public function __construct(UserTokenRepositoryInterface $userTokenRepository, SessionInterface $sessionInterface, FlashBagInterface $flashbag, Translator $translator, RouteParserInterface $routeParser, ResponseFactoryInterface $responseFactory)
    {   
        $this->userTokenRepository = $userTokenRepository;

        $this->sessionInterface = $sessionInterface;

        $this->flashbag = $flashbag;

        $this->translator = $translator;

        $this->routeParser = $routeParser;
        
        $this->responseFactory = $responseFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        if (!$this->sessionInterface->has('user-token')) {
            return $this->redirectWithError($this->translator->trans('pages.login.errors.not_authenticated'));
        }

        $authToken = $this->sessionInterface->get('user-token');

        try {
            $userToken = $this->userTokenRepository->findByToken($authToken, true, true);
        } catch (Exception $e) {
            return $this->redirectWithError($this->translator->trans('pages.login.errors.not_authenticated'));
        }

        if (!$userToken->user()->active(true)->exists()) {
            return $this->redirectWithError($this->translator->trans('pages.login.errors.user_not_found'));
        }

        $userToken->touch();

        $request = $request->withAttribute('user', $userToken->user);
        
        return $handler->handle($request);
    }

    private function redirectWithError(string $errorMessage): Response
    {
        if ($this->sessionInterface->has('user-token')) {
            $this->sessionInterface->remove('user-token');
        }

        $this->flashbag->clear();
        $this->flashbag->add('error', $errorMessage);

        $response = $this->responseFactory->createResponse();
        return $response->withHeader('Location', $this->routeParser->urlFor('login'))->withStatus(301);
    }
}
