<?php
declare(strict_types=1);

namespace App\Application\Actions\Pixel;

use App\Utils\Validate;
use Psr\Http\Message\ResponseInterface as Response;

class ProcessEditPixelAction extends PixelAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $body = $this->getBody();
        $pixelId = (int) $this->resolveArg('pixel_id');

        if (!Validate::in_array(array_keys($body), ['pixel_type_id', 'title', 'value', 'is_active'])) {
            return $this->redirectWithError($this->translator->trans('general.errors.required_fields'));
        }

        if (($body['is_active'] !== 'active' && $body['is_active'] !== 'inactive') || mb_strlen($body['title']) < 3 || mb_strlen($body['value']) < 3) {
            return $this->redirectWithError($this->translator->trans('general.errors.invalid_data'));
        }
        
        try {
            $pixelType = $this->pixelTypeRepository->findBySlug($body['pixel_type_id']);
        } catch(\Exception $e) {
            return $this->redirectWithError($this->translator->trans('general.errors.invalid_data'));
        }

        try {
            $pixel = $this->pixelRepository->findById($pixelId);
        } catch(\Exception $e) {
            return $this->redirectWithError($this->translator->trans('general.errors.invalid_data'));
        }
        
        $pixel->pixel_type_id = $pixelType->id;
        $pixel->title = $body['title'];
        $pixel->value = $body['value'];
        $pixel->is_active = ($body['is_active'] == 'active' ? true : false);
        
        if (!$pixel->save()) {
            return $this->redirectWithError($this->translator->trans('general.errors.database_error'));
        }

        $this->flash->add('success', $this->translator->trans('general.errors.success'));

        return $this->response->withHeader('Location', $this->routeParser->urlFor('pixel.list'));
    }

    private function redirectWithError(string $errorMessage): Response
    {
        $this->flash->clear();
        $this->flash->add('error', $errorMessage);

        return $this->response->withHeader('Location', $this->routeParser->urlFor('pixel.edit'));
    }
}
