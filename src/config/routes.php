<?php
declare(strict_types=1);

use App\Application\Actions\Ajax\LandingPage\AjaxLandingPageAddPixelAction;
use App\Application\Actions\Ajax\LandingPage\AjaxLandingPagePixelAction;
use App\Application\Actions\Ajax\LandingPage\AjaxLandingPageRemovePixelAction;
use App\Application\Actions\Ajax\LandingPage\AjaxLandingPageRemoveSectionAction;
use App\Application\Actions\Ajax\LandingPage\AjaxLandingPageRemoveSectionContentAction;
use App\Application\Actions\Home\TestHomeAction;
use App\Application\Actions\LandingPage\AddLandingPageAction;
use App\Application\Actions\LandingPage\EditLandingPageAction;
use App\Application\Actions\LandingPage\ListLandingPageAction;
use App\Application\Actions\LandingPage\ProcessAddLandingPageAction;
use App\Application\Actions\LandingPage\ProcessEditLandingPageAction;
use App\Application\Actions\LandingPage\ProcessRemoveLandingPageAction;
use App\Application\Actions\LandingPage\Section\AddLandingPageSectionAction;
use App\Application\Actions\LandingPage\Section\EditLandingPageSectionAction;
use App\Application\Actions\LandingPage\Section\ProcessAddLandingPageSectionAction;
use App\Application\Actions\Login\ProcessLoginAction;
use App\Application\Actions\Login\ViewLoginAction;
use App\Application\Actions\Logout\LogoutAction;
use App\Application\Actions\Pixel\AddPixelAction;
use App\Application\Actions\Pixel\EditPixelAction;
use App\Application\Actions\Pixel\ListPixelAction;
use App\Application\Actions\Pixel\ProcessAddPixelAction;
use App\Application\Actions\Pixel\ProcessEditPixelAction;
use App\Application\Actions\Pixel\ProcessRemovePixelAction;
use App\Application\Actions\PixelType\AddPixelTypeAction;
use App\Application\Actions\PixelType\EditPixelTypeAction;
use App\Application\Actions\PixelType\ListPixelTypeAction;
use App\Application\Actions\PixelType\ProcessAddPixelTypeAction;
use App\Application\Actions\PixelType\ProcessEditPixelTypeAction;
use App\Application\Actions\PixelType\ProcessRemovePixelTypeAction;
use App\Application\Middleware\AuthorizationMiddleware;
use App\Application\Middleware\TwigUser\TwigMiddleware;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->get('/public', function($request, $response, $args) {
        return $response->write('Route placeholder.');
    })->setName('public');

    $app->redirect('/', '/login');

    $app->group('/ajax', function(Group $group) {
        // TODO: adicionar verificação de cabeçalho com TOKEN para validar sessão nas requisições AJAX
        $group->group('/landing_page', function(Group $group) {
            $group->get('/pixel', AjaxLandingPagePixelAction::class)->setName('ajax.landing_page_pixel');
            $group->post('/pixel', AjaxLandingPageAddPixelAction::class)->setName('ajax.landing_page_pixel_add');
            $group->delete('/pixel', AjaxLandingPageRemovePixelAction::class)->setName('ajax.landing_page_pixel_remove');

            $group->delete('/section', AjaxLandingPageRemoveSectionAction::class)->setName('ajax.landing_page_section_remove');

            // $group->get('/section', AjaxLandingPageSectionAction::class)->setName('ajax.landing_page_section');
            // $group->post('/section', AjaxLandingPageAddSectionAction::class)->setName('ajax.landing_page_section_add');            
            $group->delete('/section_content', AjaxLandingPageRemoveSectionContentAction::class)->setName('ajax.landing_page_section_content_remove');
        });
    });

    $app->group('/dashboard', function(Group $group) {
        $group->get('', TestHomeAction::class)->setName('dashboard');

        $group->group('/landing_page', function(Group $group) {
            $group->get('', ListLandingPageAction::class)->setName('landing_page.list');

            $group->get('/add', AddLandingPageAction::class)->setName('landing_page.add');
            $group->post('/add', ProcessAddLandingPageAction::class);

            $group->get('/edit/{landing_page_id:[0-9]+}', EditLandingPageAction::class)->setName('landing_page.edit');
            $group->post('/edit/{landing_page_id:[0-9]+}', ProcessEditLandingPageAction::class);

            $group->get('/remove/{landing_page_id:[0-9]+}', ProcessRemoveLandingPageAction::class)->setName('landing_page.remove');

            $group->group('/section', function(Group $group) {
                $group->get('/{landing_page_id:[0-9]+}/add', AddLandingPageSectionAction::class)->setName('landing_page.section_add');
                $group->post('/{landing_page_id:[0-9]+}/add', ProcessAddLandingPageSectionAction::class);
                
                $group->get('/{landing_page_id:[0-9]+}/edit/{landing_page_section_id:[0-9]+}', EditLandingPageSectionAction::class)->setName('landing_page.section_edit');
                // $group->post('/{landing_page_id:[0-9]+}/edit/{landing_page_section_id:[0-9]+}', ProcessEditLandingPageSectionAction::class);
            });
        });

        $group->group('/pixels', function(Group $group) {
            $group->get('', ListPixelAction::class)->setName('pixel.list');

            $group->get('/add', AddPixelAction::class)->setName('pixel.add');
            $group->post('/add', ProcessAddPixelAction::class);

            $group->get('/edit/{pixel_id:[0-9]+}', EditPixelAction::class)->setName('pixel.edit');
            $group->post('/edit/{pixel_id:[0-9]+}', ProcessEditPixelAction::class);

            $group->get('/remove/{pixel_id:[0-9]+}', ProcessRemovePixelAction::class)->setName('pixel.remove');
        });

        $group->group('/pixel_types', function(Group $group) {
            $group->get('', ListPixelTypeAction::class)->setName('pixel_type.list');
            
            $group->get('/add', AddPixelTypeAction::class)->setName('pixel_type.add');
            $group->post('/add', ProcessAddPixelTypeAction::class);
            
            $group->get('/edit/{pixel_type_id:[0-9]+}', EditPixelTypeAction::class)->setName('pixel_type.edit');
            $group->post('/edit/{pixel_type_id:[0-9]+}', ProcessEditPixelTypeAction::class);

            $group->get('/remove/{pixel_type_id:[0-9]+}', ProcessRemovePixelTypeAction::class)->setName('pixel_type.remove');
        });
    })
    ->add(TwigMiddleware::class)
    ->add(AuthorizationMiddleware::class);

    $app->group('/login', function(Group $group) {
        $group->get('', ViewLoginAction::class)->setName('login');
        $group->post('', ProcessLoginAction::class);
    });

    $app->get('/logout', LogoutAction::class)->setName('logout');
};
