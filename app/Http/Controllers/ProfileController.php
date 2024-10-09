<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\App;

class ProfileController extends Controller
{
    public function show()
    {
        return view('settings.profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->bio = $request->input('bio');
        $user->save();

        return redirect()->back()->with('success', __('Updated Successfully'));
    }


}
