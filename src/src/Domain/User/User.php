<?php
declare(strict_types=1);

namespace App\Domain\User;

use App\Infrastructure\TableName;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = true;

    protected $table = TableName::USERS;

    protected $fillable = [
        'id',
        'email',
        'firstname',
        'lastname',
        'password',
        'is_active'
    ];

    protected $hidden = [
        'password'
    ];

    public function scopeActive(Builder $builder, $value = true)
    {
        return $builder->where('is_active', $value);
    }

    public function tokens()
    {
        return $this->hasMany('App\Domain\UserToken\UserToken');
    }
}