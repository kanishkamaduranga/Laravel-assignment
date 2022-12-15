<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Damage extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'customer_reference',
        'latitude',
        'longitude',
        'status'
    ];

    public function media()
    {
        return $this->hasMany(Media::class, 'damages_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_reference', 'customer_reference');
    }

    public function repairshop()
    {
        //return $this->belongsTo(RepairShops::class, 'repair_shops_id', 'id');
        return $this->belongsToMany(RepairShops::class, 'damage_repair_shop', 'damage_id', 'repair_shops_id');
    }
}
