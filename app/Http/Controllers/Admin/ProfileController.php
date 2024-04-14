<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use FileUploadTrait;

    public function edit(Request $request)
    {
        return view('admin.profile.profile', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => ['nullable', 'image', 'max:5000'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
        ]);

        $user = Auth::user();

        $imagePath = $this->uploadImage($request, 'avatar');

        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = isset($imagePath) ? $imagePath : $user->avatar;
        $user->save();

        toastr('Updated Successfully!', 'success');
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('cashier.home');
    }
}
