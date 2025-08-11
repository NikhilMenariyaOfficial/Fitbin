<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Attendance extends Model {
    use HasFactory;

    public $incrementing = false;

    protected $keyType = 'string';
    protected $fillable = [
        'member_id', 'attendance_date', 'status',
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function ($attendance) {
            $attendance->id = Str::uuid();
        });

        static::addGlobalScope('hasMember', function ($query) {
            $query->whereHas('member');
        });
    }

    public function member(){
        return $this->belongsTo(Member::class, 'member_id');
    }
}
