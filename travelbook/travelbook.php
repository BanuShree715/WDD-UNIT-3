<?php
session_start();

$folder = "travel_bookings";

if (!is_dir($folder)) {
    mkdir($folder);
}

$message = "";

if (isset($_POST["book"])) {

    $customer = $_POST["customer"];
    $destination = $_POST["destination"];
    $travelDate = $_POST["travel_date"];

    $bookingID = "TR" . rand(1000, 9999);

    $booking = "Booking ID: $bookingID\n";
    $booking .= "Customer: $customer\n";
    $booking .= "Destination: $destination\n";
    $booking .= "Travel Date: $travelDate\n";

    file_put_contents(
        $folder . "/" . $bookingID . ".txt",
        $booking
    );

    $_SESSION["booking_id"] = $bookingID;
    $_SESSION["customer"] = $customer;
    $_SESSION["destination"] = $destination;
    $_SESSION["travel_date"] = $travelDate;

    $message = "Booking Confirmed!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Travel Booking System</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #cffafe, #bfdbfe);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            width: 480px;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 30px gray;
        }

        h1 {
            text-align: center;
            color: #0369a1;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #075985;
        }

        input, select {
            width: 95%;
            padding: 12px;
            margin-top: 7px;
            border: 2px solid #7dd3fc;
            border-radius: 8px;
        }

        input[type="submit"] {
            width: 100%;
            margin-top: 25px;
            background: #0284c7;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #0369a1;
        }

        .confirmation {
            margin-top: 25px;
            padding: 20px;
            background: #ecfeff;
            border: 2px solid #22d3ee;
            border-radius: 12px;
            color: #164e63;
        }

        .confirmation h2 {
            text-align: center;
            color: #0e7490;
        }
    </style>
</head>

<body>

<div class="container">

    <h1> Travel Booking</h1>

    <form method="post">

        <label>Customer Name</label>
        <input type="text" name="customer" required>

        <label>Destination</label>
        <select name="destination" required>
            <option value="">Select Destination</option>
            <option value="Chennai">Chennai</option>
            <option value="Bangalore">Bangalore</option>
            <option value="Mumbai">Mumbai</option>
            <option value="Delhi">Delhi</option>
            <option value="Goa">Goa</option>
        </select>

        <label>Travel Date</label>
        <input type="date" name="travel_date" required>

        <input type="submit"
               name="book"
               value="Book Journey">

    </form>

    <?php

    if ($message != "") {

        echo "<div class='confirmation'>";

        echo "<h2> $message</h2>";

        echo "<b>Booking ID:</b> "
             . htmlspecialchars($_SESSION["booking_id"])
             . "<br><br>";

        echo "<b>Customer:</b> "
             . htmlspecialchars($_SESSION["customer"])
             . "<br><br>";

        echo "<b>Destination:</b> "
             . htmlspecialchars($_SESSION["destination"])
             . "<br><br>";

        echo "<b>Travel Date:</b> "
             . htmlspecialchars($_SESSION["travel_date"]);

        echo "</div>";
    }

    ?>

</div>

</body>
</html>