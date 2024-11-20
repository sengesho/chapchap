<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $fillable = [
        'foodname',
        'foodimage',
        'sale_price',
        'purchase_price',
        'description',
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(user::class);
    }
}

