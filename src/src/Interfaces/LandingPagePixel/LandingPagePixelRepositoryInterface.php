<?php
declare(strict_types=1);

namespace App\Interfaces\LandingPagePixel;

use App\Domain\LandingPagePixel\Exception\LandingPagePixelNotFoundException;
use App\Domain\LandingPagePixel\LandingPagePixel;
use Illuminate\Database\Eloquent\Collection;

interface LandingPagePixelRepositoryInterface
{
    /**
     * @return Collection
     */
    public function findAll(): Collection;

    /**
     * @param int $id
     * @return LandingPagePixel
     * @throws LandingPagePixelNotFoundException
     */
    public function findById(int $id): LandingPagePixel;

    /**
     * @param int $landing_page_id
     * @return Collection
     * @throws LandingPagePixelNotFoundException
     */
    public function findByLandingPageId(int $landing_page_id): Collection;

    /**
     * @param int $landing_page_id
     * @param int $pixel_id
     * @return LandingPagePixel
     * @throws LandingPagePixelNotFoundException
     */
    public function findByPixelId(int $landing_page_id, int $pixel_id): LandingPagePixel;
}