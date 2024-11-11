<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'interactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'type',
        'date',
        'details',
        'user_id',
    ];

    /**
     * Get the user that owns the interaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
