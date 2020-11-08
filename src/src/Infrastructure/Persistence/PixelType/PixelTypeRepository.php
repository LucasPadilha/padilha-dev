<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\PixelType;

use App\Domain\PixelType\Exception\PixelTypeNotFoundException;
use App\Domain\PixelType\PixelType;
use App\Interfaces\PixelType\PixelTypeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PixelTypeRepository implements PixelTypeRepositoryInterface
{
    /** @var PixelType */
    private $db;

    public function __construct(PixelType $db)
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

    public function findById(int $id, ?bool $active = null): PixelType
    {
        $pixelType = $this->db::where('id', $id);

        if (!is_null($active)) {
            $pixelType->active($active);
        }

        if (!$pixelType->exists()) {
            throw new PixelTypeNotFoundException();
        }

        return $pixelType->first();
    }

    public function findBySlug(string $slug, ?bool $active = null): PixelType
    {
        $pixelType = $this->db::where('slug', $slug);

        if (!is_null($active)) {
            $pixelType->active($active);
        }

        if (!$pixelType->exists()) {
            throw new PixelTypeNotFoundException();
        }

        return $pixelType->first();
    }
}