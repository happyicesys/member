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
        2 days ago registered users: {{ $data['totals']['last_2_days'] }}<br>
        3 days ago registered users: {{ $data['totals']['last_3_days'] }}<br>
        Total active users: {{ $data['totals']['total_active_users'] }}<br>
        Total Cornetto Redeemed: {{ $data['totals']['free_cornetto_claimed'] }} <br>
    </p>
    <p>
        Yesterday New Paid Gold Members: {{ $data['totals']['new_paid_gold_users'] }}<br>
        Total Active Paid Gold Members: {{ $data['totals']['total_paid_gold_users'] }}<br>
    </p>
    <p>
        SMS Credit Balance: {{ $data['sms_credit_balance'] }}<br>
    </p>
    <p>
        Yesterday - Avg SMS Credit per Sign Up: {{ $data['avg_credit_per_user'] }}<br>
    </p>

    <p>Regards,<br>DCVend System</p>
</body>
</html>
