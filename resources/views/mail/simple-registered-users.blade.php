<!DOCTYPE html>
<html>
<head>
    <title>User List</title>
</head>
<body>
    <p>Hi,</p>

    <p>Please find the list of registered users attached as an Excel file. <br> </p>
    <p>
        Yesterday registered users: {{ $data['totals']['yesterday'] }}<br>
        Last 2 days registered users: {{ $data['totals']['last_2_days'] }}<br>
        Last 3 days registered users: {{ $data['totals']['last_3_days'] }}<br>
    </p>
    <p>
        SMS Credit Balance: {{ $data['sms_credit_balance'] }}<br>
    </p>

    <p>Regards,<br>DCVend System</p>
</body>
</html>
