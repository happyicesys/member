<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Membership Expiring Soon</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; padding: 30px; border-radius: 8px;">
                    <tr>
                        <td align='center'>
                            <img src="{{asset('/images/retention_email_banner.gif')}}" alt="Retention Email Banner">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="font-size: 22px; font-weight: bold; color: #333; padding:30px 0px 20px 0px;">
                            Hi {{ $user->name }},
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 35px 0; font-size: 16px; color: #555;">
                            Your Unlimited Plan of 30% discount has expired. Please subscribe to Gold Plan to enjoy 4 times of 30% discount (per month) to keep enjoying discount.
                        </td>
                    </tr>
                    <tr>
                        <td align='center'>
                            <a href="{{route('plan.index')}}" target="_blank">
                                <img src="{{asset('/images/components/email_cta_button.png') }}"  alt="Call to Action Button" style="max-width:300px;">
                            </a>
                        </td>
                        {{-- <td align="center" style="padding: 20px;">
                            <a href="https://dcvend.com/plan"
                               style="background-color: #fde047;
                                      border: 2px solid #dc2626;
                                      color: #dc2626;
                                      font-weight: bold;
                                      padding: 12px 24px;
                                      border-radius: 0.5rem;
                                      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                      margin-top: 32px;
                                      text-decoration: none;
                                      display: inline-block;">
                                Renew My Plan
                            </a>
                        </td> --}}
                    </tr>
                    <tr>
                        <td style="padding-top: 30px; font-size: 14px; color: #999;" align="center">
                            Thank you for choosing DCVend.<br>
                            The DCVend Team
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
