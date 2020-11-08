<?php
declare(strict_types=1);

namespace App\Application\Actions\PixelType;

use App\Application\Actions\Action;
use App\Interfaces\PixelType\PixelTypeRepositoryInterface;
use Slim\Interfaces\RouteParserInterface;
use Slim\Views\Twig;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Translation\Translator;

abstract class PixelTypeAction extends Action
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
     * @var FlashBagInterface
     */
    protected $flash;
    
    /**
     * @var RouteParserInterface
     */
    protected $routeParser;
    
    /**
     * @var PixelTypeRepositoryInterface
     */
    protected $pixelTypeRepository;

    /**
     * @param Twig $twig
     * @param Translator $translator
     * @param FlashBagInterface $flashbag
     * @param RouteParserInterface $routeParser
     * @param PixelTypeRepositoryInterface $pixelTypeRepository
     */
    public function __construct(Twig $twig, Translator $translator, FlashBagInterface $flashbag, RouteParserInterface $routeParser, PixelTypeRepositoryInterface $pixelTypeRepository)
    {
        $this->twig = $twig;

        $this->translator = $translator;
        
        $this->flash = $flashbag;
        
        $this->routeParser = $routeParser;

        $this->pixelTypeRepository = $pixelTypeRepository;
    }
}
