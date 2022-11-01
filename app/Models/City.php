<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table= "cities";

    /**
     * belongsTo relationship with State
     */
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    /**
     * HasOne relationship with User
     */
    public function user()
    {
        return $this->HasOne(User::class);
    }
}
