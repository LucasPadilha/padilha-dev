<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence\LandingPage;

use App\Domain\LandingPage\Exception\LandingPageNotFoundException;
use App\Domain\LandingPage\LandingPage;
use App\Interfaces\LandingPage\LandingPageRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class LandingPageRepository implements LandingPageRepositoryInterface
{
    /** @var LandingPage */
    private $db;

    public function __construct(LandingPage $db)
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

    public function findById(int $id, ?bool $active = null): LandingPage
    {
        $landingPage = $this->db::where('id', $id);

        if (!is_null($active)) {
            $landingPage->active($active);
        }

        if (!$landingPage->exists()) {
            throw new LandingPageNotFoundException();
        }

        return $landingPage->first();
    }

    public function findBySlug(string $slug, ?bool $active = null): LandingPage
    {
        $landingPage = $this->db::where('slug', $slug);

        if (!is_null($active)) {
            $landingPage->active($active);
        }

        if (!$landingPage->exists()) {
            throw new LandingPageNotFoundException();
        }

        return $landingPage->first();
    }
}