<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
       
        return view('user/notfound');
    }

    public function register()
    {
        $data['title'] = 'Register';
        return view('user/register', $data);
    }

    public function register_action(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:tb_user',
            'password' => 'required',
            'password_confirm' => 'required|same:password',
        ]);

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);
        $user->save();

        return redirect()->route('login')->with('status', 'Registrasi success. Silahkan login!');
    }


    public function login()
    {
        $data['title'] = 'Login';
        return view('user/login', $data);
    }

    public function login_action(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->level == '1') {
                return redirect()->intended('admin');
            }
            else if ($user->level == '2') {
                return redirect()->intended('user');
            }   
            return redirect()->intended('/');
        }



        return back()->withErrors([
            'password' => 'Username atau password salah',
        ]);
    }

    public function password()
    {
        $data['title'] = 'Change Password';
        return view('user/password', $data);
    }

    public function password_action(Request $request)
    {
        $request->validate([
            'old_password' => 'required|current_password',
            'new_password' => 'required|confirmed',
        ]);
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->new_password);
        $user->save();
        $request->session()->regenerate();
        return redirect('password')->with('status', 'Password berhasil diubah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function edit(){
        return view('user.edit');
    }

    public function edit_action(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:tb_user',
    ]);
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->username = $request->username;
        $user->save();
        $request->session()->regenerate();
        return redirect('password')->with('status', 'Nama / Username berhasil diubah!');
    }

    public function pw(){
        return view('user.pw');
    }

    public function user_ad(){
        $data = User::all();
        return view('user.user', ['data'=>$data]);
    }

    public function edit_ad($user_id)
    {
        $user = DB::table('tb_user')->where('user_id', $user_id)->first();
        return view('user.edit_admin', compact('user'));
    }

    public function edit_ad_process(Request $request, $user_id){
        try {
            $request->validate([
                'name' => 'required',
                'username' => 'required',
                'level' => 'required',
        ]);
            DB::table('tb_user')->where('user_id', $user_id)
            ->update([
                'name' => $request->name,
                'username' => $request->username,
                'level' => $request->level,
            ]);
        } catch (\Throwable $th) {
            return redirect('edit_admin/'.$user_id)->with('error', 'Username sudah ada!');
        }
        
        return redirect('users')->with('status', 'User Berhasil diedit!');
    }

    public function user_add(){
        return view('user.add');
    }

    public function user_add_process(Request $request){
        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:tb_user',
            'password' => 'required',
            'level' => 'required',
        ]);

        $user = new User([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'level' => $request->level,
        ]);
        $user->save();

        return redirect('users')->with('status', 'User baru berhasil ditambah!');
    }

    public function delete($user_id){
        DB::table('tb_user')->where('user_id', $user_id)->delete();
        return redirect('users')->with('status', 'User telah berhasil dihapus!');
    }
}
