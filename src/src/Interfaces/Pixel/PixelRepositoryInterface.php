<?php
declare(strict_types=1);

namespace App\Interfaces\Pixel;

use App\Domain\Pixel\Exception\PixelNotFoundException;
use App\Domain\Pixel\Pixel;
use Illuminate\Database\Eloquent\Collection;

interface PixelRepositoryInterface
{
    /**
     * @param bool|null $active
     * @return Collection
     */
    public function findAll(bool $active = null): Collection;

    /**
     * @param int $id
     * @param bool|null $active
     * @return Pixel
     * @throws PixelNotFoundException
     */
    public function findById(int $id, bool $active = null): Pixel;

    /**
     * @param int $pixel_type_id
     * @param bool|null $active
     * @return Collection
     * @throws PixelNotFoundException
     */
    public function findByPixelTypeId(int $pixel_type_id, bool $active = null): Collection;

    /**
     * @param array $pixel_ids
     * @param bool|null $active
     * @return Collection
     */
    public function findNotIn(array $pixel_ids, ?bool $active = null): Collection;
}