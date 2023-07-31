<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title class="text-center">Laporan Produk</title>
</head>
<body>
    <h3 class="text-center" align="center">LAPORAN PRODUK</h3>
    <div class="form-group">
    <table class="table table-striped table-hover table-bordered" align="center" rules="all" border="1px" style="width:95%;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Kode Barang</th>
                <th>Kategori</th>
                <th>Merk</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody align="center">
            @foreach ($data as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->nama_produk }}</td>
                <td>{{ $item->kode }}</td>
                <td>{{ $item->kategori->kategori }}</td>
                <td>{{ $item->merk }}</td>
                <td>{{ $item->formatRupiah('harga_beli') }}</td>
                <td>{{ $item->formatRupiah('harga_jual') }}</td>
                <td>{{ $item->stok }}</td>
        @endforeach
        </tbody>
    </table>
    </div>
</body>
</html>