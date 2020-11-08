<?php
declare(strict_types=1);

namespace App\Application\Actions\LandingPage;

use Psr\Http\Message\ResponseInterface as Response;

class AddLandingPageAction extends LandingPageAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        return $this->twig->render($this->response, 'LandingPage/add.html.twig');
    }
}
