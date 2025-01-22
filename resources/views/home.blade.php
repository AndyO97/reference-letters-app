<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<x-top-menu />
<div class="container mt-5">
    <h1>Welcome to the Reference Management App</h1>
    <p class="mt-3">As a student, you can perform the following actions:</p>
    <ul class="list-group mt-3">
        <li class="list-group-item">
            <strong>Send Invitations:</strong> 
            You can send reference letter invitations to your professors. Specify their email address, the subject, and include a personalized message.
            <br>
            <a href="{{ route('invitation.show') }}" class="btn btn-primary btn-sm mt-2">Send Invitations</a>
        </li>
        <li class="list-group-item">
            <strong>Browse Reference Letters:</strong> 
            View all the reference letters that have been completed for you. This includes information such as the professor's email, relationship, and submission date.
            <br>
            <a href="{{ route('reference_letters.index', auth()->id()) }}" class="btn btn-secondary btn-sm mt-2">Browse Reference Letters</a>
        </li>
        <li class="list-group-item">
            <strong>View Reference Letter Details:</strong> 
            Click on any reference letter to see more details, including comments, the actual reference letter document, and any supporting documents uploaded by the professor.
        </li>
    </ul>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
