<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset Notification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f0f0; padding: 20px;">
<table style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; border-collapse: collapse; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <tr>
        <td style="padding: 20px;">
            <h2 style="color: #333; text-align: center;">Password Reset Notification</h2>
            <p style="color: #666;">Hello {{ $first_name }}   {{ $last_name }},</p>
            <p style="color: #666;">You have requested a password reset for your account. Please click the link below to reset your password:</p>
            <p style="text-align: center;">
                <a href="{{ $reset_url }}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Reset Password</a>
            </p>
            <p style="color: #666;">If you did not request this password reset, please ignore this email.</p>
            <p style="color: #666;">Thank you for using our service!</p>
        </td>
    </tr>
</table>
</body>
</html>
