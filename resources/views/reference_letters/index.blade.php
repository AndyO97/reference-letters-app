<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Reference Letters</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<x-top-menu />
<div class="container mt-5">
    <h2>Completed Reference Letters for {{ $student->username }}</h2>

    @if ($referenceLetters->isEmpty())
        <p class="text-danger mt-3">This user doesn't have any completed reference letters.</p>
    @else
        <table class="table table-bordered mt-4">
            <thead>
            <tr>
                <th>Professor's Email</th>
                <th>Relationship</th>
                <th>Created At</th>
                <th>Completed At</th>
                <th>Details</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($referenceLetters as $letter)
                <tr>
                    <td>{{ $letter->professor_email }}</td>
                    <td>{{ $letter->relationship }}</td>
                    <td>{{ $letter->invitation_created_at  }}</td>
                    <td>{{ $letter->updated_at }}</td>
                    <td>
                        <a href="{{ route('reference_letters.show', $letter->id) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>
