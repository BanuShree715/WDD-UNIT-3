<?php

$file = "attendance.txt";
$message = "";

if (isset($_POST["mark"])) {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $date = $_POST["date"];
    $status = $_POST["status"];

    $record = "$id | $name | $date | $status\n";

    file_put_contents($file, $record, FILE_APPEND);

    $message = "Attendance marked successfully!";
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Employee Attendance</title>

<style>

body {
    margin: 0;
    font-family: Arial;
    background: #0f2027;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    color: white;
}

.header {
    text-align: center;
    padding: 35px;
}

.header h1 {
    font-size: 35px;
}

.dashboard {
    width: 900px;
    max-width: 92%;
    margin: auto;
    display: flex;
    gap: 25px;
    flex-wrap: wrap;
}

.card {
    background: rgba(255,255,255,0.95);
    color: #222;
    padding: 30px;
    border-radius: 20px;
    flex: 1;
    min-width: 320px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

h2 {
    color: #203a43;
}

input, select {
    width: 100%;
    padding: 12px;
    margin: 8px 0 15px;
    border: 1px solid #aaa;
    border-radius: 8px;
    box-sizing: border-box;
}

button {
    width: 100%;
    padding: 13px;
    border: none;
    border-radius: 8px;
    background: #203a43;
    color: white;
    cursor: pointer;
}

button:hover {
    background: #2c5364;
}

.success {
    margin-top: 20px;
    padding: 12px;
    background: #d8f3dc;
    color: #1b4332;
    border-radius: 8px;
    text-align: center;
}

.records {
    margin: 40px auto;
    width: 900px;
    max-width: 92%;
    background: white;
    color: #222;
    padding: 30px;
    border-radius: 20px;
}

.record {
    background: #eef6f7;
    margin: 10px 0;
    padding: 15px;
    border-radius: 8px;
    border-left: 5px solid #2c5364;
}

.empty {
    text-align: center;
    color: #777;
}

</style>

</head>

<body>


<div class="header">

    <h1> Employee Attendance Hub</h1>

    <p>Daily Attendance Management System</p>

</div>


<div class="dashboard">


    <div class="card">

        <h2> Mark Attendance</h2>

        <form method="post">

            <input
                type="text"
                name="id"
                placeholder="Employee ID"
                required
            >

            <input
                type="text"
                name="name"
                placeholder="Employee Name"
                required
            >

            <input
                type="date"
                name="date"
                required
            >

            <select name="status">

                <option value="Present">
                    Present
                </option>

                <option value="Absent">
                    Absent
                </option>

            </select>

            <button name="mark">
                Mark Attendance
            </button>

        </form>


        <?php if ($message != "") { ?>

            <div class="success">
                 <?php echo $message; ?>
            </div>

        <?php } ?>

    </div>


    <div class="card">

        <h2> Attendance Features</h2>

        <p> Employee ID tracking</p>

        <p> Date-wise attendance</p>

        <p> Present / Absent status</p>

        <p> Text file storage</p>

        <p> Retrieve saved records</p>

    </div>

</div>


<div class="records">

    <h2> Attendance Records</h2>

    <?php

    if (file_exists($file)) {

        $records = file($file);

        foreach ($records as $record) {

            echo "<div class='record'>";

            echo " " . htmlspecialchars($record);

            echo "</div>";
        }

    } else {

        echo "<div class='empty'>";
        echo "No attendance records available.";
        echo "</div>";
    }

    ?>

</div>


</body>

</html>