<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @vararray
     */
    protected $fillable = [
        'name', 'description'
    ];
}
