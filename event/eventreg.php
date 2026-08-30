<?php
session_start();

$folder = "events";

if (!is_dir($folder)) {
    mkdir($folder);
}

$message = "";

if (isset($_POST["register"])) {

    $name = $_POST["name"];
    $event = $_POST["event"];
    $date = $_POST["date"];

    $data = "Name: $name\nEvent: $event\nDate: $date\n";

    file_put_contents(
        $folder . "/registration_" . time() . ".txt",
        $data
    );

    $_SESSION["participant"] = $name;
    $_SESSION["event"] = $event;
    $_SESSION["date"] = $date;

    $message = "Registration Successful!";
}
?>


<html>
<head>
    <title>Event Registration</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #fef3c7, #fed7aa);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .box {
            width: 450px;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 25px gray;
        }

        h1 {
            text-align: center;
            color: #c2410c;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input, select {
            width: 95%;
            padding: 11px;
            margin-top: 7px;
            border: 2px solid #fdba74;
            border-radius: 8px;
        }

        input[type="submit"] {
            width: 100%;
            margin-top: 25px;
            background: #ea580c;
            color: white;
            border: none;
            cursor: pointer;
        }

        .success {
            margin-top: 20px;
            padding: 15px;
            background: #dcfce7;
            color: #166534;
            border-radius: 10px;
        }
    </style>
</head>

<body>

<div class="box">

    <h1> Event Registration</h1>

    <form method="post">

        <label>Participant Name</label>
        <input type="text" name="name" required>

        <label>Select Event</label>
        <select name="event" required>
            <option value="">Choose Event</option>
            <option value="Tech Conference">Tech Conference</option>
            <option value="AI Workshop">AI Workshop</option>
            <option value="Coding Contest">Coding Contest</option>
        </select>

        <label>Event Date</label>
        <input type="date" name="date" required>

        <input type="submit"
               name="register"
               value="Register Now">

    </form>

    <?php
    if ($message != "") {
        echo "<div class='success'>";
        echo "<b>$message</b><br><br>";
        echo "Participant: " . htmlspecialchars($_SESSION["participant"]) . "<br>";
        echo "Event: " . htmlspecialchars($_SESSION["event"]) . "<br>";
        echo "Date: " . htmlspecialchars($_SESSION["date"]);
        echo "</div>";
    }
    ?>

</div>

</body>
</html>