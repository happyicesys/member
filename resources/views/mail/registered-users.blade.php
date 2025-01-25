<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>User List</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date of Birth</th>
                <th>Country Code</th>
                <th>Phone Number</th>
                <th>Created At</th>
                <th>Reference ID</th>
                <th>Member ID</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->dob)->format('Y-m-d') }}</td>
                    <td>{{ $user->phoneCountry->phone_code ?? 'N/A' }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d H:i:s') }}</td>
                    <td>{{ $user->ref_id }}</td>
                    <td>{{ $user->id }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
