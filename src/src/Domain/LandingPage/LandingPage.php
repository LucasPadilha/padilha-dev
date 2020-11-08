<?php
declare(strict_types=1);

namespace App\Domain\LandingPage;

use App\Infrastructure\TableName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    public $timestamps = true;

    protected $table = TableName::LANDING_PAGES;

    protected $fillable = [
        'id', 
        'slug',
        'title', 
        'description',
        'is_active'
    ];

    public function scopeActive(Builder $builder, $value = true)
    {
        return $builder->where('is_active', $value);
    }

    public function pixels()
    {
        return $this->belongsToMany('App\Domain\Pixel\Pixel', 'App\Domain\LandingPagePixel\LandingPagePixel');
    }

    public function sections()
    {
        return $this->hasMany('App\Domain\LandingPageSection\LandingPageSection');
    }
}