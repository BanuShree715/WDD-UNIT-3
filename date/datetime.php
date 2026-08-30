<?php

$currentDateTime = date("Y-m-d H:i:s");

$date1 = date("d-m-Y");
$date2 = date("l, F j, Y");
$date3 = date("D, M j, Y");

$time1 = date("h:i:s A");
$time2 = date("H:i:s");

?>


<html>
<head>
    <title>Date and Time Report</title>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #dbeafe, #c4b5fd);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .report {
            width: 500px;
            background: white;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0px 10px 30px gray;
        }

        h1 {
            text-align: center;
            color: #4338ca;
        }

        .card {
            background: #eef2ff;
            margin: 15px 0;
            padding: 15px;
            border-radius: 10px;
            border-left: 5px solid #6366f1;
        }

        .title {
            font-weight: bold;
            color: #3730a3;
        }

        .value {
            margin-top: 5px;
            font-size: 18px;
            color: #111827;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6b7280;
        }
    </style>
</head>

<body>

<div class="report">

    <h1> Date & Time Report</h1>

    <div class="card">
        <div class="title">Current Date & Time</div>
        <div class="value">
            <?php echo $currentDateTime; ?>
        </div>
    </div>

    <div class="card">
        <div class="title">Date Format 1</div>
        <div class="value">
            <?php echo $date1; ?>
        </div>
    </div>

    <div class="card">
        <div class="title">Date Format 2</div>
        <div class="value">
            <?php echo $date2; ?>
        </div>
    </div>

    <div class="card">
        <div class="title">Date Format 3</div>
        <div class="value">
            <?php echo $date3; ?>
        </div>
    </div>

    <div class="card">
        <div class="title">12-Hour Time Format</div>
        <div class="value">
            <?php echo $time1; ?>
        </div>
    </div>

    <div class="card">
        <div class="title">24-Hour Time Format</div>
        <div class="value">
            <?php echo $time2; ?>
        </div>
    </div>

    <div class="footer">
        Report generated using PHP Date & Time Functions
    </div>

</div>

</body>
</html>