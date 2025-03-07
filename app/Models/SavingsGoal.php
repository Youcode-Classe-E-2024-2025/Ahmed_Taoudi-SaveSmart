<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavingsGoal extends Model
{
    protected $fillable = ['title','target_amount' ,'current_amount' ,'deadline','user_id','is_completed'];

    public function user(){

        return $this->belongsTo(User::class);
    }
}
