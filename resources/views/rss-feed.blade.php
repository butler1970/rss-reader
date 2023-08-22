<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
</head>
<body>
<div class="container mt-5">
    <!-- Success message -->
    @if(Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
    </div>
    @endif
    <form method="post" action="{{ route('rss-feed.update') }}">
        <!-- CROSS Site Request Forgery Protection -->
        @csrf
        <div class="form-group">
            <label>Rss Feed Url</label>
            <input type="text" class="form-control" name="url" id="url">
        </div>
        <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
    </form>
</div>
<div class="container mt-5">
    @foreach ($result['items'] as $item)
        <h2>{{ $item['title'] }}</h2>
        {!! $item['description'] !!}
        @if (isset($item['thumbnail']))
            <img src="{{ $item['thumbnail'] }}" alt="Thumbnail">
        @endif
        <a href="{{ $item['pdf_url'] }}">PDF</a>
    @endforeach
</div>
</body>
</html>
