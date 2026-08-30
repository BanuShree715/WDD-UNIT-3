<?php

session_start();

$folder = "private_documents";

if (!is_dir($folder)) {
    mkdir($folder);
}

$message = "";

/* Simple login */

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "admin" && $password == "admin123") {

        $_SESSION["loggedin"] = true;

        $message = "Login successful!";

    } else {

        $message = "Invalid username or password!";
    }
}


/* Logout */

if (isset($_POST["logout"])) {

    session_destroy();

    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}


/* Upload document */

if (
    isset($_POST["upload"]) &&
    isset($_SESSION["loggedin"])
) {

    $fileName = basename($_FILES["document"]["name"]);

    $extension =
        strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $allowed = ["pdf", "doc", "docx", "txt"];

    if (!in_array($extension, $allowed)) {

        $message = "Invalid document type.";

    } elseif (file_exists("$folder/$fileName")) {

        $message = "Duplicate file! This document already exists.";

    } else {

        if (move_uploaded_file(
            $_FILES["document"]["tmp_name"],
            "$folder/$fileName"
        )) {

            $message = "Document uploaded securely!";
        }
    }
}


/* Delete document */

if (
    isset($_POST["delete"]) &&
    isset($_SESSION["loggedin"])
) {

    $file = basename($_POST["file"]);

    if (file_exists("$folder/$file")) {

        unlink("$folder/$file");

        $message = "Document deleted successfully!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Secure Document Manager</title>

<style>

body {
    font-family: Arial;
    background: linear-gradient(135deg, #431407, #ea580c);
    min-height: 100vh;
    padding: 40px;
}

.container {
    width: 650px;
    margin: auto;
    background: white;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 12px 30px #222;
}

h1 {
    text-align: center;
    color: #9a3412;
}

.login {
    background: #fff7ed;
    padding: 20px;
    border-radius: 12px;
    text-align: center;
}

input {
    padding: 11px;
    margin: 7px;
    border: 1px solid #fdba74;
    border-radius: 7px;
}

input[type="submit"] {
    background: #ea580c;
    color: white;
    border: none;
    cursor: pointer;
}

.document {
    background: #ffedd5;
    padding: 15px;
    margin: 10px 0;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
}

.delete {
    background: #dc2626 !important;
}

.message {
    padding: 12px;
    background: #fef3c7;
    color: #92400e;
    text-align: center;
    border-radius: 8px;
    margin: 15px 0;
}

</style>

</head>

<body>

<div class="container">

<h1> Secure Document Manager</h1>

<?php

if ($message != "") {
    echo "<div class='message'>$message</div>";
}


/* Login screen */

if (!isset($_SESSION["loggedin"])) {

?>

<div class="login">

<h3>Admin Login</h3>

<form method="post">

<input type="text"
       name="username"
       placeholder="Username"
       required>

<input type="password"
       name="password"
       placeholder="Password"
       required>

<br>

<input type="submit"
       name="login"
       value="Login">

</form>

<p>Username: admin</p>
<p>Password: admin123</p>

</div>

<?php

} else {

?>

<form method="post">

<input type="file"
       name="document"
       required>

<input type="submit"
       name="upload"
       value="Upload">

</form>

<form method="post">

<input type="submit"
       name="logout"
       value="Logout">

</form>

<h3> Secure Documents</h3>

<?php

$files = scandir($folder);

foreach ($files as $file) {

    if ($file != "." && $file != "..") {

        echo "<div class='document'>";

        echo " " .
             htmlspecialchars($file);

        echo "<form method='post'>";

        echo "<input type='hidden'
                     name='file'
                     value='" .
                     htmlspecialchars($file) .
                     "'>";

        echo "<input type='submit'
                     name='delete'
                     value='Delete'
                     class='delete'>";

        echo "</form>";

        echo "</div>";
    }
}

}

?>

</div>

</body>

</html>