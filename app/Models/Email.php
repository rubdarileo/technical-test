<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Email extends Model
{
    use HasFactory, Sortable;
    protected $table= "emails";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subject',
        'recipient',
        'message',
        'user_id'
    ];

    /**
     * belongsTo relationship with user
     */
    public function user()
    {
        return $this->belongsTo(State::class);
    }
}
