<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="./js/app.js"></script>
    <link rel="stylesheet" href="./css/app.css">
    <title>Primes</title>
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <h1 class="display-3">Consecutive primes sum problem</h1>
        @isset($amount)
            <p>Input amount : {{$amount}}</p>
        @endisset
        @isset($elements)
            <p>Maximum amount of elements : {{count($elements)}}</p>
            <p>List of elements : {{implode("-", $elements)}}</p>
            <p>Resulting prime: {{array_sum($elements)}}</p>
        @endisset
        <form action="/" method="POST">
            @method('POST')
            @csrf
            <input type="text" name="amount" placeholder="Enter amount here">
            <input type="submit" value="Calculate" class="btn btn-lg btn-success"/>
        </form>
    </div>
</div>
</body>
</html>
