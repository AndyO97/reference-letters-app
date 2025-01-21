<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete The Reference Letter Invitation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Complete The Reference Letter Invitation</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('reference.store', ['token' => $token]) }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="relationship" class="form-label">Relationship with Student</label>
            <input type="text" class="form-control" id="relationship" name="relationship" required>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">Student Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $student->username }}" readonly>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Student Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" readonly>
        </div>
        <div class="mb-3">
            <label for="comments" class="form-label">Comments</label>
            <textarea class="form-control" id="comments" name="comments" rows="5"></textarea>
        </div>
        <div class="mb-3">
            <label for="reference_file" class="form-label">Upload Reference Letter</label>
            <input type="file" class="form-control" id="reference_file" name="reference_file" required>
        </div>
        <div class="mb-3">
            <label for="supporting_documents" class="form-label">Upload Supporting Documents</label>
            <input type="file" class="form-control" id="supporting_documents" name="supporting_documents[]" multiple>
        </div>        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
