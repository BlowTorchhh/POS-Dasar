@extends('main')
@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            @if($errors->any())
                @foreach($errors->all() as $err)
                <p class="alert alert-danger">{{ $err }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </p>
                @endforeach
                @endif
            <div class="card">
                <div class="card-header">
                    <div class="pull-left">
                        <strong>Tambah User</strong>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <form action="{{ url('add_ad_process') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Nama <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="{{ old('name') }}" />
                                </div>
                                 <div class="form-group">
                                    <label>Username <span class="text-danger">*</span></label>
                                    <input class="form-control" type="username" name="username" value="{{ old('username') }}" />
                                 </div>
                                 <div class="form-group">
                                    <label>Password <span class="text-danger">*</span></label>
                                    <input class="form-control" type="password" name="password" id="id_password"/>
                                    <i class="fa fa-eye" id="togglePassword" style="float: right;
                    margin-top: -25px;
                    position: relative;
                    z-index: 2;"></i>
                                 </div>
                                 @if (auth()->user()->level == "1")
                                <div class="form-group">
                                <label>Level</label>
                                <select name="level" class="form-control">
                                    <option hidden value="2">Pilih Level</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                                @endif
                                    <button type="submit" class="btn btn-primary ">Tambah</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#id_password');
      
        togglePassword.addEventListener('click', function (e) {
          // toggle the type attribute
          const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
          password.setAttribute('type', type);
          // toggle the eye slash icon
          this.classList.toggle('fa-eye-slash');
      });
      </script>
@endsection