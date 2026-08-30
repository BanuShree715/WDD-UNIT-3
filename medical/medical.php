
<?php

session_start();

$message = "";

if (isset($_POST["login"])) {

    $user = $_POST["username"];
    $pass = $_POST["password"];

    if ($user == "doctor" && $pass == "1234") {

        $_SESSION["doctor"] = $user;

        header("Location: medical.php");
        exit();

    } else {

        $message = "Invalid Login";
    }
}

if (isset($_POST["save"]) && isset($_SESSION["doctor"])) {

    $patient = $_POST["patient"];
    $report = $_POST["report"];

    $file = "records/" . $patient . ".txt";

    if (!is_dir("records")) {
        mkdir("records");
    }

    file_put_contents($file, $report);

    $message = "Medical record saved!";
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Medical Record System</title>

<style>

body {
    font-family: Arial;
    background: #ccfbf1;
    text-align: center;
    padding: 50px;
}

.box {
    background: white;
    width: 450px;
    margin: auto;
    padding: 30px;
    border-radius: 15px;
}

input, textarea {
    padding: 10px;
    margin: 8px;
    width: 90%;
}

button {
    padding: 10px 25px;
    background: #0f766e;
    color: white;
    border: none;
}

.message {
    color: #047857;
    font-weight: bold;
}

</style>

</head>

<body>

<div class="box">

<h1> Medical Records</h1>

<?php

if (!isset($_SESSION["doctor"])) {

?>

<form method="post">

<input type="text"
       name="username"
       placeholder="Doctor Username"
       required>

<input type="password"
       name="password"
       placeholder="Password"
       required>

<button type="submit" name="login">
Login
</button>

</form>

<p>Username: doctor</p>
<p>Password: 1234</p>

<?php

} else {

?>

<h3>Welcome Doctor</h3>

<form method="post">

<input type="text"
       name="patient"
       placeholder="Patient ID"
       required>

<textarea
       name="report"
       placeholder="Medical Report"
       required></textarea>

<br>

<button type="submit" name="save">
Save Record
</button>

</form>

<?php

}

if ($message != "") {
    echo "<p class='message'>$message</p>";
}

?>

</div>

</body>

</html>