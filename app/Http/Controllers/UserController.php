<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $datas = User::all();
        
        return view('admin.user.table', [
            'users' => $datas
        ]);
    }

    public function admin($id){
        $data = User::find($id);
        
        $data->update([
            'role' => 'admin'
        ]);

        return redirect('user');
    }

    public function editor($id){
        $data = User::find($id);
        
        $data->update([
            'role' => 'editor'
        ]);

        return redirect('user');
    }
}
