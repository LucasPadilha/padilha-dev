<?php
declare(strict_types=1);

use App\Infrastructure\Persistence\LandingPage\LandingPageRepository;
use App\Infrastructure\Persistence\LandingPagePixel\LandingPagePixelRepository;
use App\Infrastructure\Persistence\LandingPageSection\LandingPageSectionRepository;
use App\Infrastructure\Persistence\LandingPageSectionContent\LandingPageSectionContentRepository;
use App\Infrastructure\Persistence\Pixel\PixelRepository;
use App\Infrastructure\Persistence\PixelType\PixelTypeRepository;
use App\Infrastructure\Persistence\User\UserRepository;
use App\Infrastructure\Persistence\UserToken\UserTokenRepository;
use App\Interfaces\LandingPage\LandingPageRepositoryInterface;
use App\Interfaces\LandingPagePixel\LandingPagePixelRepositoryInterface;
use App\Interfaces\LandingPageSection\LandingPageSectionRepositoryInterface;
use App\Interfaces\LandingPageSectionContent\LandingPageSectionContentRepositoryInterface;
use App\Interfaces\Pixel\PixelRepositoryInterface;
use App\Interfaces\PixelType\PixelTypeRepositoryInterface;
use App\Interfaces\User\UserRepositoryInterface;
use App\Interfaces\UserToken\UserTokenRepositoryInterface;

$repositories = [
    UserRepositoryInterface::class => \DI\autowire(UserRepository::class),
    UserTokenRepositoryInterface::class => \DI\autowire(UserTokenRepository::class),
    PixelTypeRepositoryInterface::class => \DI\autowire(PixelTypeRepository::class),
    PixelRepositoryInterface::class => \DI\autowire(PixelRepository::class),
    LandingPageRepositoryInterface::class => \DI\autowire(LandingPageRepository::class),
    LandingPagePixelRepositoryInterface::class => \DI\autowire(LandingPagePixelRepository::class),
    LandingPageSectionRepositoryInterface::class => \DI\autowire(LandingPageSectionRepository::class),
    LandingPageSectionContentRepositoryInterface::class => \DI\autowire(LandingPageSectionContentRepository::class)
];

return $repositories;