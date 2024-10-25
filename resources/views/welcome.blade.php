<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API RestFul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            color: #ffffff;
            overflow: hidden;
            background: linear-gradient(135deg, #0F2027, #203A43, #2C5364);
        }

        .background-animation {
            position: absolute;
            width: 100%;
            height: 100%;
            background: url('https://media.giphy.com/media/Yl5aO3gdVfsQ0/giphy.gif') center center / cover no-repeat;
            opacity: 0.2;
            z-index: -1;
        }

        .container {
            height: calc(100% - 50px);
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.7);
            border: none;
            border-radius: 15px;
            padding: 2rem;
            color: #ffffff;
        }

        .card h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .card p {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }

        .btn-contact {
            background-color: #00d4ff;
            border-color: #00d4ff;
        }

        .btn-contact:hover {
            background-color: #00b7d4;
            border-color: #00b7d4;
        }

        footer {
            width: 100%;
            text-align: center;
            padding: 10px 0;
            background-color: rgba(0, 0, 0, 0.8);
            color: #ffffff;
            position: absolute;
            bottom: 0;
        }
    </style>
</head>
<body>
    <div class="background-animation"></div>
    <div class="container">
        <div class="card">
            <h1>API RestFul</h1>
            <p>Esta aplicación es una API RestFul y no posee rutas web accesibles. Si deseas utilizarla, por favor solicita la documentación al creador.</p>
            <a href="mailto:carlosehs.9319@gmail.com" class="btn btn-contact btn-lg">Solicitar Documentación</a>
        </div>
    </div>
    <footer>
        &copy; 2024 Todos los derechos reservados.
    </footer>
</body>
</html>
