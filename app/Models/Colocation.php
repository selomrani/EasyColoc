<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'created_by'
    ];
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function members()
    {
        return $this->belongsToMany(User::class, 'memberships')
            ->withPivot('id', 'joined_at', 'left_at')
            ->withTimestamps();
    }
    public function owner()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function isOwner($userId)
    {
        return $this->created_by === $userId;
    }
    public function categories(){
        return $this->hasMany(Category::class);
    }
}
