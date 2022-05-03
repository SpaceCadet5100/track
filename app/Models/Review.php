<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
	    'stars',
	    'text',
	    'package_id'
    ];

    public $timestamps = false;


                 
    public function Package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

}
