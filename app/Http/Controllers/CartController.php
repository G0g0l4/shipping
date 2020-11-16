<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartModel = new Cart();
        return view('cart')->with(['products' => $cartModel->getCartProducts()]);
    }

    public function addToCart(Request $request)
    {
        $id = $request->get('id');
        if (Product::find($id)) {
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->product_id = $id;
            if (!$cart->save()) {
                return view('product.products')->with([
                    'products' => Product::all(),
                    'message' => 'Something went wrong!',
                    'success' => false,
                    'categories' => Category::all()]);
            }
            return view('product.products')->with([
                'products' => Product::all(),
                'message' => 'Product added in a cart',
                'success' => true,
                'categories' => Category::all()]);
        }
        return view('product.products')->with([
            'products' => Product::all(),
            'message' => 'Something went wrong!',
            'success' => false,
            'categories' => Category::all()]);
    }
}
