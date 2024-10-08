<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\App;


class ChangePasswordController extends Controller
{
    public function show()
    {
        return view('admin.settings.change-password');
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => __('password.current_password_incorrect')]);
        }

        Auth::user()->update(['password' => Hash::make($request->new_password)]);

        return back()->with('status', __('password.updated_successfully'));
    }


}
