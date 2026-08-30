<?php
session_start();

$logFile = "activity_log.txt";

$message = "";

/* Login */
if (isset($_POST["login"])) {

    $username = trim($_POST["username"]);

    if ($username != "") {

        $_SESSION["user"] = $username;

        setcookie(
            "last_user",
            $username,
            time() + 3600,
            "/"
        );

        $log = date("d-m-Y h:i:s A")
             . " | LOGIN | "
             . $username . "\n";

        file_put_contents(
            $logFile,
            $log,
            FILE_APPEND
        );

        $message = "Login successful!";
    }
}

/* File access */
if (
    isset($_POST["access"]) &&
    isset($_SESSION["user"])
) {

    $file = basename($_POST["file"]);

    $log = date("d-m-Y h:i:s A")
         . " | FILE ACCESS | "
         . $_SESSION["user"]
         . " | "
         . $file . "\n";

    file_put_contents(
        $logFile,
        $log,
        FILE_APPEND
    );

    $message = "File access recorded!";
}

/* Logout */
if (isset($_POST["logout"])) {

    $log = date("d-m-Y h:i:s A")
         . " | LOGOUT | "
         . $_SESSION["user"] . "\n";

    file_put_contents(
        $logFile,
        $log,
        FILE_APPEND
    );

    session_destroy();

    $message = "Logged out successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>User Activity Logger</title>

<style>

body {
    font-family: Arial;
    background: linear-gradient(135deg, #1e1b4b, #4338ca);
    min-height: 100vh;
    padding: 40px;
}

.container {
    width: 650px;
    margin: auto;
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 30px black;
}

h1 {
    text-align: center;
    color: #3730a3;
}

.box {
    background: #eef2ff;
    padding: 20px;
    margin: 15px 0;
    border-radius: 12px;
}

input {
    padding: 10px;
    margin: 5px;
    border-radius: 7px;
    border: 1px solid #a5b4fc;
}

input[type="submit"] {
    background: #4f46e5;
    color: white;
    border: none;
    cursor: pointer;
}

.message {
    background: #dcfce7;
    color: #166534;
    padding: 12px;
    text-align: center;
    border-radius: 8px;
}

.log {
    background: #f8fafc;
    padding: 15px;
    border-radius: 8px;
    white-space: pre-line;
}

</style>

</head>

<body>

<div class="container">

<h1> Activity & File Access Log</h1>

<?php

if ($message != "") {
    echo "<div class='message'>$message</div>";
}

if (!isset($_SESSION["user"])) {

?>

<div class="box">

<h3> User Login</h3>

<form method="post">

<input type="text"
       name="username"
       placeholder="Enter username"
       required>

<input type="submit"
       name="login"
       value="Login">

</form>

</div>

<?php

} else {

?>

<div class="box">

<h3>Welcome, <?php echo htmlspecialchars($_SESSION["user"]); ?>!</h3>

<p>Last User Cookie:
<?php
echo isset($_COOKIE["last_user"])
     ? htmlspecialchars($_COOKIE["last_user"])
     : "Not available";
?>
</p>

</div>

<div class="box">

<h3> Access Files</h3>

<form method="post">

<input type="hidden"
       name="file"
       value="Project_Report.pdf">

<input type="submit"
       name="access"
       value="Open Project Report">

</form>

<form method="post">

<input type="hidden"
       name="file"
       value="Student_Report.txt">

<input type="submit"
       name="access"
       value="Open Student Report">

</form>

<form method="post">

<input type="submit"
       name="logout"
       value="Logout">

</form>

</div>

<?php

}

?>

<div class="box">

<h3> Activity Report</h3>

<div class="log">

<?php

if (file_exists($logFile)) {

    echo htmlspecialchars(
        file_get_contents($logFile)
    );

} else {

    echo "No activity recorded yet.";

}

?>

</div>

</div>

</div>

</body>
</html>