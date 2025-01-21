<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    public function show()
    {
        $users = User::all(); // Retrieve all users for the suggestions dropdown
        return view('invitation', compact('users'));
    }

    public function showPendingInvitations()
    {
        $userId = auth()->id(); // Get the logged-in user's ID
        $pendingInvitations = Invitation::where('sender_id', $userId)
                                        ->where('completed', false)
                                        ->get();

        return view('invitation-list', compact('pendingInvitations'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        $email = $request->email;
        $receiver = User::where('email', $email)->first();
        $token = bin2hex(random_bytes(16)); // Generate a unique token
        $completed = false;

        $invitation = Invitation::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $receiver?->id,
            'email' => $email,
            'subject' => $request->subject,
            'body' => $request->body,
            'token' => $token,
            'completed' => $completed,
        ]);

        // Send email using native `mail()` or a library like PHPMailer
        $to = $email;
        //$subject = $request->subject;
        //$message = $request->body . "\n\nUse this link to accept the invitation:\n" . url('/accept-invitation/' . $token);
        $headers = "From: no-reply@example.com";

        //mail($to, $subject, $message, $headers);

        // Use Laravel's Mail class to send the email
        Mail::raw($request->body ."\n\nUse this link to accept the invitation:\n" . url('/accept-invitation/' . $token), function ($message) use ($email, $request) {
            $message->to($email)
                    ->subject($request->subject);
        });

        return redirect()->route('invitation.show')->with('success', 'Invitation sent successfully.');
    }
}