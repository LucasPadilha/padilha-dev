<?php
declare(strict_types=1);

namespace App\Application\Actions\Login;

use App\Domain\User\Exception\UserNotFoundException;
use App\Utils\Password;
use App\Utils\Validate;
use Psr\Http\Message\ResponseInterface as Response;
use Ramsey\Uuid\Nonstandard\Uuid;

class ProcessLoginAction extends LoginAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $body = $this->getBody();

        if (!Validate::in_array(array_keys($body), ['email', 'password'])) {
            return $this->redirectWithError($this->translator->trans('general.errors.required_fields'));
        }

        if (!Validate::is_email($body['email'])) {
            return $this->redirectWithError($this->translator->trans('pages.login.errors.invalid_email'));
        }

        try {
            $User = $this->userRepository->findByEmail($body['email']);
        } catch(UserNotFoundException $e) {
            return $this->redirectWithError($this->translator->trans('pages.login.errors.user_not_found'));
        }
        
        if (!Password::verify($body['password'], $User->password)) {
            return $this->redirectWithError($this->translator->trans('pages.login.errors.user_not_found'));
        }

        $User->tokens()->update(['is_active' => false]);

        $userToken = $User->tokens()->create(['token' => Uuid::uuid4()->toString()]);

        if ($this->sessionInterface->has('user-token')) {
            $this->sessionInterface->remove('user-token');
        }

        $this->sessionInterface->set('user-token', $userToken->token);

        return $this->response->withHeader('Location', $this->routeParser->urlFor('dashboard'));
    }

    private function redirectWithError(string $errorMessage): Response
    {
        if ($this->sessionInterface->has('user-token')) {
            $this->sessionInterface->remove('user-token');
        }

        $this->flash->clear();
        $this->flash->add('error', $errorMessage);

        return $this->response->withHeader('Location', $this->routeParser->urlFor('login'));
    }
}
