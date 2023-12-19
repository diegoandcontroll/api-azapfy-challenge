<!DOCTYPE html>
<html>
<head>
    <title>Nota Fiscal</title>
    <style>
        /* Exemplo de estilização para a nota fiscal */
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            color: #333;
        }
        .content {
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #f9f9f9;
        }
        /* Adicione mais estilos conforme necessário */
    </style>
</head>
<body>
    <div class="header">
        <h1>Nota Fiscal</h1>
    </div>
    <div class="content">
        <p><strong>Amount:</strong> {{ $amount }}</p>
        <p><strong>Emission Date:</strong> {{ $emission_date }}</p>
        <p><strong>Sender CNPJ:</strong> {{ $sender_cnpj }}</p>
        <p><strong>Sender Name:</strong> {{ $sender_name }}</p>
        <p><strong>Transporter CNPJ:</strong> {{ $transporter_cnpj }}</p>
        <p><strong>Transporter Name:</strong> {{ $transporter_name }}</p>
        <p><strong>User ID:</strong> {{ $user_id }}</p>
        <!-- Adicione mais detalhes conforme necessário -->
    </div>
</body>
</html>
