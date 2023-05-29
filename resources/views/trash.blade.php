<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INI SAMPAH</title>
</head>
<body>
    <a href="/">Kembali</a>

    @if (Session::get('errors'))
        <p style="color:red">{{Session::get('errors')}}</p>
    @endif

    @if (Session::get('success'))
        <p style="color: green;">{{Session::get('success')}}</p>
    @endif
    
    @foreach ($trash as $t)
        <ol>
            <li>NIS : {{ $t['nis'] }}</li>
            <li>Nama : {{ $t['nama'] }}</li>
            <li>Rombel : {{ $t['rombel'] }}</li>
            <li>Rayon : {{ $t['rayon'] }}</li>
            <li>Dihapus pada : {{\Carbon\Carbon::parse($t['deleted_at'])->format('j F, Y')}}</li>
            <li>
                <a href="{{route('restore', $t['id'])}}">Restore</a>
                <a href="{{route('permanent', $t['id'])}}">Delete Permanent</a>
            </li>
        </ol>
    @endforeach
</body>
</html>