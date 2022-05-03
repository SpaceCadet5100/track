<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use Laravel\Scout\Searchable;

class Package extends Model
{

    protected $with = ['Sender', 'Recipient', 'SenderAddress', 'RecipientAddress', 'Review'];

    public $timestamps = true;

    use Searchable, HasFactory;

    public function scopeFilter($query, array $filters)
    {
	$query->when($filters['status'] ?? false, fn($query, $status) =>
		$query->whereExists(fn($query) =>
			$query->from('packages')
				->where('status', $status))
	);
	$query->when($filters['time'] ?? false, fn($query, $time) =>
		$query->orderBy('created_at', $time));

    } 
    
    public function Sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function Recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function RecipientAddress()
    {
        return $this->belongsTo(Address::class, 'recipient_address_id');
    }

    public function SenderAddress()
    {
        return $this->belongsTo(Address::class, 'sender_address_id', 'id');
    }

    public function Review()
    {
        return $this->hasOne(Review::class);
    }
    public function toSearchableArray()
    {
	        $array = $this->only(['id','status'])->toArray();
		return $array;
    }
}
