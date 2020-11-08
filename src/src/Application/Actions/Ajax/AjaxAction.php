<?php
declare(strict_types=1);

namespace App\Application\Actions\Ajax;

use App\Application\Actions\Action;
use App\Interfaces\LandingPage\LandingPageRepositoryInterface;
use Slim\Interfaces\RouteParserInterface;
use Slim\Views\Twig;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Translation\Translator;

abstract class AjaxAction extends Action
{
    /**
     * @var Translator
     */
    protected $translator;
    
    /**
     * @var FlashBagInterface
     */
    protected $flash;
    
    /**
     * @var RouteParserInterface
     */
    protected $routeParser;

    /**
     * @param Translator $translator
     * @param FlashBagInterface $flashbag
     * @param RouteParserInterface $routeParser
     */
    public function __construct(Translator $translator, FlashBagInterface $flashbag, RouteParserInterface $routeParser)
    {
        $this->translator = $translator;
        
        $this->flash = $flashbag;

        $this->routeParser = $routeParser;
    }
}
