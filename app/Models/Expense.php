<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'expense_date',
        'colocation_id',
        'user_id',
        'category_id',
    ];
    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
    public function payer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
