<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reference Letter Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<x-top-menu />
<div class="container mt-5">
    <h2>Reference Letter Details</h2>
    <p><strong>Professor's Email:</strong> {{ $referenceLetter->professor_email }}</p>
    <p><strong>Relationship:</strong> {{ $referenceLetter->relationship }}</p>
    <p><strong>Invitation Sent At:</strong> {{ $invitationCreatedAt }}</p>
    <p><strong>Completed At:</strong> {{ $referenceLetter->updated_at }}</p>
    <p><strong>Comments:</strong></p>
    <p>{{ $referenceLetter->comments }}</p>

    <h4>Download Files</h4>
    <ul>
        <li>
            <a href="{{ asset('storage/' . $referenceLetter->reference_file_path) }}" download>
                Download Reference Letter
            </a>
        </li>
        @foreach (json_decode($referenceLetter->supporting_documents, true) ?? [] as $document)
            <li>
                <a href="{{ asset('storage/' . $document) }}" download>
                    Download Supporting Document
                </a>
            </li>
        @endforeach
    </ul>

    <a href="{{ route('reference_letters.index', $referenceLetter->student_id) }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
</body>
</html>
