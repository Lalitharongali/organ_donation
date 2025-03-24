<?php
session_start();
require 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT id, username, password_hash FROM users WHERE email = :email");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        } else {
            $message = "Invalid email or password!";
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: linear-gradient(90deg, #e2e2e2, #c9d6ff);
            padding: 20px;
        }

        .container {
            position: relative;
            width: 800px;
            max-width: 90%;
            height: 500px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            display: flex;
            overflow: hidden;
        }

        .form-box {
            width: 50%;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h1 {
            font-size: 28px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .input-box {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .input-box input {
            width: 100%;
            padding: 12px 40px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
        }

        .input-box i {
            position: absolute;
            left: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #777;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background:#7494ec;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #3700b3;
        }

        .toggle-box {
            width: 50%;
            background-color: #7494ec;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 40px;
            border-radius: 0 12px 12px 0;
            clip-path: polygon(40% 0, 100% 0, 100% 100%, 40% 100%, 0% 50%);
        }

        .toggle-panel h1 {
            font-size: 24px;
        }

        .toggle-panel p {
            font-size: 14px;
            margin-bottom: 20px;
        }

        .toggle-panel .btn {
            background: transparent;
            border: 2px solid #fff;
            color: #fff;
            padding: 10px 20px;
        }

        .toggle-panel .btn:hover {
            background: #fff;
            color: #7494ec;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-box login">
            <form action="login.php" method="POST">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="email" placeholder="Email" name="email" required>
                    <i class='bx bxs-envelope'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="password"required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>New Here?</h1>
                <p>Don't have an account?</p>
                <button class="btn register-btn" onclick="window.location.href='signup.php';">Signup</button>
            </div>
        </div>
    </div>
</body>
</html>
