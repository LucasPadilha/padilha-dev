<?php
declare(strict_types=1);

namespace App\Interfaces\LandingPage;

use App\Domain\LandingPage\Exception\LandingPageNotFoundException;
use App\Domain\LandingPage\LandingPage;
use Illuminate\Database\Eloquent\Collection;

interface LandingPageRepositoryInterface
{
    /**
     * @param bool|null $active
     * @return Collection
     */
    public function findAll(bool $active = null): Collection;

    /**
     * @param int $id
     * @param bool|null $active
     * @return LandingPage
     * @throws LandingPageNotFoundException
     */
    public function findById(int $id, bool $active = null): LandingPage;

    /**
     * @param string $slug
     * @param bool|null $active
     * @return LandingPage
     * @throws LandingPageNotFoundException
     */
    public function findBySlug(string $slug, bool $active = null): LandingPage;
}