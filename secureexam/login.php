<?php
session_start();

$msg = "";

if (isset($_POST["enter"])) {

    $student = $_POST["student"];
    $pin = $_POST["pin"];

    if ($student == "Banu" && $pin == "2026") {

        session_regenerate_id(true);

        $_SESSION["exam_student"] = $student;
        $_SESSION["exam_allowed"] = "YES";

        setcookie(
            "student_name",
            $student,
            time() + 3600,
            "/",
            "",
            false,
            true
        );

        header("Location: exam.php");
        exit();

    } else {

        $msg = "Access Denied! Invalid student details.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Exam Access</title>

<style>

body {
    font-family: Arial;
    background: linear-gradient(135deg, #581c87, #c026d3);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.card {
    background: white;
    width: 380px;
    padding: 35px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 30px black;
}

h1 {
    color: #7e22ce;
}

input {
    width: 90%;
    padding: 12px;
    margin: 10px;
    border: 1px solid #d8b4fe;
    border-radius: 8px;
}

input[type="submit"] {
    width: 96%;
    background: #9333ea;
    color: white;
    border: none;
}

.error {
    color: #dc2626;
    font-weight: bold;
}

.note {
    background: #faf5ff;
    padding: 12px;
    margin-top: 15px;
    border-radius: 8px;
}

</style>

</head>

<body>

<div class="card">

<h1>🔐 Exam Access</h1>

<p>Student Verification</p>

<form method="post">

<input type="text"
       name="student"
       placeholder="Student Name"
       required>

<input type="password"
       name="pin"
       placeholder="Exam PIN"
       required>

<input type="submit"
       name="enter"
       value="Access Exam">

</form>

<?php

if ($msg != "") {
    echo "<p class='error'>$msg</p>";
}

?>

<div class="note">
Student: <b>Banu</b><br>
PIN: <b>2026</b>
</div>

</div>

</body>
</html>