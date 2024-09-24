<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model {

    use HasFactory;

    protected $table = 'price';

    protected $fillable = [
        'product_id',
        'client_id',
        'value',
        'amount'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function client() {
        return $this->belongsTo(User::class, 'client_id');
    }
}
