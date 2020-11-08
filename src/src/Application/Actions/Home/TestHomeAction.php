<?php
declare(strict_types=1);

namespace App\Application\Actions\Home;

use Psr\Http\Message\ResponseInterface as Response;

class TestHomeAction extends HomeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        return $this->twig->render($this->response, 'Home/index.html.twig');
    }
}
