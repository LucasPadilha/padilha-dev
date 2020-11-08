<?php
declare(strict_types=1);

namespace App\Application\Actions\PixelType;

use Psr\Http\Message\ResponseInterface as Response;

class AddPixelTypeAction extends PixelTypeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        return $this->twig->render($this->response, 'PixelType/add.html.twig');
    }
}
