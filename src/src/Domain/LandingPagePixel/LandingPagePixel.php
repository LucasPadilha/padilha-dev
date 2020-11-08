<?php
declare(strict_types=1);

namespace App\Domain\LandingPagePixel;

use App\Infrastructure\TableName;
use Illuminate\Database\Eloquent\Relations\Pivot;

class LandingPagePixel extends Pivot
{
    public $timestamps = true;

    protected $table = TableName::LANDING_PAGE_PIXELS;

    protected $fillable = [
        'id', 
        'landing_page_id',
        'pixel_id'
    ];
}