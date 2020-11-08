<?php
declare(strict_types=1);

namespace App\Application\Actions\PixelType;

use Psr\Http\Message\ResponseInterface as Response;

class ProcessRemovePixelTypeAction extends PixelTypeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $pixelId = (int) $this->resolveArg('pixel_type_id');

        $pixelType = $this->pixelTypeRepository->findById($pixelId);
        $pixelType->delete();

        $this->flash->add('success', $this->translator->trans('general.errors.delete_success'));

        return $this->response->withHeader('Location', $this->routeParser->urlFor('pixel_type.list'));
    }
}
