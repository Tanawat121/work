<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ฟอร์มตรวจสอบข้อมูล PHP</title>
<style>
body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 40px;
  background: linear-gradient(to right, #8360c3, #2ebf91);
  color: #fff;
  text-align: center;
}
.container {
  max-width: 500px;
  margin: auto;
  background: rgba(255, 255, 255, 0.9);
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  color: #333;
}
h2 {
  color: #444;
}
.error {
  color: #FF0000;
  font-size: 14px;
}
form {
  display: flex;
  flex-direction: column;
  gap: 10px;
}
input[type="text"], textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}
input[type="submit"] {
  background: #28a745;
  color: white;
  padding: 12px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background 0.3s ease;
}
input[type="submit"]:hover {
  background: #218838;
}
.result {
  margin-top: 20px;
  padding: 15px;
  background: rgba(255, 255, 255, 0.9);
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  color: #333;
}
</style>
</head>
<body>  
<div class="container">
<?php
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "จำเป็นต้องกรอกชื่อ";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Zก-ํ\-' ]*$/", $name)) {
      $nameErr = "อนุญาตให้ใช้ตัวอักษรและช่องว่างเท่านั้น";
    }
  }
  if (empty($_POST["email"])) {
    $emailErr = "จำเป็นต้องกรอกอีเมล";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "รูปแบบอีเมลไม่ถูกต้อง";
    }
  }
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/=%?~_|!:,.;]*[-a-z0-9+&@#\/=%~_|]/i", $website)) {
      $websiteErr = "รูปแบบ URL ไม่ถูกต้อง";
    }    
  }
  $comment = empty($_POST["comment"]) ? "" : test_input($_POST["comment"]);
  if (empty($_POST["gender"])) {
    $genderErr = "จำเป็นต้องเลือกเพศ";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}
function test_input($data) {
  return htmlspecialchars(stripslashes(trim($data)));
}
?>

<h2>ฟอร์มตรวจสอบข้อมูล PHP</h2>
<p><span class="error">* จำเป็นต้องกรอกข้อมูล</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  <label>ชื่อ:</label>
  <input type="text" name="name" value="<?php echo $name; ?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <label>อีเมล:</label>
  <input type="text" name="email" value="<?php echo $email; ?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <label>เว็บไซต์:</label>
  <input type="text" name="website" value="<?php echo $website; ?>">
  <span class="error"><?php echo $websiteErr;?></span>
  <label>ข้อคิดเห็น:</label>
  <textarea name="comment" rows="5"><?php echo $comment; ?></textarea>
  <label>เพศ:</label>
  <input type="radio" name="gender" value="female" <?php if ($gender=="female") echo "checked";?>> หญิง
  <input type="radio" name="gender" value="male" <?php if ($gender=="male") echo "checked";?>> ชาย
  <input type="radio" name="gender" value="other" <?php if ($gender=="other") echo "checked";?>> อื่น ๆ
  <span class="error">* <?php echo $genderErr;?></span>
  <input type="submit" name="submit" value="ส่งข้อมูล">  
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && !$nameErr && !$emailErr && !$genderErr && !$websiteErr) {
  echo "<div class='result'>";
  echo "<h3>ข้อมูลที่คุณกรอก:</h3>";
  echo "<strong>ชื่อ:</strong> " . $name . "<br>";
  echo "<strong>อีเมล:</strong> " . $email . "<br>";
  echo "<strong>เว็บไซต์:</strong> " . ($website ? $website : "ไม่มี") . "<br>";
  echo "<strong>ข้อคิดเห็น:</strong> " . nl2br($comment) . "<br>";
  echo "<strong>เพศ:</strong> " . $gender . "<br>";
  echo "</div>";
}
?>
</div>
</body>
</html>
