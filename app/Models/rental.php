<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class rental extends Model
{
    //use HasFactory;
    protected $fillable = ['user_id','car_id','start_date','end_date','total_cost','status'];
    public function car():BelongsTo{
        return $this->belongsTo(car::class);
    }
    public function user():BelongsTo{
        return $this->belongsTo(user::class);
    }
}
