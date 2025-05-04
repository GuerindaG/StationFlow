<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="title">{{ $title }}</div>
    <div class="content">{{ $content }}</div>
</body>
</html>
