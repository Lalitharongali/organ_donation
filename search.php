<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['blood_group']) && isset($_POST['organ'])) {
    $blood_group = $_POST['blood_group'];
    $organ = $_POST['organ'];

    try {
        $stmt = $conn->prepare("SELECT * FROM donors WHERE blood_group = :blood_group AND organs = :organ");
        $stmt->bindParam(':blood_group', $blood_group);
        $stmt->bindParam(':organ', $organ);
        $stmt->execute();
        $donors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($donors) > 0) {
            foreach ($donors as $donor) {
                echo "<div class='result-item'>
                        <p><strong>Name:</strong> " . htmlspecialchars($donor['name']) . "</p>
                        <p><strong>Blood Group:</strong> " . htmlspecialchars($donor['blood_group']) . "</p>
                        <p><strong>Organ:</strong> " . htmlspecialchars($donor['organs']) . "</p>
                        <p><strong>Location:</strong> " . htmlspecialchars($donor['city']) . ", " . htmlspecialchars($donor['state']) . "</p>
                        <p><strong>Phone:</strong> " . htmlspecialchars($donor['phone']) . "</p>
                      </div>";
            }
        } else {
            echo "<p>No matching donors found.</p>";
        }
        exit;
    } catch (PDOException $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Donor - Organ Donation</title>
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
            width: 800px;
            max-width: 90%;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        .search-box {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .search-box select, .search-box input {
            width: 48%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
            outline: none;
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
            margin-top: 10px;
        }

        .btn:hover {
            background: #3700b3;
        }

        .results {
            margin-top: 20px;
            text-align: left;
        }

        .result-item {
            background: #f9f9f9;
            padding: 10px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Search for a Donor</h1>
        <div class="search-box">
            <select id="blood-group">
                <option value="">Select Blood Group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
            <input type="text" id="organ" placeholder="Organ Needed">
        </div>
        <button class="btn" onclick="searchDonor()">Search</button>
        
        <div class="results" id="results"></div>
    </div>

    <script>
        function searchDonor() {
            let bloodGroup = document.getElementById("blood-group").value;
            let organ = document.getElementById("organ").value;
            let results = document.getElementById("results");

            results.innerHTML = "<p>Searching...</p>"; 

            if (bloodGroup && organ) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", window.location.href, true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        results.innerHTML = xhr.responseText;
                    }
                };
                xhr.send("blood_group=" + encodeURIComponent(bloodGroup) + "&organ=" + encodeURIComponent(organ));
            } else {
                results.innerHTML = "<p>Please select blood group and organ.</p>";
            }
        }
    </script>
</body>
</html>
