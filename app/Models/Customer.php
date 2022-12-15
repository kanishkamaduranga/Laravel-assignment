<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_reference',
        'name',
        'email',
        'tp',
        'status'
    ];

    public function damage()
    {
        return $this->hasMany(Damage::class, 'customer_reference','customer_reference');
    }
}
