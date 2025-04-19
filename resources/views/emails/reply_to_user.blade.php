<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>رد الإدارة على استفسارك</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
            color: #333;
        }

        .email-container {
            background-color: #ffffff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0px 2px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            font-size: 20px;
            margin-bottom: 15px;
            color: #007bff;
        }

        .reply-content {
            margin: 20px 0;
            background-color: #f0f8ff;
            padding: 15px;
            border-left: 4px solid #007bff;
            border-radius: 5px;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            مرحبًا {{ $contact->name }},
        </div>

        <p>شكرًا لتواصلك معنا. هذا هو رد الإدارة على استفسارك:</p>

        <div class="reply-content">
            {{ $contact->reply }}
        </div>

        <p>إذا كان لديك أي استفسارات إضافية، لا تتردد في التواصل معنا.</p>

        <div class="footer">
            مع تحياتنا،<br>
            فريق الدعم الفني
        </div>
    </div>
</body>

</html>
