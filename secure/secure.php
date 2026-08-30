<?php
session_start();

$correctUser = "admin";
$correctPass = "12345";
$message = "";

if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username === $correctUser && $password === $correctPass) {

        session_regenerate_id(true);

        $_SESSION["username"] = $username;

        setcookie(
            "remember_user",
            $username,
            time() + 3600,
            "/",
            "",
            false,
            true
        );

        $message = "Login Successful!";
    } else {
        $message = "Invalid Username or Password!";
    }
}

if (isset($_POST["logout"])) {
    $_SESSION = [];
    session_destroy();

    setcookie("remember_user", "", time() - 3600, "/");

    $message = "You have been logged out.";
}
?>

<html>
<head>
    <title>Secure Login</title>

    <style>
        body {
            margin: 0;
            font-family: Arial;
            background: linear-gradient(135deg, #312e81, #7c3aed);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login-box {
            width: 350px;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 30px #222;
            text-align: center;
        }

        h1 {
            color: #4c1d95;
        }

        input {
            width: 90%;
            padding: 12px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        input[type="submit"] {
            width: 95%;
            background: #6d28d9;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #4c1d95;
        }

        .message {
            color: #166534;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="login-box">

    <h1> Secure Login</h1>

    <?php
    if (isset($_SESSION["username"])) {

        echo "<h2>Welcome, " .
             htmlspecialchars($_SESSION["username"]) .
             "!</h2>";

        echo "<p>Session Authentication Active</p>";

        echo "<form method='post'>
                <input type='submit' name='logout' value='Logout'>
              </form>";

    } else {
    ?>

        <form method="post">

            <input type="text"
                   name="username"
                   placeholder="Enter Username"
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
    }

    echo "<p class='message'>$message</p>";
    ?>

    <hr>

    <small>
        Session → Server Storage<br>
        Cookie → Browser Storage
    </small>

</div>

</body>
</html>