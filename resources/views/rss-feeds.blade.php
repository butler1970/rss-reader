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
<div class="container-2">
    <table>
        <tr>
            <th>Rss Feed Url</th>
        </tr>

        @foreach ($feeds as $k => $feed)
        <tr>
            <td><a href="{{ "/?url=" . urlencode($feed->url) }}">{{ $feed->url }}</a></td>
        </tr>
        @endforeach
    </table>
</div>
</body>
</html>
