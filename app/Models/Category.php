<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /* Specifies the relationship between a Category and a Ticket. */

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
