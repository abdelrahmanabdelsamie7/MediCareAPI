<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>رد الإدارة على استفسارك</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            padding: 40px 20px;
            margin: 0;
            color: #333;
            direction: rtl;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #007bff;
        }

        .body-text {
            font-size: 16px;
            line-height: 1.7;
        }

        .reply-content {
            margin: 25px 0;
            background-color: #f0f8ff;
            padding: 20px;
            border-right: 5px solid #007bff;
            border-radius: 8px;
            font-size: 16px;
        }

        .footer {
            margin-top: 35px;
            font-size: 14px;
            color: #666;
        }

        @media (max-width: 600px) {
            .email-container {
                padding: 20px;
            }

            .header {
                font-size: 20px;
            }

            .reply-content {
                padding: 15px;
                font-size: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            مرحبًا {{ $contact->name }}،
        </div>

        <div class="body-text">
            <p>شكرًا لتواصلك معنا. نود إعلامك أن الإدارة قد قامت بالرد على استفسارك:</p>

            <div class="reply-content">
                {{ $contact->reply }}
            </div>

            <p>إذا كان لديك أي استفسارات إضافية، لا تتردد في التواصل معنا في أي وقت.</p>
        </div>

        <div class="footer">
            مع تحياتنا،<br>
            فريق الدعم الفني
        </div>
    </div>
</body>

</html>
