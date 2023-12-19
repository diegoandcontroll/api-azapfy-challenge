<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Download</title>
    <style>
        body {
            background-color: #F0F0F0;
            color: #111;
            font-family: 'Arial', sans-serif;
            text-align: center;
            padding: 40px;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
        }

        .download-button {
            display: inline-block;
            padding: 15px 30px;
            font-size: 18px;
            text-decoration: none;
            color: #fff;
            background-color: #333;
            border-radius: 6px;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .download-button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/banner.png') }}" alt="Banner">
        </div>

        <div class="info-box">
            <h1>Download da sua nota 🥳</h1>
            <p>Clique no botão abaixo para baixar o seu arquivo.</p>
            <a href="{{ $download_url }}" class="download-button" download target="_blank">Baixar Arquivo</a>
        </div>
    </div>
</body>
</html>
