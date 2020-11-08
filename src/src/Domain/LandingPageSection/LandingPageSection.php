<?php
declare(strict_types=1);

namespace App\Domain\LandingPageSection;

use App\Infrastructure\TableName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LandingPageSection extends Model
{
    public $timestamps = true;

    protected $table = TableName::LANDING_PAGE_SECTIONS;

    protected $fillable = [
        'id',
        'landing_page_id', 
        'title',
        'template_name',
        'order',
        'is_active'
    ];

    protected static function booted()
    {
        static::addGlobalScope('ordered', function(Builder $builder) {
            $builder->orderBy('landing_page_id', 'asc')->orderBy('order', 'asc');
        });
    }

    public function scopeActive(Builder $builder, $value = true)
    {
        return $builder->where('is_active', $value);
    }

    public function landingPage()
    {
        return $this->belongsTo('App\Domain\LandingPage\LandingPage');
    }

    public function contents()
    {
        return $this->hasMany('App\Domain\LandingPageSectionContent\LandingPageSectionContent');
    }
}