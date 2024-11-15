<!-- navbar.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        /* Estilos para la barra de navegación fija */
        .navbar {
            background-color: #4a624f; /* Verde musgo */
            overflow: hidden;
            position: fixed;
            top: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }
        .navbar a {
            color: #f2f2f2;
            text-align: center;
            padding: 10px 16px;
            text-decoration: none;
            font-weight: bold;
        }
        .navbar a:hover {
            background-color: #3e5444;
            color: white;
        }
        .navbar .left {
            display: flex;
        }
        .navbar .right {
            display: flex;
            margin-right: 20px; /* Ajusta este valor para mover el botón hacia la izquierda */
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="left">
            <a href="/HojaDeRutaElectronica/home.php">Inicio</a>
        </div>
        <div class="right">
            <a href="/HojaDeRutaElectronica/logout.php">Cerrar Sesion</a>
        </div>
    </div>
</body>
</html>
