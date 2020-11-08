<?php
declare(strict_types=1);

namespace App\Application\Actions\PixelType;

use Psr\Http\Message\ResponseInterface as Response;

class ListPixelTypeAction extends PixelTypeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->pixelTypeRepository->findAll();

        return $this->twig->render($this->response, 'PixelType/list.html.twig', ['data' => $data]);
    }
}
