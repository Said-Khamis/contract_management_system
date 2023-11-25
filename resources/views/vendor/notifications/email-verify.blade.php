<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f0f0; padding: 20px;">
<table style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; border-collapse: collapse; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
    <tr>
        <td style="padding: 20px;">
            <h2 style="color: #333; text-align: center;">Registration Confirmation</h2>
            <p style="color: #666;">Hello {{ucfirst($user->first_name)}},</p>
            <p style="color: #666;">Thank you for registering with {{env('APP_NAME')}}. Your account has been created successfully. To set up your password, please click the link below to verify your email:</p>
            <p style="text-align: center;">
                <a href="{{$actionUrl}}" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none; border-radius: 5px;">Verify Email</a>
            </p>
            <p style="color: #666;">If you did not create this account, please ignore this email.</p>
            <p style="color: #666;">Thank you for choosing {{env('APP_NAME')}}!</p>
        </td>
    </tr>
</table>
</body>
</html>
