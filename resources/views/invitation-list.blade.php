<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Invitations</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<x-top-menu />
<div class="container mt-5">
    <h2>Pending Invitations</h2>

    @if ($pendingInvitations->isEmpty())
        <p class="text-danger mt-3">This user doesn't have any pending invitations.</p>
    @else
        <table class="table table-bordered mt-4">
            <thead>
            <tr>
                <th>Email</th>
                <th>Subject</th>
                <th>Body</th>
                <th>Sent Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($pendingInvitations as $invitation)
                <tr>
                    <td>{{ $invitation->email }}</td>
                    <td>{{ $invitation->subject }}</td>
                    <td>{{ $invitation->body }}</td>
                    <td>{{ $invitation->created_at }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>
</body>
</html>
