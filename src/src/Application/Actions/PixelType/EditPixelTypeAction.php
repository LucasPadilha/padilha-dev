<?php
declare(strict_types=1);

namespace App\Application\Actions\PixelType;

use Psr\Http\Message\ResponseInterface as Response;

class EditPixelTypeAction extends PixelTypeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $pixel_type_id = (int) $this->resolveArg('pixel_type_id');

        $pixelType = $this->pixelTypeRepository->findById($pixel_type_id);

        return $this->twig->render($this->response, 'PixelType/edit.html.twig', ['data' => $pixelType]);
    }
}
