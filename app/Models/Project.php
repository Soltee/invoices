<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    /* Relationships */
    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
