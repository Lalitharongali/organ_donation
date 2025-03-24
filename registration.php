<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $blood_group = $_POST["blood_group"];
    $organs = $_POST["organs"];
    $diseases = trim($_POST["diseases"]);

    if (empty($diseases)) {
        try {
            $stmt = $conn->prepare("INSERT INTO donors (name, phone, email, city, state, blood_group, organs) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $phone, $email, $city, $state, $blood_group, $organs]);

            echo "<script>alert('Registration successful!'); window.location.href='registration.php';</script>";
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        }
    } else {
        echo "<script>alert('Registration failed: You have a medical history.');</script>";
    }
}

$conn = null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Organ Donation Registration</title>
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
            width: 400px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .input-box {
            width: 100%;
            margin-bottom: 15px;
        }

        .input-box input, 
        .input-box select, 
        .input-box textarea {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
        }

        .input-box textarea {
            resize: none;
            height: 80px;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Organ Donation Registration</h2>
        <form action="registration.php" method="POST">
            <div class="input-box">
                <input type="text" name="name" placeholder="Full Name" required>
            </div>
            <div class="input-box">
                <input type="tel" name="phone" placeholder="Phone Number" required>
            </div>
            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-box">
                <input type="text" name="city" placeholder="City" required>
            </div>
            <div class="input-box">
                <select name="state" required>
                <option value="AP">Andhra Pradesh</option>
                        <option value="AR">Arunachal Pradesh</option>
                        <option value="AS">Assam</option>
                        <option value="BR">Bihar</option>
                        <option value="CT">Chhattisgarh</option>
                        <option value="GA">Gujarat</option>
                        <option value="HR">Haryana</option>
                        <option value="HP">Himachal Pradesh</option>
                        <option value="JK">Jammu and Kashmir</option>
                        <option value="GA">Goa</option>
                        <option value="JH">Jharkhand</option>
                        <option value="KA">Karnataka</option>
                        <option value="KL">Kerala</option>
                        <option value="MP">Madhya Pradesh</option>
                        <option value="MH">Maharashtra</option>
                        <option value="MN">Manipur</option>
                        <option value="ML">Meghalaya</option>
                        <option value="MZ">Mizoram</option>
                        <option value="NL">Nagaland</option>
                        <option value="OR">Odisha</option>
                        <option value="PB">Punjab</option>
                        <option value="RJ">Rajasthan</option>
                        <option value="SK">Sikkim</option>
                        <option value="TN">Tamil Nadu</option>
                        <option value="TG">Telangana</option>
                        <option value="TR">Tripura</option>
                        <option value="UT">Uttarakhand</option>
                        <option value="UP">Uttar Pradesh</option>
                        <option value="WB">West Bengal</option>
                        <option value="AN">Andaman and Nicobar</option>
                        <option value="CH">Chandigarh</option>
                        <option value="DN">Dadra Nagar Haveli</option>
                        <option value="DD">Daman and Diu</option>
                        <option value="DL">Delhi</option>
                        <option value="LD">Lakshadweep</option>
                        <option value="PY">Puducherry</option>
                </select>
            </div>
            <div class="input-box">
                <select name="blood_group" required>
                    <option value="" disabled selected>Select Blood Group</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
            </div>
            <div class="input-box">
                <textarea name="diseases" placeholder="Medical history (if any)"></textarea>
            </div>
            <div class="input-box">
                <select name="organs" required>
                    <option value="" disabled selected>Select Organs to Donate</option>
                    <option value="Heart">Heart</option>
                    <option value="Liver">Liver</option>
                    <option value="Kidney">Kidney</option>
                </select>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
    </div>
</body>
</html>
