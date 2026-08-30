<?php

$message = "";
$lastLogin = "";

if (isset($_POST["login"])) {

    $username = $_POST["username"];

    if (isset($_COOKIE["last_login"])) {

        $lastLogin = $_COOKIE["last_login"];

    } else {

        $lastLogin = "This is your first login! 🎉";
    }

    $currentTime = date("d-m-Y h:i:s A");

    setcookie(
        "username",
        $username,
        time() + (86400 * 30)
    );

    setcookie(
        "last_login",
        $currentTime,
        time() + (86400 * 30)
    );

    $message = "Welcome, " . htmlspecialchars($username) . "!";
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Smart Login</title>

<style>

body {
    margin: 0;
    font-family: Arial;
    background: radial-gradient(circle at top, #ff758c, #ff7eb3, #6a11cb);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-box {
    width: 420px;
    max-width: 90%;
    background: rgba(255,255,255,0.95);
    padding: 40px;
    border-radius: 25px;
    text-align: center;
    box-shadow: 0 20px 50px rgba(0,0,0,0.35);
}

.icon {
    font-size: 55px;
}

h1 {
    color: #6a11cb;
}

.subtitle {
    color: #777;
}

input {
    width: 100%;
    padding: 14px;
    margin: 20px 0;
    box-sizing: border-box;
    border: 2px solid #eee;
    border-radius: 12px;
    font-size: 16px;
}

input:focus {
    border-color: #6a11cb;
    outline: none;
}

button {
    width: 100%;
    padding: 14px;
    background: linear-gradient(90deg, #6a11cb, #ff758c);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    opacity: 0.9;
}

.welcome {
    margin-top: 25px;
    padding: 20px;
    background: #f3e8ff;
    border-radius: 15px;
    color: #4c1d95;
}

.time {
    margin-top: 15px;
    padding: 15px;
    background: #fff0f3;
    border-radius: 12px;
    color: #9d174d;
}

.first {
    margin-top: 15px;
    padding: 15px;
    background: #dcfce7;
    border-radius: 12px;
    color: #166534;
}

.footer {
    margin-top: 25px;
    color: #888;
    font-size: 13px;
}

</style>

</head>

<body>


<div class="login-box">

    <div class="icon">
        
    </div>

    <h1>Smart Login</h1>

    <p class="subtitle">
        Cookie Based Login Tracker
    </p>


    <form method="post">

        <input
            type="text"
            name="username"
            placeholder="Enter your username"
            required
        >

        <button name="login">
             Login
        </button>

    </form>


    <?php if ($message != "") { ?>

        <div class="welcome">

            <h3>
                <?php echo $message; ?>
            </h3>

            <?php if ($lastLogin == "This is your first login! 🎉") { ?>

                <div class="first">

                    <?php echo $lastLogin; ?>

                </div>

            <?php } else { ?>

                <div class="time">

                     <b>Your Last Login</b>

                    <br><br>

                    <?php echo htmlspecialchars($lastLogin); ?>

                </div>

            <?php } ?>

        </div>

    <?php } ?>


    <div class="footer">

        Your login information is stored using cookies.

    </div>

</div>


</body>

</html>