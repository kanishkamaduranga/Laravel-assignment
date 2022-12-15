<?php

namespace App\Models;

use App\Constant\Repair_shops_status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairShops extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'tp',
        'latitude',
        'longitude'
    ];

    public function damage()
    {
        //return $this->hasMany(Damage::class, 'repair_shops_id', 'id');
        return $this->belongsToMany(Damage::class, 'damage_repair_shop', 'repair_shops_id', 'damage_id');
    }

}
