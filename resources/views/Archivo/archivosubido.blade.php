<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Source Sans Pro', Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }

        .card {
            background: #ffffff;
            border-radius: 8px;
            padding: 20px;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: #007bff;
            color: #fff;
            padding: 10px;
            border-radius: 6px 6px 0 0;
            font-size: 18px;
            font-weight: bold;
        }

        .card-body {
            padding: 15px;
            color: #343a40;
        }

        .highlight {
            color: #28a745;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-header">
            📂 Sistema Seguimiento
        </div>
        <div class="card-body">
            <p>Se ha subido una nueva Bitacora al sistema:</p>
            <p class="highlight">{{ $filename }}</p>
            <p>Puedes revisarlo en tu panel de archivos.</p>
        </div>
        <div class="footer">
            <p>Este es un mensaje automático, por favor no responder.</p>
        </div>
    </div>
</body>

</html>