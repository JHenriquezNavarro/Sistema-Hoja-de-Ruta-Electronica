<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #ffffff;
            border: 2px solid #4a624f;
            border-radius: 8px;
            padding: 20px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 800px;
        }
        .container h2 {
            color: #4a624f;
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 10px;
            vertical-align: top;
        }
        td label {
            font-weight: bold;
            color: #4a624f;
            display: block;
            margin-bottom: 5px;
        }
        td input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        td input:focus {
            border-color: #4a624f;
            outline: none;
        }
        .btn {
            background-color: #4a624f;
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            display: block;
            width: 100%;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #3e5444;
        }
        .link-login {
            display: block;
            text-align: center;
            margin-top: 15px;
            color: #4a624f;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
        }
        .link-login:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Registro de Usuario</h2>
        <form method="POST" action="register.php">
            <table>
                <tr>
                    <td>
                        <label for="grado">Grado</label>
                        <input type="text" id="grado" name="grado" required>
                    </td>
                    <td>
                        <label for="nombres">Nombres</label>
                        <input type="text" id="nombres" name="nombres" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="apellido_paterno">Apellido Paterno</label>
                        <input type="text" id="apellido_paterno" name="apellido_paterno" required>
                    </td>
                    <td>
                        <label for="apellido_materno">Apellido Materno</label>
                        <input type="text" id="apellido_materno" name="apellido_materno" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="codigo_funcionario">Código Funcionario</label>
                        <input type="text" id="codigo_funcionario" name="codigo_funcionario" required>
                    </td>
                    <td>
                        <label for="rut">RUT</label>
                        <input type="text" id="rut" name="rut" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="dotacion">Dotación</label>
                        <input type="text" id="dotacion" name="dotacion" required>
                    </td>
                    <td>
                        <label for="correo_institucional">Correo Institucional</label>
                        <input type="email" id="correo_institucional" name="correo_institucional" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="password">Contrasena</label>
                        <input type="password" id="password" name="password" required>
                    </td>
                    <td>
                        <label for="password_confirm">Confirmar Contraseña</label>
                        <input type="password" id="password_confirm" name="password_confirm" required>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn">Registrar</button>
        </form>
        <a href="login.php" class="link-login">¿Ya tienes una cuenta? Inicia sesión aquí</a>
    </div>
</body>
</html>
