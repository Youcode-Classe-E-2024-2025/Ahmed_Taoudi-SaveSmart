<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['user_id', 'name'];

    // Relation avec l'utilisateur principal
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function transactions(){
        
        return $this->hasMany(Transaction::class);
    }
}
