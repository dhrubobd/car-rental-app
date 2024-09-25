<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class user extends Model
{
    //use HasFactory;
    protected $fillable = ['name','email','password','phone','address','role'];
    public function isAdmin(): bool{
        if($this->role=='admin'){
            return true;
        }else{
            return false;
        }
    }
    function isCustomer(): bool{
        if($this->role=='customer'){
            return true;
        }else{
            return false;
        }
    }
    public function rentals():HasMany{
        return $this->hasMany(rental::class);
    }
}
