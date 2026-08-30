<?php

session_start();

$file = "student_activity.txt";

$message = "";


/* START SESSION */

if (!isset($_SESSION["activities"])) {

    $_SESSION["activities"] = [];

}


/* ADD ACTIVITY */

if (isset($_POST["add"])) {

    $student = $_POST["student"];
    $activity = $_POST["activity"];

    $date = date("d-m-Y");
    $time = date("h:i:s A");

    $record = "$student | $activity | $date | $time\n";

    file_put_contents($file, $record, FILE_APPEND);

    $_SESSION["activities"][] = [
        "student" => $student,
        "activity" => $activity,
        "date" => $date,
        "time" => $time
    ];

    $message = "Activity recorded successfully!";
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Student Activity Report</title>

<style>

body {
    margin: 0;
    font-family: Arial;
    background: #fdf6ec;
}

.top {
    background: linear-gradient(135deg, #7f5539, #b08968);
    color: white;
    padding: 35px;
    text-align: center;
}

.container {
    width: 90%;
    max-width: 1000px;
    margin: 35px auto;
}

.form-card {
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

input, select {
    width: 100%;
    padding: 13px;
    margin: 8px 0 18px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 10px;
}

button {
    padding: 13px 25px;
    border: none;
    border-radius: 10px;
    background: #7f5539;
    color: white;
    cursor: pointer;
}

button:hover {
    background: #5c3d2e;
}

.success {
    margin-top: 20px;
    padding: 15px;
    background: #d8f3dc;
    color: #1b4332;
    border-radius: 10px;
}

.report {
    margin-top: 30px;
    background: white;
    padding: 30px;
    border-radius: 20px;
}

.activity {
    padding: 18px;
    margin: 10px 0;
    background: #f8f0e3;
    border-left: 5px solid #b08968;
    border-radius: 8px;
}

.date {
    color: #7f5539;
    font-weight: bold;
}

</style>

</head>

<body>


<div class="top">

    <h1> Student Activity Tracker</h1>

    <p>Daily Learning & Activity Report</p>

</div>


<div class="container">


<div class="form-card">

    <h2>➕ Record Student Activity</h2>

    <form method="post">

        <input
            type="text"
            name="student"
            placeholder="Student Name"
            required
        >

        <input
            type="text"
            name="activity"
            placeholder="Activity Description"
            required
        >

        <button name="add">
            Save Activity
        </button>

    </form>


    <?php if ($message != "") { ?>

        <div class="success">
             <?php echo $message; ?>
        </div>

    <?php } ?>

</div>


<div class="report">

    <h2> Activity Summary</h2>

    <?php

    if (!empty($_SESSION["activities"])) {

        foreach ($_SESSION["activities"] as $data) {

            echo "<div class='activity'>";

            echo " <b>"
                . htmlspecialchars($data["student"])
                . "</b><br><br>";

            echo " "
                . htmlspecialchars($data["activity"])
                . "<br>";

            echo "<span class='date'>";

            echo " " . $data["date"];
            echo " &nbsp;  " . $data["time"];

            echo "</span>";

            echo "</div>";
        }

    } else {

        echo "<p>No activities recorded yet.</p>";
    }

    ?>

</div>

</div>

</body>
</html>