<?php
declare(strict_types=1);

namespace App\Domain\Pixel;

use App\Infrastructure\TableName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Pixel extends Model
{
    public $timestamps = true;

    protected $table = TableName::PIXELS;

    protected $fillable = [
        'id', 
        'pixel_type_id',
        'title',
        'value',
        'is_active'
    ];

    public function scopeActive(Builder $builder, $value = true)
    {
        return $builder->where('is_active', $value);
    }

    public function pixelType()
    {
        return $this->belongsTo('App\Domain\PixelType\PixelType');
    }

    public function landingPages()
    {
        return $this->belongsToMany('App\Domain\LandingPage\LandingPage', 'App\Domain\LandingPagePixel\LandingPagePixel');
    }
}