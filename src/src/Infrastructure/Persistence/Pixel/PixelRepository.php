<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\Pixel;

use App\Domain\Pixel\Exception\PixelNotFoundException;
use App\Domain\Pixel\Pixel;
use App\Interfaces\Pixel\PixelRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PixelRepository implements PixelRepositoryInterface
{
    /** @var Pixel */
    private $db;

    public function __construct(Pixel $db)
    {
        $this->db = $db;
    }

    public function findAll(?bool $active = null): Collection
    {
        if (!is_null($active)) {
            return $this->db::active($active)->get();
        }

        return $this->db::get();
    }

    public function findById(int $id, ?bool $active = null): Pixel
    {
        $pixel = $this->db::where('id', $id);

        if (!is_null($active)) {
            $pixel->active($active);
        }

        if (!$pixel->exists()) {
            throw new PixelNotFoundException();
        }

        return $pixel->first();
    }

    public function findByPixelTypeId(int $pixel_type_id, ?bool $active = null): Collection
    {
        $pixel = $this->db::where('pixel_type_id', $pixel_type_id);

        if (!is_null($active)) {
            $pixel->active($active);
        }

        if (!$pixel->exists()) {
            throw new PixelNotFoundException();
        }

        return $pixel->get();
    }

    public function findNotIn(array $pixel_ids, ?bool $active = null): Collection
    {
        if (!is_null($active)) {
            return $this->db::active($active)->whereNotIn('id', $pixel_ids)->get();
        }

        return $this->db::whereNotIn('id', $pixel_ids)->get();
    }
}