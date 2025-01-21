<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceLetter extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'student_email',
        'professor_id',
        'professor_email',
        'relationship',
        'comments',
        'reference_file_path',
        'supporting_documents',
        'invitation_id',
    ];

    protected $casts = [
        'supporting_documents' => 'array',
    ];
}

