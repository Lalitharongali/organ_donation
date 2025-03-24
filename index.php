<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Organ Donation</title>
    <link rel="stylesheet" href="login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #c9d6ff, #e2e2e2);
        }

        .navbar {
            width: 100%;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #4a69bb;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar h2 {
            font-size: 26px;
            font-weight: 600;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
            transition: 0.3s;
        }

        .navbar a:hover {
            text-decoration: underline;
        }

        .navbar .btn {
            padding: 10px 20px;
            background: white;
            color: #4a69bb;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 500;
            transition: 0.3s;
        }

        .navbar .btn:hover {
            background: #dfe6e9;
        }

        .hero {
            text-align: center;
            padding: 100px 20px;
        }

        .hero h1 {
            font-size: 40px;
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 20px;
            color: #34495e;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 14px 28px;
            background: #4a69bb;
            color: white;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            transition: 0.3s;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            background: #1e3799;
        }

        .info-section {
            padding: 50px;
            text-align: center;
            background: white;
            border-radius: 12px;
            width: 80%;
            max-width: 900px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .info-section h2 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .info-section p {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h2>Organ Donation</h2>
        <div>
            <a href="index.php" class="btn">Home</a>
            <a href="about.html" class="btn">About Us</a>
            <a href="contact.html" class="btn">Contact Us</a>
            <a href="registration.php" class="btn">Register</a>

            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="logout.php" class="btn">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn">Login</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="hero">
        <h1>Save Lives Through Organ Donation</h1>
        <p>Your decision to donate can change someone's life forever.</p>
        <a href="search.php" class="btn">Search a Donor</a>
    </div>

    <div class="info-section">
        <h2>Why Donate Organs?</h2>
        <p>Thousands of people wait for a life-saving transplant. By donating, you give them a second chance at life.</p>
    </div>
</body>
</html>
