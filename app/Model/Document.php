<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = array(
        'solicitation_id',
        'file_name',
        'description',
        'user_id',
        'downloaded',
        'download_date',
        'approved',
        'observation',
        'annotation',
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
        "downloaded" => "boolean",
        "approved" => "boolean",
        "download_date" => "datetime",
    );
}
