<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\LandingPagePixel;

use App\Domain\LandingPagePixel\Exception\LandingPagePixelNotFoundException;
use App\Domain\LandingPagePixel\LandingPagePixel;
use App\Interfaces\LandingPagePixel\LandingPagePixelRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LandingPagePixelRepository implements LandingPagePixelRepositoryInterface
{
    /** @var LandingPagePixel */
    private $db;

    public function __construct(LandingPagePixel $db)
    {
        $this->db = $db;
    }

    public function findAll(): Collection
    {
        return $this->db::get();
    }

    public function findById(int $id): LandingPagePixel
    {
        $landingPagePixel = $this->db::where('id', $id);

        if (!$landingPagePixel->exists()) {
            throw new LandingPagePixelNotFoundException();
        }

        return $landingPagePixel->first();
    }

    public function findByLandingPageId(int $landing_page_id): Collection
    {
        $landingPagePixel = $this->db::where('landing_page_id', $landing_page_id);

        if (!$landingPagePixel->exists()) {
            throw new LandingPagePixelNotFoundException();
        }

        return $landingPagePixel->get();
    }

    public function findByPixelId(int $landing_page_id, int $pixel_id): LandingPagePixel
    {
        $landingPagePixel = $this->db::where('landing_page_id', $landing_page_id)->where('pixel_id', $pixel_id);

        if (!$landingPagePixel->exists()) {
            throw new LandingPagePixelNotFoundException();
        }

        return $landingPagePixel->first();
    }
}