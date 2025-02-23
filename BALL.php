<!DOCTYPE HTML>  
<html>
<head>
<style>
body {
  font-family: Arial, sans-serif;
  margin: 20px;
  padding: 20px;
  background-color: #f9f9f9;
}
.error {
  color: #FF0000;
}
h2 {
  color: #333;
}
form {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
input[type="text"], textarea {
  width: 100%;
  padding: 8px;
  margin: 8px 0;
  border: 1px solid #ccc;
  border-radius: 4px;
}
input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type="submit"]:hover {
  background-color: #45a049;
}
</style>
</head>
<body>  

<?php
$nameErr = $nicknameErr = $genderErr = $houseNoErr = "";
$name = $nickname = $gender = $comment = $houseNo = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "จำเป็นต้องกรอกชื่อ";
  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Zก-อ\-' ]*$/",$name)) {
      $nameErr = "อนุญาตให้ใช้ตัวอักษรและช่องว่างเท่านั้น";
    }
  }

  if (empty($_POST["nickname"])) {
    $nicknameErr = "จำเป็นต้องกรอกชื่อเล่น";
  } else {
    $nickname = test_input($_POST["nickname"]);
  }

  if (empty($_POST["houseNo"])) {
    $houseNoErr = "จำเป็นต้องกรอกเลขที่บ้าน";
  } else {
    $houseNo = test_input($_POST["houseNo"]);
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "จำเป็นต้องเลือกเพศ";
  } else {
    $gender = test_input($_POST["gender"]);
  }

  $data = "Name: $name\nNickname: $nickname\nHouse No: $houseNo\nComment: $comment\nGender: $gender\n\n";
  file_put_contents("data.txt", $data, FILE_APPEND);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>ตัวอย่างแบบฟอรมตรวจสอบข้อมูล PHP</h2>
<p><span class="error">* จำเป็นต้องกรอกข้อมูล</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  ชื่อ: <input type="text" name="name">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  ชื่อเล่น: <input type="text" name="nickname">
  <span class="error">* <?php echo $nicknameErr;?></span>
  <br><br>
  เลขบ้าน: <input type="text" name="houseNo">
  <span class="error">* <?php echo $houseNoErr;?></span>
  <br><br>
  ข้อเห็นคิด: <textarea name="comment" rows="5" cols="40"></textarea>
  <br><br>
  เพศ:
  <input type="radio" name="gender" value="female">หญิง
  <input type="radio" name="gender" value="male">ชาย
  <input type="radio" name="gender" value="other">อื่น ๆ
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="ส่งข้อมูล">  
  <br> <a href=to.php>ถัดไป</a>
</form>
</body>
</html>
