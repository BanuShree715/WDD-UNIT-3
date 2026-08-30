<?php

session_start();

/* Prevent direct access */

if (!isset($_SESSION["login_status"])) {

    header("Location: login.php");
    exit();

}

?>

<!DOCTYPE html>
<html>

<head>

<title>User Home</title>

<style>

body {
    margin: 0;
    font-family: Arial;
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.home {
    width: 500px;
    background: white;
    padding: 40px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 25px #555;
}

h1 {
    color: #1d4ed8;
}

.user {
    background: #eff6ff;
    padding: 20px;
    border-radius: 12px;
}

.logout {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 25px;
    background: #2563eb;
    color: white;
    text-decoration: none;
    border-radius: 8px;
}

</style>

</head>

<body>

<div class="home">

<h1> Welcome to Dashboard</h1>

<div class="user">

<h2>Login Successful!</h2>

<p>
Logged in as:
<br>

<b>
<?php
echo htmlspecialchars($_SESSION["user_email"]);
?>
</b>

</p>

<p>
You were redirected using the
<strong>HTTP Header</strong>.
</p>

</div>

<a class="logout" href="logout.php">
Logout
</a>

</div>

</body>

</html>