<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Cart</title>
</head>
<body>
@extends('navbar')
<div class="container d-flex align-items-center flex-column" style="margin-top: 100px">
    <h1 class="mb-2">My Cart:</h1>
    <hr/>
    @foreach($products as $product)
        <?php
        $product = App\Models\Product::find($product->product_id);
        ?>
        <div class="product-container">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{$product->image_path}}"
                     alt="Product">
                <div class="card-body">
                    <h5 class="card-title">{{$product->product_name}}</h5>
                    <p class="card-text">{{$product->description}}</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Owner: {{\App\Models\Product::find($product->id)->user->username}}</li>
                        <li class="list-group-item">
                            Category: {{\App\Models\Product::find($product->id)->category->name}}</li>
                        <li class="list-group-item">
                            Price: {{$product->price}} $
                        </li>
                    </ul>
                </div>
            </div>
            <hr/>
        </div>
    @endforeach
</div>

<!-- jQuery and JS bundle w/ Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
</body>
</html>
