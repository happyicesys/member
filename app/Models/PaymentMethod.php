<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function attachment()
    {
        return $this->morphOne(Attachment::class, 'modelable');
    }
}
