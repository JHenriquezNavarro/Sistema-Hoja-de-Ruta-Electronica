<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['usuario_id'] = $user['id'];
        $_SESSION['privilegio'] = $user['privilegio'];
        header("Location: home.php");
        exit();
    } else {
        $error_message = "Credenciales incorrectas. Int�ntelo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesi�n</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #ffffff;
            border: 2px solid #4a624f; /* Verde musgo */
            border-radius: 8px;
            padding: 20px 30px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .login-header {
            text-align: center;
            color: #4a624f; /* Verde musgo */
            margin-bottom: 20px;
        }
        .login-header h2 {
            margin: 0;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            color: #4a624f;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input:focus {
            border-color: #4a624f;
            outline: none;
        }
        .btn {
            background-color: #4a624f;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }
        .btn:hover {
            background-color: #3e5444;
        }
        .register-link {
            text-align: center;
            margin-top: 10px;
        }
        .register-link a {
            text-decoration: none;
            color: #4a624f;
            font-weight: bold;
        }
        .register-link a:hover {
            color: #3e5444;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <h2>Inicio de Sesi�n</h2>
        </div>
        <?php if (isset($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Contrase�a:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Iniciar Sesi�n</button>
        </form>
        <div class="register-link">
            <p>�No tienes una cuenta? <a href="register.php">Reg�strate aqu�</a></p>
        </div>
    </div>
</body>
</html>
