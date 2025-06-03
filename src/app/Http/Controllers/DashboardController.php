<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        if (!$user || !isset($user->role)) {
            #code ..
            abort(403,'tidak diizinkan akses halaman ini');
        }
        return $user->role == 'admin_it' ? view('dashboard.admin_it') :
               ($user->role == 'hrd' ? view('dashboard.hrd') :
               ($user->role == 'admin_hrd' ? view('dashboard.admin_hrd') :
            view('dashboard.employee')));
    }
}
