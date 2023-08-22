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
            <input type="text" class="form-control" name="url" id="url" value="{{ $url }}">
        </div>
        <input type="submit" name="send" value="Submit" class="btn btn-dark btn-block">
    </form>
</div>
@if (count($result['items']) > 0)
<div class="container-3">
    <table>
        <tr>
            <th>Title</th><th>Description</th><th>Save as PDF</th>
        </tr>

        @foreach ($result['items'] as $item)
        <tr>
            <td><a target="_blank" href="{{ $item['link'] }}">{{ $item['title'] }}</a></td>
            <td>{!! $item['description'] !!}</td>
            <td class="pdf"><a target="_blank" href="{{ $item['pdf_url'] }}">Save as PDF</a></td>
        </tr>
        @endforeach
    </table>
</div>
@endif
</body>
</html>
