<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    public $timestamps = false;
    protected $primaryKey = 'product_id';

    public function getCartProducts()
    {
        return $this->where('user_id', Auth::user()->id)->get();
    }
}
