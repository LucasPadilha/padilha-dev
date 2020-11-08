<?php
declare(strict_types=1);

namespace App\Application\Actions\LandingPage;

use Psr\Http\Message\ResponseInterface as Response;

class EditLandingPageAction extends LandingPageAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $landingPageId = (int) $this->resolveArg('landing_page_id');
        $landingPage = $this->landingPageRepository->findById($landingPageId);

        return $this->twig->render($this->response, 'LandingPage/edit.html.twig', ['data' => $landingPage]);
    }
}
