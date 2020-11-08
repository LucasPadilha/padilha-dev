<?php
declare(strict_types=1);

namespace App\Application\Actions\Pixel;

use Psr\Http\Message\ResponseInterface as Response;

class AddPixelAction extends PixelAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $pixelTypes = $this->pixelTypeRepository->findAll(true);

        return $this->twig->render($this->response, 'Pixel/add.html.twig', ['pixel_types' => $pixelTypes]);
    }
}
