<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['expense_id', 'debtor_id', 'creditor_id', 'amount', 'is_paid'];
    public function creditor()
    {
        return $this->belongsTo(User::class, 'creditor_id');
    }

    public function debtor()
    {
        return $this->belongsTo(User::class, 'debtor_id');
    }
}
