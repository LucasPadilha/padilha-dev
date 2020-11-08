<?php
declare(strict_types=1);

namespace App\Application\Actions\Pixel;

use App\Application\Actions\Action;
use App\Interfaces\Pixel\PixelRepositoryInterface;
use App\Interfaces\PixelType\PixelTypeRepositoryInterface;
use Slim\Interfaces\RouteParserInterface;
use Slim\Views\Twig;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Translation\Translator;

abstract class PixelAction extends Action
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
     * @var PixelRepositoryInterface
     */
    protected $pixelRepository;
    
    /**
     * @var PixelTypeRepositoryInterface
     */
    protected $pixelTypeRepository;

    /**
     * @param Twig $twig
     * @param Translator $translator
     * @param FlashBagInterface $flashbag
     * @param RouteParserInterface $routeParser
     * @param PixelRepositoryInterface $pixelRepository
     * @param PixelTypeRepositoryInterface $pixelTypeRepository
     */
    public function __construct(Twig $twig, Translator $translator, FlashBagInterface $flashbag, RouteParserInterface $routeParser, PixelRepositoryInterface $pixelRepository, PixelTypeRepositoryInterface $pixelTypeRepository)
    {
        $this->twig = $twig;

        $this->translator = $translator;
        
        $this->flash = $flashbag;

        $this->routeParser = $routeParser;

        $this->pixelRepository = $pixelRepository;

        $this->pixelTypeRepository = $pixelTypeRepository;
    }
}
