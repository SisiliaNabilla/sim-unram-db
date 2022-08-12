<?php

namespace App\Http\Controllers;


use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function register_admin(){
    return view('register.register_admin');
    }

    public function simpan_data_admin_baru(Request $request){
        $request->validate([
            'email_admin'=>'required|unique:admins',
            'nama_admin'=>'required',
            'password'=>'required',
        ],[
            'email_admin.required'=>'Email tidak boleh kosong',
            'email_admin.unique'=>'Email tersebut sudah digunakan',
            'nama_admin.required'=>'Nama tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
        ]);
        $data_baru = new Admin();
        $data_baru->email_admin = $request->email_admin;
        $data_baru->nama_admin = $request->nama_admin;
        $data_baru->password = Hash::make($request->password);//$2y$10$x1vbIqOFyC4Cn7n8fYDPN.DuH2rLhpIYT4zaFiKMa8e9vVyIlVhbK
        $data_baru->save();
        $notification = array(
            'success' => 'Data Admin '.$request->nama_admin.' telah disimpan!',
        );
        return Redirect::to('register_admin')->with($notification);
    }

    public function login_admin(){
        return view('login.login_admin');
    }

    public function cek_login_admin(Request $request){
        $request->validate([
            'email_admin'=>'required',
            'password'=>'required',
        ],[
            'email_admin.required'=>'Email Admin tidak boleh kosong',
            'password.required'=>'Password tidak boleh kosong',
        ]);
        $cek_login = Admin::where('email_admin','=',$request->email_admin) ->first(); //baris ini ditujukan untuk mengecek email admin
        if($cek_login){
            if(Hash::check($request->password,$cek_login->password)){ //baris ini ditujukan untuk mengecek password
                $request->session()->put('LoggedAdmin',$cek_login->id); //session diberi tanda sebagai logged admin 
                return redirect('dashboard_admin'); //dan diarahkan ke function dashboard admin
            }else{
                $notification = array(
                    'error' => 'Password salah!',
                );
                return Redirect::to('login_admin')->with($notification);
            }
        }else{
            $notification = array(
                'error' => 'Email Admin tidak ditemukan!',
            );
            return Redirect::to('login_admin')->with($notification);
        }
    }

    public function dashboard_admin(){
        if (session()->has('LoggedAdmin')){ //pengecekan apakah yang mengakses dashboard admin sekarang session nya sebagai logged admin atau tidak
            //jika session nya sebagai logged admin maka akan dilakukan pengecekan terhadaap data admin yang bersangkutan berupa email admin, nama admin dan password, apakah ada atau tidak di dalam table admin
            $data_admin_untuk_dashboard = Admin::where('id','=',session('LoggedAdmin'))->first();
            $data = [ //variabel data adalah variabel yang digunakan sebagai variabel array yang nantinya berisi data data yang akan ditampilkan di view dashboard_admin
                'NamanyaAdmin'=>$data_admin_untuk_dashboard, //variabel NamanyaAdmin digunakan untuk menampung data email admin, nama admin, dan password yang telah ditemukan.
            ];
            return view('dashboard.dashboard_admin',$data);
        }else{ //jika session bukan sebagai logged admin maka akan menampilkan view login admin 
            return view('login.login_admin');
        }
    }

    public function logout_admin(){
        if (session()->has('LoggedAdmin')){
            session()->pull('LoggedAdmin'); //menghapus session yang sedang aktif sekarang 
            return redirect('login_admin'); 
        }else{
            return view('login.login_admin');
        }
    }
}

