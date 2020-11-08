<?php
declare(strict_types=1);

namespace App\Application\Actions\LandingPage\Section;

use App\Application\Actions\LandingPage\LandingPageAction;
use Psr\Http\Message\ResponseInterface as Response;

class EditLandingPageSectionAction extends LandingPageAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $landingPageId = (int) $this->resolveArg('landing_page_id');
        $landingPage = $this->landingPageRepository->findById($landingPageId);

        $landingPageSectionId = (int) $this->resolveArg('landing_page_section_id');
        $landingPageSection = $this->landingPageSectionRepository->findById($landingPageSectionId);

        return $this->twig->render($this->response, 'LandingPage/Section/edit.html.twig', [ 'parent_data' => $landingPage, 'data' => $landingPageSection ]);
    }
}
