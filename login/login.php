<?php
session_start();

$message = "";

if (isset($_POST["login"])) {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if ($email == "user@gmail.com" && $password == "pass123") {

        $_SESSION["user_email"] = $email;
        $_SESSION["login_status"] = "success";

        // Redirect using HTTP Header
        header("Location: home.php");
        exit();

    } else {

        $message = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>User Login</title>

<style>

body {
    margin: 0;
    font-family: Arial;
    background: linear-gradient(135deg, #fef2f2, #fecaca);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-box {
    width: 380px;
    background: white;
    padding: 35px;
    border-radius: 18px;
    text-align: center;
    box-shadow: 0 10px 25px #777;
}

h1 {
    color: #b91c1c;
}

p {
    color: #64748b;
}

input {
    width: 90%;
    padding: 12px;
    margin: 10px;
    border: 1px solid #fca5a5;
    border-radius: 8px;
}

input[type="submit"] {
    width: 96%;
    background: #dc2626;
    color: white;
    border: none;
    cursor: pointer;
}

input[type="submit"]:hover {
    background: #991b1b;
}

.error {
    color: #dc2626;
    font-weight: bold;
}

.demo {
    margin-top: 20px;
    padding: 12px;
    background: #fef2f2;
    border-radius: 8px;
    color: #7f1d1d;
}

</style>

</head>

<body>

<div class="login-box">

<h1> Login Portal</h1>

<p>Enter your credentials to continue</p>

<form method="post">

<input type="email"
       name="email"
       placeholder="Enter Email"
       required>

<input type="password"
       name="password"
       placeholder="Enter Password"
       required>

<input type="submit"
       name="login"
       value="LOGIN">

</form>

<?php

if ($message != "") {
    echo "<p class='error'>$message</p>";
}

?>

<div class="demo">

<b>Demo Login</b><br><br>
Email: user@gmail.com<br>
Password: pass123

</div>

</div>

</body>

</html>