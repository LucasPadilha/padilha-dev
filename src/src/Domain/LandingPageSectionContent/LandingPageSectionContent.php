<?php
declare(strict_types=1);

namespace App\Domain\LandingPageSectionContent;

use App\Infrastructure\TableName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LandingPageSectionContent extends Model
{
    public $timestamps = true;

    protected $table = TableName::LANDING_PAGE_SECTION_CONTENTS;

    protected $fillable = [
        'id',
        'landing_page_section_id',
        'slug',
        'title',
        'value',
        'is_active'
    ];

    public function scopeActive(Builder $builder, $value = true)
    {
        return $builder->where('is_active', $value);
    }

    public function section()
    {
        return $this->belongsTo('App\Domain\LandingPageSection\LandingPageSection');
    }
}