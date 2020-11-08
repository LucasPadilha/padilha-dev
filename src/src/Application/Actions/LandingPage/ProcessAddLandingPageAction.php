<?php
declare(strict_types=1);

namespace App\Application\Actions\LandingPage;

use App\Domain\LandingPage\LandingPage;
use App\Utils\Validate;
use Cocur\Slugify\Slugify;
use Psr\Http\Message\ResponseInterface as Response;

class ProcessAddLandingPageAction extends LandingPageAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $body = $this->getBody();

        if (!Validate::in_array(array_keys($body), ['slug', 'title', 'is_active'])) {
            return $this->redirectWithError($this->translator->trans('general.errors.required_fields'));
        }

        if (!Validate::in_array(array_keys($body), 'description')) {
            $body['description'] = '';
        }

        $body['slug'] = (new Slugify())->slugify($body['slug']);

        if (($body['is_active'] !== 'active' && $body['is_active'] !== 'inactive') || mb_strlen($body['title']) < 3 || mb_strlen($body['slug']) < 3) {
            return $this->redirectWithError($this->translator->trans('general.errors.invalid_data'));
        }

        try {
            $landingPageBySlug = $this->landingPageRepository->findBySlug($body['slug']);

            return $this->redirectWithError($this->translator->trans('pages.landing_page.form.errors.slug_in_use'));
        } catch (\Exception $e) {
            // slug doesn`t exists
        }
        
        $landingPage = new LandingPage();
        $landingPage->slug = $body['slug'];
        $landingPage->title = $body['title'];
        $landingPage->description = $body['description'];
        $landingPage->is_active = ($body['is_active'] == 'active' ? true : false);

        if (!$landingPage->save()) {
            return $this->redirectWithError($this->translator->trans('general.errors.database_error'));
        }

        $this->flash->add('success', $this->translator->trans('general.errors.success'));

        return $this->response->withHeader('Location', $this->routeParser->urlFor('landing_page.list'));
    }

    private function redirectWithError(string $errorMessage): Response
    {
        $this->flash->clear();
        $this->flash->add('error', $errorMessage);

        return $this->response->withHeader('Location', $this->routeParser->urlFor('landing_page.add'));
    }
}
