<?php
declare(strict_types=1);

namespace App\Application\Actions\Pixel;

use Psr\Http\Message\ResponseInterface as Response;

class ListPixelAction extends PixelAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $data = $this->pixelRepository->findAll();

        return $this->twig->render($this->response, 'Pixel/list.html.twig', ['data' => $data]);
    }
}
