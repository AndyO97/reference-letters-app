<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use App\Models\ReferenceLetter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ReferenceLetterController extends Controller
{
    public function show($token)
    {
        $invitation = Invitation::where('token', $token)->where('completed', false)->firstOrFail();
        //return $invitation;
        $student = User::findOrFail($invitation->sender_id);
        //return $student;
        return view('accept-invitation', compact('student', 'token'));
    }

    public function store(Request $request, $token)
    {
        
        $request->validate([
            'relationship' => 'required|string',
            'comments' => 'nullable|string',
            'reference_file' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'supporting_documents.*' => 'file|mimes:pdf,doc,docx,jpg,png|max:2048',
        ]);
        //return "store";

        $invitation = Invitation::where('token', $token)->where('completed', false)->firstOrFail();
        $student = User::findOrFail($invitation->sender_id);
        //return $student;

        // Store the reference file
        //$referenceFilePath = $request->file('reference_file')->store('reference_letters');

        // Store supporting documents
        $supportingDocumentsPaths = [];
        if ($request->hasFile('supporting_documents')) {
            foreach ($request->file('supporting_documents') as $file) {
                $supportingDocumentsPaths[] = $file->store('supporting_documents', 'public');
            }
        }

        DB::transaction(function () use ($request, $invitation, $student, $supportingDocumentsPaths) {
            // Save the reference letter information
            $referenceLetter = ReferenceLetter::create([
                'student_id' => $student->id,
                'student_email' => $student->email,
                'professor_email' => $invitation->email,
                'professor_id' => $invitation->receiver_id,
                'relationship' => $request->input('relationship'),
                'comments' => $request->input('comments'),
                'reference_file_path' => $request->file('reference_file')->store('reference_files', 'public'),
                'supporting_documents' => json_encode($supportingDocumentsPaths),
                'submitted_at' => now(),
                'invitation_id' => $invitation->id,
            ]);

            $invitation->update(['completed' => true]);
        });

        //return redirect()->route('home')->with('success', 'Reference letter submitted successfully.');
        return redirect()->route('reference.success');
    }

    public function success()
    {
        return view('invitation-completed');
    }

    public function index($studentId)
    {
        $student = User::findOrFail($studentId);
        //$referenceLetters = ReferenceLetter::where('student_id', $studentId)->get();

        $referenceLetters = ReferenceLetter::where('student_id', $studentId)
        ->join('invitations', 'reference_letters.invitation_id', '=', 'invitations.id')
        ->select('reference_letters.*', 'invitations.created_at as invitation_created_at')
        ->get();

        return view('reference_letters.index', compact('student', 'referenceLetters'));
    }

    public function showReferenceLetter($id)
    {
        $referenceLetter = ReferenceLetter::findOrFail($id);

        $invitationCreatedAt = Invitation::where('id', $referenceLetter->invitation_id)
                                      ->value('created_at');

        return view('reference_letters.show', compact('referenceLetter', 'invitationCreatedAt'));
    }

}

