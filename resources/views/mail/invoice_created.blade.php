<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Geração da Nota Fiscal</title>
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

        .header {
            margin-bottom: 40px;
        }

        .header img {
            max-width: 100%;
            height: auto;
        }

        .info-box {
            background-color: #333;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .info-box h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }

        .info-box p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .info-box ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            text-align: left;
        }

        .info-box ul li {
            font-size: 16px;
            margin-bottom: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/banner.png') }}"
                alt="Banner">
        </div>

        <div class="info-box" style="color: #fff">
            <h1  style="color: #fff">Geração da sua nota fiscal</h1>
            <p>Seu pedido foi processado e a nota fiscal está sendo gerada.</p>
        </div>
    </div>
</body>

</html>
