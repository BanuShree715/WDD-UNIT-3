<?php

session_start();

if (
    !isset($_SESSION["exam_allowed"]) ||
    $_SESSION["exam_allowed"] != "YES"
) {

    header("Location: exam_login.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Examination</title>

<style>

body {
    font-family: Arial;
    background: #f0fdf4;
    padding: 40px;
}

.exam {
    width: 650px;
    margin: auto;
    background: white;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 5px 20px gray;
}

h1 {
    color: #15803d;
    text-align: center;
}

.question {
    background: #dcfce7;
    padding: 20px;
    margin: 15px 0;
    border-radius: 10px;
}

button {
    background: #16a34a;
    color: white;
    border: none;
    padding: 12px 25px;
    border-radius: 7px;
}

</style>

</head>

<body>

<div class="exam">

<h1>📝 Online Examination</h1>

<p>
Student:
<b>
<?php
echo htmlspecialchars($_SESSION["exam_student"]);
?>
</b>
</p>

<div class="question">

<b>1. Which language is mainly used for PHP web programming?</b>

<br><br>

<input type="radio" name="q1"> PHP<br>
<input type="radio" name="q1"> Python<br>
<input type="radio" name="q1"> Java<br>
<input type="radio" name="q1"> C++

</div>

<div class="question">

<b>2. Which function starts a PHP session?</b>

<br><br>

<input type="radio" name="q2"> session_start()<br>
<input type="radio" name="q2"> start_session()<br>
<input type="radio" name="q2"> session_begin()<br>
<input type="radio" name="q2"> open_session()

</div>

<button>Submit Exam</button>

</div>

</body>

</html>