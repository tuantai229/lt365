<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu tài khoản LT365</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            font-family: 'Pacifico', cursive;
            font-size: 32px;
            color: #4f46e5;
            margin-bottom: 10px;
        }
        .title {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .content {
            margin-bottom: 30px;
        }
        .button {
            display: inline-block;
            background-color: #4f46e5;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            margin: 20px 0;
        }
        .button:hover {
            background-color: #3730a3;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 14px;
            color: #666;
        }
        .warning {
            background-color: #fef3cd;
            border: 1px solid #faebcd;
            color: #664d03;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">LT365</div>
            <h1 class="title">Yêu cầu đặt lại mật khẩu</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <p>Xin chào,</p>
            
            <p>Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>
            
            <div style="text-align: center;">
                <a href="{{ $resetUrl }}" class="button">Đặt lại mật khẩu</a>
            </div>
            
            <div class="warning">
                <strong>Lưu ý:</strong> Liên kết đặt lại mật khẩu này sẽ hết hạn sau {{ config('auth.passwords.users.expire') }} phút.
            </div>
            
            <p>Nếu bạn không yêu cầu đặt lại mật khẩu, bạn không cần thực hiện thêm hành động nào.</p>
            
            <p>Nếu bạn gặp sự cố khi nhấp vào nút "Đặt lại mật khẩu", hãy sao chép và dán URL bên dưới vào trình duyệt web của bạn:</p>
            <p style="word-break: break-all; background-color: #f8f9fa; padding: 10px; border-radius: 4px; font-family: monospace;">
                {{ $resetUrl }}
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>LT365 - Nền tảng học tập trực tuyến hàng đầu</strong></p>
            <p>📧 Email: support@lt365.com | 📞 Hotline: 0987 654 321</p>
            <p>🌐 Website: <a href="https://lt365.com">https://lt365.com</a></p>
            <p style="margin-top: 15px; font-size: 12px;">
                © 2025 LT365. Tất cả quyền được bảo lưu.<br>
                Email này được gửi tự động, vui lòng không trả lời email này.
            </p>
        </div>
    </div>
</body>
</html>
