<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $timestamps = true;

    protected $table = 'contact';

    protected $fillable = [
        'txt_name',
        'txt_email',
        'txt_message'
    ];
}