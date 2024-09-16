<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class car extends Model
{
    //use HasFactory;
    protected $fillable = ['name','brand','model','year','car_type','daily_rent_price','availability','image'];
    public function rentals(): HasMany{
       return $this->hasMany(rental::class);
    }
}
