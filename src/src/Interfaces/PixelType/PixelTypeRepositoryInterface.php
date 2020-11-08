<?php
declare(strict_types=1);

namespace App\Interfaces\PixelType;

use App\Domain\PixelType\Exception\PixelTypeNotFoundException;
use App\Domain\PixelType\PixelType;
use Illuminate\Database\Eloquent\Collection;

interface PixelTypeRepositoryInterface
{
    /**
     * @param bool|null $active
     * @return Collection
     */
    public function findAll(bool $active = null): Collection;

    /**
     * @param int $id
     * @param bool|null $active
     * @return PixelType
     * @throws PixelTypeNotFoundException
     */
    public function findById(int $id, bool $active = null): PixelType;

    /**
     * @param string $slug
     * @param bool|null $active
     * @return PixelType
     * @throws PixelTypeNotFoundException
     */
    public function findBySlug(string $slug, bool $active = null): PixelType;
}