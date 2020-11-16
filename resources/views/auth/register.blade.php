<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <title>Register</title>
    <style>
        .error {
            color: red !important;
        }
    </style>
</head>
<body>
<?php
$usernameError = [];
$passwordError = [];
if (isset($errors)) {
    $passwordError = $errors->get('password');
    $usernameError = $errors->get('username');
}
?>
@extends('navbar')

<div class="container" style="margin-top: 100px">
    <div class="d-flex flex-column justify-content-center" style="width: 500px; margin: 0 auto">
        @if ($message = \Illuminate\Support\Facades\Session::get('error'))
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
        @endif
        <form action="{{route('signUp')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" id="username" type="text" name="username">
                <small class="form-text text-muted error"><?php echo $usernameError ? $usernameError[0] : '' ?></small>
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input class="form-control" id="pass" type="password" name="password">
                <small class="form-text text-muted error"><?php echo $passwordError ? $passwordError[0] : '' ?></small>
            </div>
            <button class="w-100 btn btn-primary" type="submit">Register</button>
        </form>
        <div class="mt-3">
            <a href="{{route('login')}}">Login</a>
        </div>
    </div>
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
