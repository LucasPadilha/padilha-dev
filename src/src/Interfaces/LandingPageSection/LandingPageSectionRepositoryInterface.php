<?php
declare(strict_types=1);

namespace App\Interfaces\LandingPageSection;

use App\Domain\LandingPageSection\Exception\LandingPageSectionNotFoundException;
use App\Domain\LandingPageSection\LandingPageSection;
use Illuminate\Database\Eloquent\Collection;

interface LandingPageSectionRepositoryInterface
{
    /**
     * @param bool|null $active
     * @return Collection
     */
    public function findAll(bool $active = null): Collection;

    /**
     * @param int $id
     * @param bool|null $active
     * @return LandingPageSection
     * @throws LandingPageSectionNotFoundException
     */
    public function findById(int $id, bool $active = null): LandingPageSection;

    /**
     * @param int $landing_page_id
     * @param bool|null $active
     * @return Collection
     * @throws LandingPageSectionNotFoundException
     */
    public function findByLandingPageId(int $landing_page_id, bool $active = null): Collection;

    /**
     * @param int $landing_page_id
     * @param string $template_name
     * @param bool|null $active
     * @return LandingPageSection
     * @throws LandingPageSectionNotFoundException
     */
    public function findByTemplateName(int $landing_page_id, string $template_name, bool $active = null): LandingPageSection;
}