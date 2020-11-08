<?php
declare(strict_types=1);

namespace App\Application\Actions\Login;

use Psr\Http\Message\ResponseInterface as Response;

class ViewLoginAction extends LoginAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        return $this->twig->render($this->response, 'Login/index.html.twig');
    }
}
