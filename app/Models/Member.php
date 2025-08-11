<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Member extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'member_id',
        'gender',
        'age',
        'contact_number',
        'address',
        'email',
        'height',
        'weight',
        'amount',
        'image',
        'proof_given',
        'membership_plan_id',
        'joining_date',
        'is_personal_training',
        'membership_start_date',
        'membership_end_date',
        'membership_fee',
        'amount_paid',
        'pending_amount',
        'last_payment_date',
        'date_of_birth',
        'occupation',
        'how_did_you_find_about_the_gym',
        'has_medical_conditions',
        'medical_conditions',
        'has_body_part_issues',
        'body_part_issues',
        'other_medical_info',
    ];

    public const PERSONAL_TRAINING_YES = 'YES';
    public const PERSONAL_TRAINING_NO = 'NO';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });

        static::addGlobalScope('hasMembershipPlan', function ($query) {
            $query->whereHas('membershipPlan');
        });
    }

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class, 'membership_plan_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'member_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'member_id');
    }

    public function membershipHistories()
    {
        return $this->hasMany(MembershipHistory::class, 'member_id');
    }
}
