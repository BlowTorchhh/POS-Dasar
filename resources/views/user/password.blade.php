@extends('main')
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
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <strong>Profil</strong>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" readonly value="{{ Auth::user()->name }}" >
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text"  class="form-control" readonly value="{{ Auth::user()->username }}" >
                                </div>
                                <a href="{{ 'edit' }}" class="btn btn-primary">Edit Nama / Username</a>
                                <div class="mt-4">
                                    <a href="{{ 'pw' }}" class="btn btn-primary">Edit Password</a>
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection