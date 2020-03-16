<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Movimentation extends Model
{
    protected $fillable = array(
        'solicitation_id',
        'user_id',
        'status',
        'observation',
        'annotation',
        'is_public',
    );

    public function solicitation()
    {
        return $this->belongsTo(Solicitation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = array(
        "is_public" => "boolean"
    );
}
