<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $appends = ['totalPrice'];
    
    protected $table = 'orders';
     
    protected $fillable = [
        'user_id',
        'code',
        'name',
        'email',
        'phone',
        'address',
        'description',
        'status',
        'pay',
    ];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function details() {
        return $this->hasMany(OrderDetail::class);
    }

    public function getTotalPriceAttribute() {
        $t = 0;

        foreach($this->details as $item) {
            $t += $item->price * $item->quantity;
        }

        return $t;
    }
}
