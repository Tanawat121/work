<!DOCTYPE html>
<html>
<body>

<?php
$myfile = fopen("myname.txt", "r") or die("Unable to open file!");
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);
?>
<?php
$myfile = fopen("myname.txt", "r") or die("Unable to open file!");
// Output one line until end-of-file
while(!feof($myfile)) {
  echo fgets($myfile) . "<br>";
}
fclose($myfile);
?>
<?php
$myfile = fopen("New.txt", "r") or die("Unable to open file!");
echo fgets($myfile);
fclose($myfile);
?>
</body>
</html>