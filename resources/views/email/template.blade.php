<!DOCTYPE html>
<html>
    <head>
        <title>Email</title>
    </head>
    <body>
    
    @if ($email_data['action'] == 'verification')

        <h1>Ini adalah aktivasi akun PSC 119</h1>
        <p> 
            Hi, {{ $email_data['name'] }} , Terima kasih telah mendaftar di PSC 119 Dinas Kesehatan Kota BauBau
            <br>Silakan klik tautan di bawah ini untuk mengaktifkan akun Anda</p>
        <hr>
        {{ url('/email_verification?token='.$email_data['token'].'&email='.$email_data['email']) }}
        
    @else
        <h1>Ini adalah email reset password</h1>
        <p> 
            Hi, {{ $email_data['name'] }} , Kami mengatur ulang kata sandi Anda
            <br>Ini adalah password baru anda :</p>
            <h1>{{ $email_data['password'] }}
        <hr>

    @endif
    
    </body>
</html> 