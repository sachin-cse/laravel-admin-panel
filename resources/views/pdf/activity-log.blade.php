<!DOCTYPE html>
<html>
<head>
    <title>Activity Log PDF</title>
</head>
<body>
    <h1>Activity Log</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Current Logged ID</th>
                <th>IP Address</th>
                <th>User Type</th>
                <th>User Name</th>
                <th>Device Access</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ $data['current_logged_id'] }}</td>
                <td>{{ $data['ip_address'] }}</td>
                <td>{{ $data['user_type'] }}</td>
                <td>{{ $data['user_name'] }}</td>
                <td>{{ $data['device_access'] }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
