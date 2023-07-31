@extends('main')
@section('tittle', 'Dashboard')

@section('breadcrumbs')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Product</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Product</li>
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
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success"></span> {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        @if (session('error'))
        <div class="col-sm-12">
            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success"></span> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Data Product</strong>
                </div>
                @if (auth()->user()->level == "1")
                <div class="pull-right">
                    <a href="{{ 'produk-add' }}" class="btn btn-success btn-sm">
                        <i class="fa fa-plus"></i> Add
                    </a>
                </div>
                @endif
            </div>
            <div class="card-body table-responsive">
                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Product</th>
                            <th>Kode Barang</th>
                            <th>Kategori</th>
                            <th>Merk</th>
                            <th>Harga Jual</th>
                            <th>Harga Beli</th>
                            <th>Stock</th>
                            @if (auth()->user()->level == "1")
                            <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $item)
                            <tr> 
                                <td>{{  $loop->iteration  }}</td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->kode }}</td>
                                <td>{{ $item->kategori->kategori }}</td>
                                <td>{{ $item->merk }}</td>
                                <td>{{ $item->formatRupiah('harga_jual') }}</td>
                                <td>{{ $item->formatRupiah('harga_beli')}}</td>
                                <td>{{ $item->stok }}</td>
                                @if (auth()->user()->level == "1")
                                <td class="text-center">
                                    <a href="{{url('produk/produk-edit',$item->id) }}" class="btn btn-primary btn-sm">edit</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#mediumModal">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </td>
                                @endif
                            </tr>
                    @endforeach
                    </tbody>
                </table>    
                {{ $data->links() }}
            </div>
        </div>
    </div>
</div> <!-- .content -->
@if ($count > 0)
<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Yakin Ingin Hapus Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
                <form action="{{ url('produk', $item->id) }}" method="POST" class="d-inline" >
                    @method('delete')
                    @csrf
                    
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger" ><i class="fa fa-trash"></i> Hapus data</button>
            </div>
        </div>
    </form>
    </div>
</div>
@endif
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