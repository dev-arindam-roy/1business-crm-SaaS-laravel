<!DOCTYPE html>
<html lang="en">
<head>
  <title>1 Business CRM</title>
  <meta name="viewport" content="width=device-width">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
</head>
<body>
    <div style="width: 600px; height: auto; background-color: #f3f3f3; padding: 25px; border: 15px solid #d0d0d0;">
        <div style="text-align: center;">
            <h1><strong>1 Business CRM</strong></h1>
            <h3>Reset Your Password</h3>
            <hr/>
        </div>
        <div style="margin-top: 20px;">
            <p>Hi <strong>{{ $user->first_name }}</strong>, </p>
            <p>You can <strong>reset your password</strong> by clicking the below link.</p>
            <p style="margin-top: 20px;"><a href="{{ $resetPasswordLink }}" target="_blank" style="padding: 12px; background-color: #36c6d3; color: #fff; font-weight: 700; border-2px solid #ddd; border-radius: 6px; text-decoration: none;">Click Here! Reset Your Password</a></p>
            
            <p style="margin-top: 100px; margin-bottom: 50px;">
                Thanks & Regards, <br/>
                1 Business CRM Team.
                <br/>
                <br/><span><small><b>1BusinessCRM</b> is a Product, Developed By Creative Syntax Solutions Pvt. Ltd.</small></span>
                <br/><a href="http://creativesyntax.in">http://creativesyntax.in</a> | <a href="http://1businesscrm.in">http://1businesscrm.in</a>
            </p>
        </div>
    </div>
</body>
</html>
