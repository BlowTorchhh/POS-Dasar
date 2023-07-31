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
                        <strong>Edit Password</strong>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <form action="{{ route('password.action') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label>Password Lama <span class="text-danger">*</span></label>
                                    <input class="form-control" name="old_password" type="password" id="id_password">
                                    <i class="fa fa-eye" id="togglePassword" style="float: right;
                    margin-top: -25px;
                    position: relative;
                    z-index: 2;"></i>
                                </div>
                                <div class="mb-3">
                                    <label>Password Baru<span class="text-danger">*</span></label>
                                    <input class="form-control" name="new_password" type="password" id="id_new_password">
                                    <i class="fa fa-eye" id="toggleNewPassword" style="float: right;
                    margin-top: -25px;
                    position: relative;
                    z-index: 2;"></i>
                                </div>
                                <div class="mb-3">
                                    <label>Konfirmasi Password Baru <span class="text-danger">*</span></label>
                                    <input class="form-control" name="new_password_confirmation" type="password" id="id_new_password2">
                                    <i class="fa fa-eye" id="toggleNewPassword2" style="float: right;
                    margin-top: -25px;
                    position: relative;
                    z-index: 2;"></i>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const toggleNewPassword = document.querySelector('#toggleNewPassword');
        const toggleNewPassword2 = document.querySelector('#toggleNewPassword2');
        const password = document.querySelector('#id_password');
        const passwordnew = document.querySelector('#id_new_password');
        const passwordnew2 = document.querySelector('#id_new_password2');

        togglePassword.addEventListener('click', function (e) {
          // toggle the type attribute
          const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
          password.setAttribute('type', type);
          // toggle the eye slash icon
          this.classList.toggle('fa-eye-slash');
      });

      toggleNewPassword.addEventListener('click', function (e) {
          // toggle the type attribute
          const type = passwordnew.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordnew.setAttribute('type', type);
          // toggle the eye slash icon
          this.classList.toggle('fa-eye-slash');
      });

      toggleNewPassword2.addEventListener('click', function (e) {
          // toggle the type attribute
          const type = passwordnew2.getAttribute('type') === 'password' ? 'text' : 'password';
          passwordnew2.setAttribute('type', type);
          // toggle the eye slash icon
          this.classList.toggle('fa-eye-slash');
      });
      
      </script>
@endsection