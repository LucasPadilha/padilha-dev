<?php
declare(strict_types=1);

namespace App\Application\Actions\LandingPage\Section;

use App\Application\Actions\LandingPage\LandingPageAction;
use App\Utils\Validate;
use Psr\Http\Message\ResponseInterface as Response;

class ProcessAddLandingPageSectionAction extends LandingPageAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $landingPageId = (int) $this->resolveArg('landing_page_id');
        $landingPage = $this->landingPageRepository->findById($landingPageId);

        $body = $this->getBody();

        if (!Validate::in_array(array_keys($body), ['title', 'template_name', 'is_active'])) {
            return $this->redirectWithError($this->translator->trans('general.errors.required_fields'));
        }

        if (($body['is_active'] !== 'active' && $body['is_active'] !== 'inactive') || mb_strlen($body['title']) < 3) {
            return $this->redirectWithError($this->translator->trans('general.errors.invalid_data'));
        }

        try {
            $landingPage->sections()->create([
                'title' => $body['title'],
                'template_name' => $body['template_name'],
                'order' => ($landingPage->sections->count() + 1),
                'is_active' => ($body['is_active'] == 'active' ? true : false)
            ]);
        } catch (\Exception $e) {
            return $this->redirectWithError($this->translator->trans('general.errors.database_error'));
        }

        $this->flash->add('success', $this->translator->trans('general.errors.success'));

        return $this->response->withHeader('Location', $this->routeParser->urlFor('landing_page.edit', [ 'landing_page_id' => $landingPage->id ]));
    }

    private function redirectWithError(string $errorMessage): Response
    {
        $landingPageId = (int) $this->resolveArg('landing_page_id');

        $this->flash->clear();
        $this->flash->add('error', $errorMessage);

        return $this->response->withHeader('Location', $this->routeParser->urlFor('landing_page.section_add', [ 'landing_page_id' => $landingPageId ]));
    }
}
