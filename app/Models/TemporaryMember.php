<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class TemporaryMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'membership_plan_id', 'is_personal_training', 'age', 'address', 'name', 'email', 'gender', 'contact_number', 'image', 'height', 'weight'
    ];

    // Override boot method to generate UUID before saving
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
}
