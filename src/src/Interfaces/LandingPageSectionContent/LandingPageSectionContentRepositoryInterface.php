<?php
declare(strict_types=1);

namespace App\Interfaces\LandingPageSectionContent;

use App\Domain\LandingPageSectionContent\Exception\LandingPageSectionContentNotFoundException;
use App\Domain\LandingPageSectionContent\LandingPageSectionContent;
use Illuminate\Database\Eloquent\Collection;

interface LandingPageSectionContentRepositoryInterface
{
    /**
     * @param bool|null $active
     * @return Collection
     */
    public function findAll(bool $active = null): Collection;

    /**
     * @param int $id
     * @param bool|null $active
     * @return LandingPageSectionContent
     * @throws LandingPageSectionContentNotFoundException
     */
    public function findById(int $id, bool $active = null): LandingPageSectionContent;

    /**
     * @param int $landing_page_section_id
     * @param bool|null $active
     * @return Collection
     * @throws LandingPageSectionContentNotFoundException
     */
    public function findByLandingPageSectionId(int $landing_page_section_id, bool $active = null): Collection;

    /**
     * @param int $landing_page_section_id
     * @param string $slug
     * @param bool|null $active
     * @return LandingPageSectionContent
     * @throws LandingPageSectionContentNotFoundException
     */
    public function findBySlug(int $landing_page_section_id, string $slug, bool $active = null): LandingPageSectionContent;
}