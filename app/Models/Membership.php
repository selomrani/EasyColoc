<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Membership extends Pivot
{
    // Indique explicitement le nom de la table
    protected $table = 'memberships';

    public $incrementing = true;


    protected $casts = [
        'joined_at' => 'datetime',
        'left_at' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    
}