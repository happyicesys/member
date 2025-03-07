<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'desc',
        'full_url',
        'is_active',
        'local_url',
        'modelable_id',
        'modelable_type',
        'name',
        'sequence',
        'type',
    ];

    // relationships
    public function modelable()
    {
        return $this->morphTo();
    }
}
