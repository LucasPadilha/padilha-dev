<?php
declare(strict_types=1);

namespace App\Application\Actions\LandingPage;

use Psr\Http\Message\ResponseInterface as Response;

class ProcessEditLandingPageAction extends LandingPageAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->landingPageRepository->findAll();

        return $this->twig->render($this->response, 'LandingPage/list.html.twig', ['data' => $data]);
    }
}
