<?php
declare(strict_types=1);

namespace App\Application\Actions\Logout;

use App\Application\Actions\Action;
use App\Interfaces\UserToken\UserTokenRepositoryInterface;
use Slim\Interfaces\RouteParserInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Translation\Translator;

use Psr\Http\Message\ResponseInterface as Response;

class LogoutAction extends Action
{
    /**
     * @var Translator
     */
    protected $translator;

    /**
     * @var SessionInterface
     */
    protected $sessionInterface;
    
    /**
     * @var FlashBagInterface
     */
    protected $flash;
    
    /**
     * @var RouteParserInterface
     */
    protected $routeParser;
    
    /**
     * @var UserTokenRepositoryInterface
     */
    protected $userTokenRepository;

    /**
     * @param Translator $translator
     * @param SessionInterface $sessionInterface
     * @param FlashBagInterface $flashbag
     * @param RouteParserInterface $routeParser
     * @param UserTokenRepositoryInterface $userTokenRepository
     */
    public function __construct(Translator $translator, SessionInterface $sessionInterface, FlashBagInterface $flashbag, RouteParserInterface $routeParser, UserTokenRepositoryInterface $userTokenRepository)
    {
        $this->translator = $translator;

        $this->sessionInterface = $sessionInterface;
        
        $this->flash = $flashbag;

        $this->routeParser = $routeParser;

        $this->userTokenRepository = $userTokenRepository;
    }

    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        if ($this->sessionInterface->has('user-token')) {
            $userToken = $this->userTokenRepository->findByToken($this->sessionInterface->get('user-token'));
            $userToken->update(['is_active' => false]);

            $this->sessionInterface->remove('user-token');
        }

        $this->flash->clear();
        $this->flash->add('success', $this->translator->trans('pages.login.errors.logout_success'));

        return $this->response->withHeader('Location', $this->routeParser->urlFor('login'));
    }
}
