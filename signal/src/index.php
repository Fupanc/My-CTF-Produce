<?php
session_start();
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登录</title>
    <style>
        body {
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #6dd5ed, #2193b0);
            font-family: Arial, sans-serif;
            overflow: hidden;
            position: relative;
        }

        body::before, body::after {
            content: "";
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: float 6s ease-in-out infinite;
            z-index: 0;
        }

        body::before {
            top: -100px;
            right: -150px;
        }

        body::after {
            bottom: -150px;
            left: -100px;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(20px); }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 350px;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .login-container h2 {
            margin-bottom: 1.5rem;
            color: #333;
            font-weight: bold;
        }

        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin: 0.5rem 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s ease;
        }

        .login-container input[type="text"]:focus,
        .login-container input[type="password"]:focus {
            border-color: #4CAF50;
            box-shadow: 0px 0px 5px rgba(76, 175, 80, 0.5);
        }

        .login-container input[type="submit"] {
            width: 100%;
            padding: 0.8rem;
            margin-top: 1rem;
            background-color: #4CAF50; 
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 0px 4px 8px rgba(76, 175, 80, 0.3);
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        }

        .login-container input[type="submit"]:hover {
            background-color: #388E3C; 
            transform: translateY(-2px);
            box-shadow: 0px 6px 12px rgba(56, 142, 60, 0.5);
        }

        .login-container input[type="submit"]:active {
            transform: translateY(1px);
        }

        .login-container p {
            margin-top: 1rem;
            color: #666;
            font-size: 0.9rem;
        }

        .status-message {
            color: black;
        }

        .error-message {
            color: red;
            font-size: 1rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
<div class="login-container">
    <form action="StoredAccounts.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
<p class="status-message"><?php echo $_SESSION['error']; ?></p>
</div>
</body>
</html>
