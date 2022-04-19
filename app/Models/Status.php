<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /* Specifies the relationship between a Status and a Ticket. */

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
