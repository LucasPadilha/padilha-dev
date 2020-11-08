<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\LandingPageSectionContent;

use App\Domain\LandingPageSectionContent\Exception\LandingPageSectionContentNotFoundException;
use App\Domain\LandingPageSectionContent\LandingPageSectionContent;
use App\Interfaces\LandingPageSectionContent\LandingPageSectionContentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LandingPageSectionContentRepository implements LandingPageSectionContentRepositoryInterface
{
    /** @var LandingPageSectionContent */
    private $db;

    public function __construct(LandingPageSectionContent $db)
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

    public function findById(int $id, ?bool $active = null): LandingPageSectionContent
    {
        $landingPageSectionContent = $this->db::where('id', $id);

        if (!is_null($active)) {
            $landingPageSectionContent->active($active);
        }

        if (!$landingPageSectionContent->exists()) {
            throw new LandingPageSectionContentNotFoundException();
        }

        return $landingPageSectionContent->first();
    }

    public function findByLandingPageSectionId(int $landing_page_section_id, ?bool $active = null): Collection
    {
        $landingPageSectionContent = $this->db::where('landing_page_section_id', $landing_page_section_id);

        if (!is_null($active)) {
            $landingPageSectionContent->active($active);
        }

        if (!$landingPageSectionContent->exists()) {
            throw new LandingPageSectionContentNotFoundException();
        }

        return $landingPageSectionContent->get();
    }

    public function findBySlug(int $landing_page_section_id, string $slug, ?bool $active = null): LandingPageSectionContent
    {
        $landingPageSectionContent = $this->db::where('landing_page_section_id', $landing_page_section_id)->where('slug', $slug);

        if (!is_null($active)) {
            $landingPageSectionContent->active($active);
        }

        if (!$landingPageSectionContent->exists()) {
            throw new LandingPageSectionContentNotFoundException();
        }

        return $landingPageSectionContent->first();
    }
}