<?php
declare(strict_types=1);

namespace App\Application\Actions\Ajax\LandingPage;

use Psr\Http\Message\ResponseInterface as Response;

class AjaxLandingPagePixelAction extends AjaxLandingPageAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $landing_page_id = (int) $this->resolveQueryParam('landing_page_id');
        
        try {
            $pluck = $this->landingPagePixelRepository->findByLandingPageId($landing_page_id)->pluck('pixel_id')->all();
        } catch(\Exception $e) {
            $pluck = [];
        }

        $pixels = $this->pixelRepository->findNotIn($pluck);

        foreach ($pixels as $pixel) {
            $pixel->pixel_type = $pixel->pixelType;
        }

        return $this->respondWithData($pixels);
    }
}
