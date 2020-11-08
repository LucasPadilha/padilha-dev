<?php
declare(strict_types=1);

namespace App\Application\Actions\Login;

use App\Application\Actions\Action;
use App\Interfaces\User\UserRepositoryInterface;
use Slim\Interfaces\RouteParserInterface;
use Slim\Views\Twig;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Translation\Translator;

abstract class LoginAction extends Action
{
    /**
     * @var Twig
     */
    protected $twig;
    
    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @var SessionInterface
     */
    protected $sessionInterface;
    
    /**
     * @var FlashBagInterface
     */
    protected $flash;
    
    /**
     * @var RouteParserInterface
     */
    protected $routeParser;
    
    /**
     * @var UserRepositoryInterface
     */
    protected $userRepository;

    /**
     * @param Twig $twig
     * @param SessionInterface $sessionInterface
     * @param FlashBagInterface $flashbag
     */
    public function __construct(Twig $twig, Translator $translator, SessionInterface $sessionInterface, FlashBagInterface $flashbag, RouteParserInterface $routeParser, UserRepositoryInterface $userRepository)
    {
        $this->twig = $twig;

        $this->translator = $translator;

        $this->sessionInterface = $sessionInterface;
        
        $this->flash = $flashbag;

        $this->routeParser = $routeParser;

        $this->userRepository = $userRepository;
    }
}
