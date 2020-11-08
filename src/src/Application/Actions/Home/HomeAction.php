<?php
declare(strict_types=1);

namespace App\Application\Actions\Home;

use App\Application\Actions\Action;
use Psr\Log\LoggerInterface;
use Slim\Views\Twig;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

abstract class HomeAction extends Action
{
    /**
     * @var Twig
     */
    protected $twig;

    /**
     * @var SessionInterface
     */
    protected $sessionInterface;

    /**
     * @var FlashBagInterface
     */
    protected $flash;

    /**
     * @param Twig $twig
     * @param SessionInterface $sessionInterface
     * @param FlashBagInterface $flashbag
     */
    public function __construct(Twig $twig, SessionInterface $sessionInterface, FlashBagInterface $flashbag)
    {
        $this->twig = $twig;

        $this->sessionInterface = $sessionInterface;
        
        $this->flash = $flashbag;
    }
}
