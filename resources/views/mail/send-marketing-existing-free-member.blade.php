<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Member Benefits Update</title>
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
                            Dear {{ $user->name }},
                        </td>
                    </tr>

                    <!-- Description -->
                    <tr>
                        <td style="padding: 10px 0px 20px 0px; font-size: 16px; color: #555; text-align: left;">
                            We're excited to introduce to you <strong>2 major updates</strong> to our member benefits:
                        </td>
                    </tr>

                    <!-- Updates Section -->
                    <tr>
                        <td style="font-size: 16px; color: #333; padding-bottom: 10px;">
                            <strong>First Updates</strong> – Unlimited Discount Times
                            <ul style="margin-top: 10px;">
                                <li><strong>Free member</strong>: <u>Unlimited</u> times of 15% discount</li>
                                <li><strong>Gold member</strong>: <u>Unlimited</u> times of 30% discount</li>
                            </ul>
                        </td>
                    </tr>

                    <tr>
                        <td style="font-size: 16px; color: #333; padding-bottom: 10px;">
                            <strong>Second Updates</strong> – New monthly voucher program
                            <ul style="margin-top: 10px;">
                                <li><strong>Free Members</strong>: Receive 2 x $1 vouchers every month.</li>
                                <li><strong>Gold Members</strong>: Enjoy 4 x $1 vouchers every month.</li>
                            </ul>
                        </td>
                    </tr>

                    <!-- Promo Image -->
                    <tr>
                        <td align='center' style="padding: 20px 0;">
                            <img src="{{asset('/images/components/send_marketing_existing_free_member_promo.png')}}" alt="Promo Image" style="max-width:100%;">
                        </td>
                    </tr>

                    <!-- Additional Info -->
                    <tr>
                        <td style="font-size: 14px; color: #555; text-align: center; padding-bottom: 20px;">
                            These vouchers can be used on any purchases above $5, on top of the existing 15% or 30% discount – giving you more reasons to enjoy our offerings.
                        </td>
                    </tr>

                    <!-- How It Works -->
                    <tr>
                        <td style="font-size: 14px; color: #333;">
                            <strong>How It Works:</strong>
                            <ol style="margin-top: 10px; padding-left: 20px;">
                                <li><strong>Automatic Delivery:</strong> Log into <a href="https://dcvend.com" style="color:#dc2626;">DCVend</a> account at our vending machine to view the vouchers</li>
                                <li><strong>Easy Redemption:</strong> Apply them at checkout to save instantly</li>
                                <li><strong>Auto Replenish:</strong> Vouchers will be auto replenished every 30-days</li>
                            </ol>
                        </td>
                    </tr>

                    <!-- CTA Button -->
                    <tr>
                        <td align='center' style="padding: 30px 0;">
                            <a href="{{ route('plan.index') }}" target="_blank">
                                <img src="{{ asset('/images/components/send_marketing_existing_free_member_cta_2.png') }}" alt="Sign Up Now" style="max-width:300px;">
                            </a>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding-top: 10px; font-size: 14px; color: #999;" align="center">
                            Thank you for being a valued member of DCVend.<br>
                            – The DCVend Team
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>

</body>
</html>
