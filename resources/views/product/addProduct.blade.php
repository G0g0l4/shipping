<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Add Product</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
<?php
$nameError = [];
$descriptionError = [];
$priceError = [];
$imageError = [];
$categoryError = [];
if (isset($errors)) {
    $nameError = $errors->get('name');
    $descriptionError = $errors->get('description');
    $priceError = $errors->get('price');
    $imageError = $errors->get('image');
    $categoryError = $errors->get('category');
    foreach ($errors as $error) {
        var_dump($error);
    }
}
?>

@extends('navbar')

<div class="container" style="margin-top: 100px">
    <form action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Product Name</label>
            <input class="form-control" id="name" type="text" name="name">
            <small class="form-text text-muted error"><?php echo $nameError ? $nameError[0] : '' ?></small>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description"> </textarea>
            <small
                class="form-text text-muted error"><?php echo $descriptionError ? $descriptionError[0] : '' ?></small>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" class="form-control" id="price" name="price">
            <small class="form-text text-muted error"><?php echo $priceError ? $priceError[0] : '' ?></small>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select class="form-control" id="category" name="category">
                <?php foreach ($categories as $category): ?>
                    <option value="{{$category->id}}">{{$category->name}}</option>
                <?php endforeach; ?>
            </select>
            <small class="form-text text-muted error"><?php echo $categoryError ? $categoryError[0] : '' ?></small>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control" id="image" name="image">
            <small class="form-text text-muted error"><?php echo $imageError ? $imageError[0] : '' ?></small>
        </div>

        <button class="w-100 btn btn-primary" type="submit">Add Product</button>
    </form>
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
