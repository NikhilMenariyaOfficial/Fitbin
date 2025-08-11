<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model {
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'member_id',
        'amount',
        'payment_date',
        'membership_plan_id'
    ];

    protected static function boot(){
        parent::boot();
        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });

        static::addGlobalScope('hasMember', function ($query) {
            $query->whereHas('member');
        });
        static::addGlobalScope('hasMembershipPlan', function ($query) {
            $query->whereHas('membershipPlan');
        });
    }

    public function member(){
        return $this->belongsTo(Member::class, 'member_id');
    }

    public function membershipPlan(){
        return $this->belongsTo(MembershipPlan::class, 'membership_plan_id');
    }
}
