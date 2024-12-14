<?php
session_start();
error_reporting(0);

if ($_SESSION['logged_in'] !== true || $_SESSION['username'] !== 'admin') {
    $_SESSION['error'] = 'Please fill in the username and password';
    header("Location: index.php");
    exit();
}

$url = $_POST['url'];
$error_message = '';
$page_content = '';

if (isset($url)) {
    if (!preg_match('/^https:\/\//', $url)) {
        $error_message = 'Invalid URL, only https allowed';
    } else {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $page_content = curl_exec($ch);
        if ($page_content === false) {
            $error_message = 'Failed to fetch the URL content';
        }
        curl_close($ch);
    }
}
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Welcome</title>
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
            content: '';
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
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .login-container h2 {
            margin-bottom: 1.5rem;
            color: #333;
            font-weight: bold;
        }

        .login-container input[type='text'] {
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

        .login-container input[type='text']:focus {
            border-color: #4CAF50;
            box-shadow: 0px 0px 5px rgba(76, 175, 80, 0.5);
        }

        .login-container button {
            width: 100%;
            padding: 0.75rem;
            margin-top: 1rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            position: relative;
            overflow: hidden;
        }

        .login-container button:hover {
            background-color: #45a049;
            transform: translateY(-3px);
        }

        .login-container button:active {
            transform: translateY(1px);
        }

        .login-container p {
            margin-top: 1rem;
            color: #666;
            font-size: 0.9rem;
        }

        .error {
            color: red;
            margin-top: 0.5rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .content {
            margin-top: 1rem;
            padding: 1rem;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            word-wrap: break-word;
            max-height: 200px;
            overflow-y: auto;
        }
    </style>
</head>
<body>

<div class='login-container'>
    <h2>Welcome</h2>
    <p>网页查看，just do it😎</p>
    <form method='post' action=''>
        <input type='text' name='url' placeholder='Enter URL' required>
        <button type='submit'>Submit</button>
        <?php if (!empty($error_message)) : ?>
            <div class='error'><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>
    </form>
    <?php if (!empty($page_content)) : ?>
        <div class='content'>
            <?= nl2br(htmlspecialchars($page_content)); ?>
        </div>
    <?php endif; ?>
</div>
</body>
</html>