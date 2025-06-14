<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Upgrade to Gold Membership</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; padding: 20px;">

    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; padding: 30px; border-radius: 8px;">

                    <!-- Banner Image -->
                    <tr>
                        <td align='center'>
                            <img src="{{asset('/images/send_marketing_existing_free_member_2.gif')}}" alt="Membership Plans" style="max-width:100%;">
                        </td>
                    </tr>

                    <!-- Greeting -->
                    <tr>
                        <td align="center" style="font-size: 22px; font-weight: bold; color: #333; padding:30px 0px 10px 0px;">
                            Hi {{ $user->name }},
                        </td>
                    </tr>

                    <!-- Description -->
                    <tr>
                        <td style="padding: 10px 0px 30px 0px; font-size: 16px; color: #555; text-align: center;">
                            You’re currently enjoying <strong>FREE membership</strong> with 15% discount and 2 x $1 coupons/month.<br><br>
                            Want to save even more? Upgrade to <strong>GOLD Membership</strong> for <span style="color:#dc2626; font-weight: bold;">S$2.90/month</span> and get:
                            <ul style="text-align: left; max-width: 500px; margin: 20px auto; color: #333;">
                                <li><strong>30% discount</strong> on all products</li>
                                <li><strong>4 x FREE $1 coupons</strong> every month</li>
                                <li>Redeemable at any vending machine</li>
                            </ul>
                        </td>
                    </tr>

                    <!-- CTA Button -->
                    <tr>
                        <td align='center'>
                            <a href="{{ route('plan.index') }}" target="_blank">
                                <img src="{{ asset('/images/components/send_marketing_existing_free_member_cta_2.png') }}" alt="Upgrade Now" style="max-width:300px;">
                            </a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding-top: 30px; font-size: 14px; color: #999;" align="center">
                            Thank you for choosing DCVend.<br>
                            – The DCVend Team
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

</body>
</html>
