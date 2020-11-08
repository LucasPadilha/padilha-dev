<?php
declare(strict_types=1);

namespace App\Application\Actions\Pixel;

use Psr\Http\Message\ResponseInterface as Response;

class EditPixelAction extends PixelAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $pixelId = (int) $this->resolveArg('pixel_id');

        $pixelTypes = $this->pixelTypeRepository->findAll(true);
        $pixel = $this->pixelRepository->findById($pixelId);

        return $this->twig->render($this->response, 'Pixel/edit.html.twig', ['pixel_types' => $pixelTypes, 'data' => $pixel]);
    }
}
