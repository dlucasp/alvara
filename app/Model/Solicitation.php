<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Solicitation extends Model
{
    protected $fillable = array(
        'document',
        'name',
        'birthday',
        'protocol',
        'status',
    );

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function movimentations()
    {
        return $this->hasMany(Movimentation::class);
    }

    protected $casts = array(
        "birthday" => "date"
    );
}
