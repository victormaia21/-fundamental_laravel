<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Events extends Model
{
    use HasFactory;

    protected $date = ['date'];

    protected $casts = [
        'items' => 'array'
    ];

    protected $guarded = [];

    public function user()
    {
        return $this->BelongsTo('App/Models/User');
    }

    public function  users()
    {
        return $this->belongsToMany('App/Models/User');
    }
}
