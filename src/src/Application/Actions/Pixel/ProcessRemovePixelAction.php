<?php
declare(strict_types=1);

namespace App\Application\Actions\Pixel;

use Psr\Http\Message\ResponseInterface as Response;

class ProcessRemovePixelAction extends PixelAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $pixelId = (int) $this->resolveArg('pixel_id');

        $pixel = $this->pixelRepository->findById($pixelId);
        $pixel->delete();

        $this->flash->add('success', $this->translator->trans('general.errors.delete_success'));

        return $this->response->withHeader('Location', $this->routeParser->urlFor('pixel.list'));
    }
}
