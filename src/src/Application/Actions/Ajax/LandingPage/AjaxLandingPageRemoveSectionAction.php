<?php
declare(strict_types=1);

namespace App\Application\Actions\Ajax\LandingPage;

use App\Application\Actions\ActionError;
use App\Application\Actions\ActionPayload;
use App\Utils\Validate;
use Psr\Http\Message\ResponseInterface as Response;

class AjaxLandingPageRemoveSectionAction extends AjaxLandingPageAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->getBody();
        
        if (!Validate::in_array(array_keys($data), ['landing_page_id', 'landing_page_section_id'])) {
            return $this->respond(new ActionPayload(400, null, new ActionError(ActionError::BAD_REQUEST, 'Invalid request.')));
        }

        $landingPageSection = $this->landingPageSectionRepository->findById((int) $data['landing_page_section_id']);

        if (!$landingPageSection->delete()) {
            return $this->respond(new ActionPayload(500, null, new ActionError(ActionError::SERVER_ERROR, 'Unexpected error.')));
        }

        return $this->respondWithData(['success' => true]);
    }
}
