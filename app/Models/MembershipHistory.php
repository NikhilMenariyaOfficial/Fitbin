<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipHistory extends Model
{
    use HasFactory,HasUlids;

    protected $fillable = [
        'member_id', 'membership_plan_id','amount','due_amount', 'start_date', 'end_date', 'status'
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class);
    }
}
