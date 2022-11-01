<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    protected $table= "states";

    /**
     * One to one relationship with City
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * belongsTo relationship with country
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
