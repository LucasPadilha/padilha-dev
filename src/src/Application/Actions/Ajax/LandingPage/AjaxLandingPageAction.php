<?php
declare(strict_types=1);

namespace App\Application\Actions\Ajax\LandingPage;

use App\Application\Actions\Ajax\AjaxAction;
use App\Interfaces\LandingPagePixel\LandingPagePixelRepositoryInterface;
use App\Interfaces\LandingPageSection\LandingPageSectionRepositoryInterface;
use App\Interfaces\LandingPageSectionContent\LandingPageSectionContentRepositoryInterface;
use App\Interfaces\Pixel\PixelRepositoryInterface;
use Slim\Interfaces\RouteParserInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Translation\Translator;

abstract class AjaxLandingPageAction extends AjaxAction
{
    /**
     * @var LandingPagePixelRepositoryInterface $landingPagePixelRepository
     */
    protected $landingPagePixelRepository;

    /**
     * @var PixelRepositoryInterface $pixelRepository
     */
    protected $pixelRepository;

    /** 
     * @var LandingPageSectionRepositoryInterface $landingPageSectionRepository 
     */
    protected $landingPageSectionRepository;

    /**
     * @var LandingPageSectionContentRepositoryInterface $landingPageSectionContentRepository
     */

    public function __construct(Translator $translator, FlashBagInterface $flashbag, RouteParserInterface $routeParser, LandingPagePixelRepositoryInterface $landingPagePixelRepository, PixelRepositoryInterface $pixelRepository, LandingPageSectionRepositoryInterface $landingPageSectionRepository, LandingPageSectionContentRepositoryInterface $landingPageSectionContentRepository)
    {
        parent::__construct($translator, $flashbag, $routeParser);
        
        $this->landingPagePixelRepository = $landingPagePixelRepository;

        $this->pixelRepository = $pixelRepository;

        $this->landingPageSectionRepository = $landingPageSectionRepository;

        $this->landingPageSectionContentRepository = $landingPageSectionContentRepository;
    }
}
