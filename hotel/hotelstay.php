<?php
$result = "";

if (isset($_POST['calculate'])) {

    $checkin = new DateTime($_POST['checkin']);
    $checkout = new DateTime($_POST['checkout']);

    if ($checkout > $checkin) {
        $difference = $checkin->diff($checkout);
        $days = $difference->days;

        $result = "Guest Stay Duration: " . $days . " Days";
    } else {
        $result = "Check-out date must be after check-in date.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hotel Stay Calculator</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #ffe4e6, #fbcfe8);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: white;
            width: 400px;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0px 8px 25px gray;
            text-align: center;
        }

        h1 {
            color: #be185d;
        }

        label {
            display: block;
            text-align: left;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="date"] {
            width: 95%;
            padding: 10px;
            margin-top: 7px;
            border: 2px solid #f9a8d4;
            border-radius: 8px;
        }

        input[type="submit"] {
            margin-top: 25px;
            padding: 12px 25px;
            background: #db2777;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .result {
            margin-top: 20px;
            padding: 15px;
            background: #fce7f3;
            color: #9d174d;
            border-radius: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<div class="box">

    <h1> Hotel Stay Calculator</h1>

    <form method="post">

        <label>Check-in Date</label>
        <input type="date" name="checkin" required>

        <label>Check-out Date</label>
        <input type="date" name="checkout" required>

        <input type="submit" name="calculate"
               value="Calculate Stay">

    </form>

    <?php
    if ($result != "") {
        echo "<div class='result'>$result</div>";
    }
    ?>

</div>

</body>
</html>