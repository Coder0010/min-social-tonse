<?php

namespace App\Http\Controllers;

use DB;
use Hash;
use Session;
use Exception;
use Illuminate\Http\Request;
use App\Http\Resources\MessageResource;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function editProfile()
    {
        return view('auth.profile');
    }

    public function updateProfile()
    {
        $this->validate(request(), [
            'name'  => 'required',
            'email' => 'min:6|max:28|unique:users,email,'.auth()->user()->id,
        ]);
        DB::beginTransaction();
        try {
            $loggedUser = auth()->user();
            $loggedUser->update([
                'name'  => request('name'),
                'email' => request('email'),
            ]);
            DB::commit();
            Session::flash('status', 'recored updated successfully');
        } catch (Exception $e) {
            DB::rollback();
            Session::flash("status", $e->getMessage());
        }
        return redirect()->route("home");
    }

    public function updatePassword()
    {
        $this->validate(request(), [
            'current_password' => 'required',
            'password'         => 'min:6|max:28|confirmed',
        ]);
        DB::beginTransaction();
        try {
            $loggedUser = auth()->user();
            $hash       = $loggedUser->password;
            $pas        = request('current_password');
            if (password_verify($pas, $hash)) {
                $loggedUser->update(['password' => Hash::make(request('password'))]);
                Session::flash('success', 'Password Successfully Updated');
            } else {
                Session::flash('danger', 'Old Password Is Wrong');
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            Session::flash("status", $e->getMessage());
        }
        return redirect()->route("home");
    }
}
