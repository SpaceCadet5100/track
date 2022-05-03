<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Address extends Model
{
    use Searchable, HasFactory;
    public $timestamps = false;

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getScoutKey()
    {
        return $this->id;
    }

    public function getScoutKeyName()
    {
        return 'address';
    }
    public function toSearchableArray()
    {
        $array = $this->toArray();

        return $array;
    }
}
