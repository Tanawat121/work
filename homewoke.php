<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #eaf6f6;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #2c3e50;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #34495e;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
            font-size: 14px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background: #1abc9c;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background: #16a085;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            background: #ecf0f1;
            color: #2c3e50;
        }
        .result p {
            margin: 0 0 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>BMI Calculator</h1>
        <form method="POST" action="homewoke.php">
            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>
            <div class="form-group">
                <label for="age">Age:</label>
                <input type="number" id="age" name="age" min="1" required>
            </div>
            <div class="form-group">
                <label for="weight">Weight (kg):</label>
                <input type="number" id="weight" name="weight" min="1" step="0.1" required>
            </div>
            <div class="form-group">
                <label for="height">Height (cm):</label>
                <input type="number" id="height" name="height" min="1" step="0.1" required>
            </div>
            <button type="submit" class="btn">Calculate BMI</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = htmlspecialchars($_POST['firstname']);
            $lastname = htmlspecialchars($_POST['lastname']);
            $age = intval($_POST['age']);
            $weight = floatval($_POST['weight']);
            $height = floatval($_POST['height']);

            // คำนวณค่า BMI
            $heightInMeters = $height / 100;
            $bmi = $weight / ($heightInMeters * $heightInMeters);
            $bmi = round($bmi, 2);

            // แปลผลค่า BMI
            if ($bmi < 18.5) {
                $category = "Underweight";
                $advice = "คุณควรกินอาหารที่มีสารอาหารครบถ้วนเพื่อเพิ่มน้ำหนัก.";
            } elseif ($bmi < 24.9) {
                $category = "Normal weight";
                $advice = "ยอดเยี่ยม! รักษารูปร่างและสุขภาพให้ดีต่อไป.";
            } elseif ($bmi < 29.9) {
                $category = "Overweight";
                $advice = "คุณควรเริ่มออกกำลังกายและควบคุมอาหาร.";
            } else {
                $category = "Obesity";
                $advice = "คุณควรปรึกษาแพทย์เพื่อคำแนะนำเพิ่มเติม.";
            }

            // แสดงผลลัพธ์
            echo "<div class='result'>";
            echo "<h2>ผลลัพธ์ BMI</h2>";
            echo "<p><strong>ชื่อ-นามสกุล:</strong> $firstname $lastname</p>";
            echo "<p><strong>อายุ:</strong> $age ปี</p>";
            echo "<p><strong>BMI:</strong> $bmi ($category)</p>";
            echo "<p><strong>คำแนะนำ:</strong> $advice</p>";
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>
