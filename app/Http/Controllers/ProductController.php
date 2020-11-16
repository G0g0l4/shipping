<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.products')->with(['products' => \App\Models\Product::all(), 'categories' => \App\Models\Category::all()]);
    }

    public function create()
    {
        return view('product.addProduct')->with(['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'string',
            'price' => 'integer|required',
            'category' => 'required|integer',
            'image' => 'mimes:jpg,jpeg,png|required|image'
        ]);

        $model = new Product();
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $request->image->store('images', 'public');
                $extension = $request->image->extension();
                $fileName = Str::random(25) . "." . $extension;
                $request->image->storeAs('/public/images', $fileName);
                $path = Storage::url('/images/' . $fileName);
                $model->image_path = $path;
            }
        }
        $model->user_id = Auth::user()->id;
        DB::beginTransaction();
        if (Category::where(['id' => $request->get('category')])) {
            $model->category_id = $request->get('category');
        } else {
            DB::rollBack();
            return false;
        }
        $model->product_name = $request->get('name');
        $model->description = $request->get('description');
        $model->price = $request->get('price');
        $model->save();
        DB::commit();
        return view('product.products')->with(['products' => Product::all()]);
    }

    public function filterWithCategory(Request $request)
    {
        $this->validate($request, [
            'category' => 'integer',
        ]);

        $categoryId = (int)$request->get('category');
        if ($categoryId == 0) {
            return view('product.categoryResult')->with([
                'products' => Product::all(),
                'categories' => Category::all()
            ]);
        }
        if (Category::find($categoryId)) {
            return view('product.categoryResult')->with([
                'products' => Product::where('category_id', $categoryId)->get(),
                'categories' => Category::all()
            ]);
        }
        return view('product.categoryResult')->with([
            'products' => Product::all(),
            'categories' => Category::all()
        ]);
    }
}
