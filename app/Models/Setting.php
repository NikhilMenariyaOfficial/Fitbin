<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Setting extends Model {

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'id',
        'software_logo',
        'software_favicon',
        'brand_name',
        'brand_description',
        'country',
        'city',
        'contact_number',
        'currency',
        'image',
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
