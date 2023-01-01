<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title class="text-center">Laporan Kategori</title>
</head>
<body>
    <h3 class="text-center" align="center">LAPORAN KATEGORI</h3>
    <div class="form-group">
    <table class="table table-striped table-hover table-bordered" align="center" rules="all" border="1px" style="width:95%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody align="center">
            @foreach ($data as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kategori }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>