<?php
declare(strict_types=1);

namespace App\Application\Actions\LandingPage\Section;

use App\Application\Actions\LandingPage\LandingPageAction;
use Psr\Http\Message\ResponseInterface as Response;

class AddLandingPageSectionAction extends LandingPageAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $landingPageId = (int) $this->resolveArg('landing_page_id');
        $landingPage = $this->landingPageRepository->findById($landingPageId);

        return $this->twig->render($this->response, 'LandingPage/Section/add.html.twig', [ 'parent_data' => $landingPage ]);
    }
}
