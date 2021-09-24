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
            <h3>Please Verify Your Account</h3>
            <hr/>
        </div>
        <div style="margin-top: 20px;">
            <p>Hi <strong>{{ $user->first_name }}</strong>, </p>
            <p>Your account has been created successfully. Please click the below link and verify your account email address.</p>
            <p style="margin-top: 20px;"><a href="{{ $emailVerificationLink }}" target="_blank" style="padding: 12px; background-color: #36c6d3; color: #fff; font-weight: 700; border-2px solid #ddd; border-radius: 6px; text-decoration: none;">Click Here! Verify Your Account</a></p>
            <h4 style="margin-top: 20px;"><strong>Account Information</strong></h4>
            <hr/>
            <p><strong>Account Name:</strong> {{ $user->first_name . ' ' . $user->last_name }}</p>
            <p><strong>Business Name:</strong> {{ $user->businessInfo->business_name }}</p>
            <p>
                <strong>Business Account Login Link/URL:</strong> <br/>
                <a href="{{ route('auth.businessLogin', array('subdomain' => $user->subdomainInfo->name)) }}">{{ route('auth.businessLogin', array('subdomain' => $user->subdomainInfo->name)) }}</a>
            </p>
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
