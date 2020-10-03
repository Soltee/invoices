<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    /* Relationships */
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function invoices(){
        return $this->hasMany(Invoice::class);
    }

     /*Scopes */
    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('amount', 'like', '%'.$search.'%');
            });
        })->when($filters['filter'] ?? null, function ($query, $filter) {
            if($filter === 'completed'){
                $query->where('is_completed', true);
            } else {
                $query->where('is_completed', false);
            }   

        })
        ->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

}
