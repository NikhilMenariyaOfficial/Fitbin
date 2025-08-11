<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MembershipPlan extends Model {
    
    use HasFactory;
   
    protected $fillable = ['name', 'rate', 'validity', 'details','type'];
    public $incrementing = false; // Disable auto-incrementing

    protected static function boot(){
        parent::boot();

        static::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
