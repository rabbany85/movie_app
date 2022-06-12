<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'description',
        'release_date',
        'url',
        'user_id',
        'is_active'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    } 
}
