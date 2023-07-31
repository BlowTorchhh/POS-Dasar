<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title class="text-center">Laporan Barang Masuk</title>
</head>
<body>
    <h3 class="text-center" align="center">LAPORAN BARANG MASUK</h3>
    <p class="text-center" align="center">Dari Tanggal {{ $awal }} Sampai Tanggal {{ $akhir }}</p>
    <div class="form-group">
    <table class="table table-striped table-hover table-bordered" align="center" rules="all" border="0.1px" style="width:95%;">
        {{ $count=$data->count(); }}
        @if ($count >= 1)
        
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Masuk</th>
                <th>Kode Barang</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Merk</th>
                <th>Harga Beli</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody align="center">
            
            @foreach ($data as $item )
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->tanggal_barang }}</td>
                <td>{{ $item->produk->kode }}</td>
                <td>{{ $item->produk->nama_produk }}</td>
                <td>{{ $item->produk->kategori->kategori }}</td>
                <td>{{ $item->produk->merk }}</td>
                <td>{{ $item->produk->formatRupiah('harga_beli') }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ formatRupiah($item->total) }}</td>
        @endforeach
        </tbody>
        <tr>
            <td colspan="8">
                <h5 class="text-left" align="center"> Grand Total</h5>
            </td>
            <td>
                <h5 class="text-right" align="center"> {{ formatRupiah($grandtotal) }}</h5>
            </td>
        </tr>
        @endif
    </table>
    </div>
    @if ($count == 0)
            <h4 class="text-center" align="center"> Tidak ada data</h4>
        @endif
</body>
</html>