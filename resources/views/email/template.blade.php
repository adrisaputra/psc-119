<!DOCTYPE html>
<html>
    <head>
        <title>Email</title>
    </head>
    <body>
    
    @if ($email_data['action'] == 'verification')

        <h1>This is email account activation</h1>
        <p> 
            Hi, {{ $email_data['name'] }} , thanks for register on PSC 119 Dinas Kesehatan Kota BauBau
            <br>Please klik link below for activate your account Apps</p>
        <hr>
        {{ url('/email_verification?token='.$email_data['token'].'&email='.$email_data['email']) }}
        
    @else
        <h1>This is email reset password</h1>
        <p> 
            Hi, {{ $email_data['name'] }} , we reset your password
            <br>This your new password :</p>
            <h1>{{ $email_data['password'] }}
        <hr>

    @endif
    
    </body>
</html> 