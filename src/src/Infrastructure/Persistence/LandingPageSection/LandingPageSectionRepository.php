<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\LandingPageSection;

use App\Domain\LandingPageSection\Exception\LandingPageSectionNotFoundException;
use App\Domain\LandingPageSection\LandingPageSection;
use App\Interfaces\LandingPageSection\LandingPageSectionRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LandingPageSectionRepository implements LandingPageSectionRepositoryInterface
{
    /** @var LandingPageSection */
    private $db;

    public function __construct(LandingPageSection $db)
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

    public function findById(int $id, ?bool $active = null): LandingPageSection
    {
        $landingPageSection = $this->db::where('id', $id);

        if (!is_null($active)) {
            $landingPageSection->active($active);
        }

        if (!$landingPageSection->exists()) {
            throw new LandingPageSectionNotFoundException();
        }

        return $landingPageSection->first();
    }

    public function findByLandingPageId(int $landing_page_id, ?bool $active = null): Collection
    {
        $landingPageSection = $this->db::where('landing_page_id', $landing_page_id);

        if (!is_null($active)) {
            $landingPageSection->active($active);
        }

        if (!$landingPageSection->exists()) {
            throw new LandingPageSectionNotFoundException();
        }

        return $landingPageSection->get();
    }

    public function findByTemplateName(int $landing_page_id, string $template_name, ?bool $active = null): LandingPageSection
    {
        $landingPageSection = $this->db::where('landing_page_id', $landing_page_id)->where('template_name', $template_name);

        if (!is_null($active)) {
            $landingPageSection->active($active);
        }

        if (!$landingPageSection->exists()) {
            throw new LandingPageSectionNotFoundException();
        }

        return $landingPageSection->first();
    }
}