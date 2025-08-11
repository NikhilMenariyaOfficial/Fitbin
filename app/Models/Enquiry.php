<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Enquiry extends Model { 
    use HasFactory;
    
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name', 
        'gender', 
        'age', 
        'contact_number', 
        'email', 
        'address',
        'enquiry_training_type', 
        'about_joining', 
        'follow_up_date', 
        'source',
        'online_source',
        'offline_source',
        'referral_name',
        'join_status',
        'enquiryStatus',
        'last_follow_up_date'
    ];

    protected static function boot(){
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    protected $dates = ['created_at', 'updated_at'];

    public function formattedDate(){
        return $this->created_at->format('Y-m-d');
    }
}
