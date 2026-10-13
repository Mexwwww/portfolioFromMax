<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Message from Portfolio</title>
    <style>
        body {
            background-color: #0d1117;
            color: #c9d1d9;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 40px 20px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #161b22;
            border: 1px solid #30363d;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.4);
        }
        .header {
            font-family: 'Fira Code', monospace;
            color: #58a6ff;
            font-size: 1.2rem;
            margin-top: 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #30363d;
            padding-bottom: 12px;
        }
        .sender-info {
            font-size: 0.95rem;
            color: #8b949e;
            margin-bottom: 20px;
            font-family: 'Fira Code', monospace;
        }
        .sender-info span {
            color: #c9d1d9;
        }
        .content-box {
            background: #0d1117;
            border: 1px solid #30363d;
            border-radius: 8px;
            padding: 20px;
            color: #c9d1d9;
            font-size: 1rem;
            line-height: 1.6;
            white-space: pre-wrap;
            word-break: break-word;
        }
        .footer {
            margin-top: 25px;
            text-align: center;
            font-size: 0.8rem;
            color: #484f58;
            font-family: 'Fira Code', monospace;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <h2 class="header">New Portfolio Message</h2>
        <div class="sender-info">
            From: <span>{{$senderEmail}}</span>[cite: 2]
        </div>
        <div class="content-box">
            {{$content}}[cite: 2]
        </div>
        <div class="footer">
            Sent via Max's Developer Portfolio Contact Form
        </div>
    </div>
</body>
</html>
