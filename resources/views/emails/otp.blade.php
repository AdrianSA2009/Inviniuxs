<!DOCTYPE html>
<html>
<head>
    <title>Kode OTP Reset Password</title>
</head>
<body style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f8fafc; padding: 20px; color: #334155;">
    <div style="max-width: 500px; margin: 0 auto; bg-color: #ffffff; background: #ffffff; padding: 32px; rounded-width: 16px; border-radius: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
        <h2 style="color: #1e3a8a; margin-bottom: 16px; text-align: center;">Inviniux Security</h2>
        <p>Halo,</p>
        <p>Kami menerima permintaan untuk menyetel ulang kata sandi akun Anda. Gunakan kode OTP di bawah ini untuk melanjutkan proses reset password:</p>
        
        <div style="text-align: center; margin: 32px 0;">
            <span style="font-size: 32px; font-weight: bold; letter-spacing: 6px; color: #2563eb; background-color: #eff6ff; padding: 12px 24px; border-radius: 8px; border: 1px dashed #bfdbfe;">
                {{ $otp }}
            </span>
        </div>
        
        <p style="color: #64748b; font-size: 14px;">Kode OTP ini hanya berlaku selama <strong>5 menit</strong>. Jangan bagikan kode ini kepada siapa pun demi keamanan akun Anda.</p>
        <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 24px 0;">
        <p style="font-size: 12px; color: #94a3b8; text-align: center;">Menerima email ini karena Anda terdaftar sebagai staf sistem Inviniux.</p>
    </div>
</body>
</html>