<?php
declare(strict_types=1);

namespace App\Application\Actions\PixelType;

use App\Utils\Validate;
use Cocur\Slugify\Slugify;
use Psr\Http\Message\ResponseInterface as Response;

class ProcessEditPixelTypeAction extends PixelTypeAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $body = $this->getBody();
        $pixelId = (int) $this->resolveArg('pixel_type_id');

        if (!Validate::in_array(array_keys($body), ['title', 'is_active'])) {
            return $this->redirectWithError($this->translator->trans('general.errors.required_fields'));
        }

        if (($body['is_active'] !== 'active' && $body['is_active'] !== 'inactive') || mb_strlen($body['title']) < 3 ) {
            return $this->redirectWithError($this->translator->trans('general.errors.invalid_data'));
        }

        try {
            $pixelType = $this->pixelTypeRepository->findById($pixelId);
        } catch(\Exception $e) {
            return $this->redirectWithError($this->translator->trans('general.errors.invalid_data'));
        }
        
        $pixelType->slug = (new Slugify())->slugify($body['title']);
        $pixelType->title = $body['title'];
        $pixelType->is_active = ($body['is_active'] == 'active' ? true : false);
        
        if (!$pixelType->save()) {
            return $this->redirectWithError($this->translator->trans('general.errors.database_error'));
        }

        $this->flash->add('success', $this->translator->trans('general.errors.success'));

        return $this->response->withHeader('Location', $this->routeParser->urlFor('pixel_type.list'));
    }

    private function redirectWithError(string $errorMessage): Response
    {
        $this->flash->clear();
        $this->flash->add('error', $errorMessage);

        return $this->response->withHeader('Location', $this->routeParser->urlFor('pixel_type.edit'));
    }
}
