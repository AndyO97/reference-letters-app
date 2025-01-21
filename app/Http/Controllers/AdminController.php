<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invitation;
use App\Models\ReferenceLetter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->isAdmin) {
                return redirect()->route('admin.dashboard');
            }

            Auth::logout();
            return redirect()->route('admin.login')->withErrors('Access denied: Only administrators can log in.');
        }

        return back()->withErrors('Invalid email or password.');
    }

    public function dashboard()
    {
        return view('admin.dashboard', [
            'users' => User::all(),
            'invitations' => Invitation::all(),
            'referenceLetters' => ReferenceLetter::all(),
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.dashboard')->with('success', 'User deleted successfully.');
    }

    public function promoteUser($id)
    {
        $user = User::findOrFail($id);
        $user->isAdmin = true;
        $user->save();
        return redirect()->route('admin.dashboard')->with('success', 'User promoted to admin successfully.');
    }

    public function deleteInvitation($id)
    {
        $invitation = Invitation::findOrFail($id);
        $invitation->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Invitation deleted successfully.');
    }

    public function deleteReferenceLetter($id)
    {
        $letter = ReferenceLetter::findOrFail($id);
        $letter->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Reference letter deleted successfully.');
    }
}
