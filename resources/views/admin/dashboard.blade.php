<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Admin Dashboard</h2>

    <!-- Users Table -->
    <h3 class="mt-4">Users</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Is Admin</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->username }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->isAdmin ? 'Yes' : 'No' }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.users.delete', $user->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                    @if (!$user->isAdmin)
                        <form method="POST" action="{{ route('admin.users.promote', $user->id) }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Make Admin</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Invitations Table -->
    <h3 class="mt-4">Invitations</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Sender Id</th>
            <th>Recipient Email</th>
            <th>Subject</th>
            <th>Body</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($invitations as $invitation)
            <tr>
                <td>{{ $invitation->id }}</td>
                <td>{{ $invitation->sender_id ?? 'N/A' }}</td>
                <td>{{ $invitation->email ?? 'N/A' }}</td>
                <td>{{ $invitation->subject ?? 'N/A' }}</td>
                <td>{{ $invitation->body ?? 'N/A' }}</td>
                <td>{{ $invitation->created_at ?? 'N/A' }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.invitations.delete', $invitation->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Reference Letters Table -->
    <h3 class="mt-4">Reference Letters</h3>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Student</th>
            <th>Referee Email</th>
            <th>Relationship</th>
            <th>Comments</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($referenceLetters as $referenceLetter)
            <tr>
                <td>{{ $referenceLetter->id ?? 'N/A' }}</td>
                <td>{{ $referenceLetter->student_id ?? 'N/A' }}</td>
                <td>{{ $referenceLetter->professor_email ?? 'N/A' }}</td>
                <td>{{ $referenceLetter->relationship ?? 'N/A' }}</td>
                <td>{{ $referenceLetter->comments ?? 'N/A' }}</td>
                <td>{{ $referenceLetter->created_at ?? 'N/A' }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.reference_letters.delete', $referenceLetter->id) }}" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>