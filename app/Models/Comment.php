<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'binh_luans';

    protected $fillable = [
        'user_id',
        'product_id',
        'noi_dung',
        'thoi_gian',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}