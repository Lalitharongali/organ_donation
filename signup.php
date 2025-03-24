<?php
require 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Passwords do not match!";
    } else {
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        try {
            $stmt = $conn->prepare("INSERT INTO users (username, email, phone, password_hash) VALUES (:username, :email, :phone, :password)");
            $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':phone' => $phone,
                ':password' => $passwordHash
            ]);

            $message = "Signup successful!";
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
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
            flex-direction: row-reverse;
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
            background: #7494ec;
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
            border-radius: 12px 0 0 12px;
            clip-path: polygon(0 0, 60% 0, 100% 50%, 60% 100%, 0 100%);
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
            <form action="signup.php" method="POST">
                <h1>Signup</h1>
                <div class="input-box">
                    <input type="text" placeholder="username" name="username" required>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="gmail" placeholder="Email" name="email"required>
                    <i class='bx bxl-gmail'></i>
                </div>
                <div class="input-box">
                    <input type="tel" placeholder="Phone number" name="phone"required>
                    <i class='bx bxs-phone' ></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Password" name="password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box">
                    <input type="password" placeholder="Re-enter Password" name="confirm_password" required>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn">Signup</button>
            </form>
        </div>
        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Already have an account?</p>
                <button class="btn register-btn" onclick="window.location.href='login.php';">Login</button>
            </div>
        </div>
    </div>
</body>
</html>
