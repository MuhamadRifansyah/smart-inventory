<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id',
        'user_id',
        'type',
        'quantity',
        'stock_before',
        'stock_after',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
