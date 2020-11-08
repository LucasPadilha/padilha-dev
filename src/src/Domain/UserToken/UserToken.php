<?php
declare(strict_types=1);

namespace App\Domain\UserToken;

use App\Infrastructure\TableName;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    public $timestamps = true;

    protected $table = TableName::USER_TOKENS;

    protected $fillable = [
        'id',
        'user_id',
        'token',
        'is_active'
    ];

    public function scopeActive(Builder $builder, $value = true)
    {
        return $builder->where('is_active', $value);
    }

    public function scopeValid(Builder $builder)
    {
        return $builder->where('updated_at', '>=', Carbon::today()->subDays(7));
    }

    public function user()
    {
        return $this->belongsTo('App\Domain\User\User');
    }
}