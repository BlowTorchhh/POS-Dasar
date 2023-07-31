@extends('main')
@section('tittle', 'Dashboard')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Rekap Laporan Barang Masuk</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active"></li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="content mt-3">

    <div class="animated fadeIn">

        @if (session('status'))
            <div class="alert alert-success">
               {{ session('status') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Rekap Laporan Barang Masuk</strong>
                </div>
                <div class="pull-right">
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#mediumModal">
                        <i class="fa fa-file"></i> Export PDF
                    </button>
                    
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
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
                    <tbody>
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
                            <input type="hidden" value="{{ $total = $item->produk->harga_beli * $item->jumlah }}">
                            <td>{{ formatRupiah($total) }}</td>
                    @endforeach
                    </tbody>
                </table>    
                {{ $data->links() }}
            </div>
        </div>
    </div>
        
</div> <!-- .content -->
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Masukkan Tanggal yang dicari</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('laporan-masuk') }}" method="POST" target="_blank">
                    @csrf
                    <div class="form-group">
                        <label >Tanggal Awal</label>
                        <input class="form-control" type="date" name="awal" required>
                        <label >Tanggal Akhir</label>
                        <input class="form-control" type="date" name="akhir" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" ><i class="fa fa-file"></i> Export PDF</button>
            </div>
        </div>
    </form>
    </div>
</div>
{{-- <script src="{{ asset('style/assets/js/popper.min.js') }}"></script> --}}
<script src="{{ asset('style/assets/js/lib/data-table/datatables.min.js') }}"></script>
<script src="{{ asset('style/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('style/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script> --}}
{{-- <script src="{{ asset('style/assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('style/assets/js/lib/data-table/jszip.min.js') }}"></script> --}}
{{-- <script src="{{ asset('style/assets/js/lib/data-table/pdfmake.min.js') }}"></script> --}}
{{-- <script src="{{ asset('style/assets/js/lib/data-table/vfs_fonts.js') }}"></script> --}}
{{-- <script src="{{ asset('style/assets/js/lib/data-table/buttons.html5.min.js') }}"></script> --}}
{{-- <script src="{{ asset('style/assets/js/lib/data-table/buttons.print.min.js') }}"></script> --}}
{{-- <script src="{{ asset('style/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script> --}}
<script src="{{ asset('style/assets/js/lib/data-table/datatables-init.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
$('#bootstrap-data-table-export').DataTable();
} );
</script>
@endsection