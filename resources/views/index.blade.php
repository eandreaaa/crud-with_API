<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Consume REST API Students</title>
</head>
<body>
    <form action="" method="GET">
        @csrf
        <input type="text" name="search" placeholder="Cari nama">
        <button type="submit">Cari</button>
    </form>

    <br>
    @if (Session::get('success'))
        <p style="color: green;">{{Session::get('success')}}</p>
    @endif

    <a href="{{route('add')}}">Tambah Data Baru</a>
    <a href="{{route('trash')}}">Trash</a>

    @if (Session::get('errors'))
        <p style="color:red">{{Session::get('errors')}}</p>
    @endif
    @foreach ($students as $d)
        <ol>
            <li>NIS : {{ $d['nis'] }}</li>
            <li>Nama : {{ $d['nama'] }}</li>
            <li>Rombel : {{ $d['rombel'] }}</li>
            <li>Rayon : {{ $d['rayon'] }}</li>
            <li>Aksi : <a href="{{route('edit', $d['id'])}}">Edit</a> || 
                <form action="{{route('delete', $d['id'])}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Hapus</button></li>
                </form>
        </ol>
    @endforeach
</body>
</html>