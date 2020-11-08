<?php
declare(strict_types=1);

namespace App\Application\Actions\LandingPage;

use App\Application\Actions\Action;
use App\Interfaces\LandingPage\LandingPageRepositoryInterface;
use App\Interfaces\LandingPagePixel\LandingPagePixelRepositoryInterface;
use App\Interfaces\LandingPageSection\LandingPageSectionRepositoryInterface;
use Slim\Interfaces\RouteParserInterface;
use Slim\Views\Twig;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Translation\Translator;

abstract class LandingPageAction extends Action
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
     * @var LandingPageRepositoryInterface $landingPageRepository
     */
    protected $landingPageRepository;

    /**
     * @var LandingPagePixelRepositoryInterface $landingPagePixelRepository
     */
    protected $landingPagePixelRepository;

    /**
     * @var LandingPageSectionRepositoryInterface $landingPageSectionRepository
     */
    protected $landingPageSectionRepository;

    /**
     * @param Twig $twig
     * @param Translator $translator
     * @param FlashBagInterface $flashbag
     * @param RouteParserInterface $routeParser
     * @param LandingPageRepositoryInterface $landingPageRepository
     * @param LandingPagePixelRepositoryInterface $landingPagePixelRepository
     * @param LandingPageSectionRepositoryInterface $landingPageSectionRepository
     */
    public function __construct(Twig $twig, Translator $translator, FlashBagInterface $flashbag, RouteParserInterface $routeParser, LandingPageRepositoryInterface $landingPageRepository, LandingPagePixelRepositoryInterface $landingPagePixelRepository, LandingPageSectionRepositoryInterface $landingPageSectionRepository)
    {
        $this->twig = $twig;

        $this->translator = $translator;
        
        $this->flash = $flashbag;

        $this->routeParser = $routeParser;

        $this->landingPageRepository = $landingPageRepository;
        
        $this->landingPagePixelRepository = $landingPagePixelRepository;

        $this->landingPageSectionRepository = $landingPageSectionRepository;
    }
}
