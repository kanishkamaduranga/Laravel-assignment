<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'path',
        'damages_id'
    ];

    public function damage()
    {
        return $this->belongsTo(Damage::class, 'damages_id', 'id');
    }
}
