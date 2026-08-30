<?php
$customerName = "";

if (isset($_POST["name"])) {
    $customerName = $_POST["name"];
    setcookie("customer_name", $customerName, time() + (86400 * 30));
}

$visits = isset($_COOKIE["visits"]) ? $_COOKIE["visits"] + 1 : 1;
setcookie("visits", $visits, time() + (86400 * 30));

if (isset($_COOKIE["customer_name"]) && $customerName == "") {
    $customerName = $_COOKIE["customer_name"];
}
?>


<html>
<head>
    <title>Customer Visit Tracker</title>
    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: white;
            width: 420px;
            padding: 35px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }

        h1 {
            color: #5a189a;
        }

        input {
            padding: 12px;
            width: 85%;
            border: 2px solid #764ba2;
            border-radius: 10px;
        }

        button {
            margin-top: 15px;
            padding: 12px 25px;
            background: #5a189a;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .message {
            margin-top: 20px;
            color: #333;
            font-size: 18px;
        }
    </style>
</head>

<body>

<div class="box">
    <h1> Customer Visit Tracker</h1>

    <form method="post">
        <input type="text" name="name" placeholder="Enter your name" required>
        <br>
        <button type="submit">Visit Website</button>
    </form>

    <?php if ($customerName != "") { ?>
        <div class="message">
            Welcome back, <b><?php echo htmlspecialchars($customerName); ?></b>! 🎉
            <br><br>
            You have visited this website
            <b><?php echo $visits; ?></b> times.
        </div>
    <?php } ?>
</div>

</body>
</html>