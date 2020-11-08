<?php
declare(strict_types=1);

namespace App\Domain\PixelType;

use App\Infrastructure\TableName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PixelType extends Model
{
    public $timestamps = true;

    protected $table = TableName::PIXEL_TYPES;

    protected $fillable = [
        'id', 
        'slug',
        'title',
        'is_active'
    ];

    public function scopeActive(Builder $builder, $value = true)
    {
        return $builder->where('is_active', $value);
    }

    public function pixels()
    {
        return $this->hasMany('App\Domain\Pixel\Pixel');
    }
}