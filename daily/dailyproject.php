<?php

/* Current date and time */

$date = date("Y-m-d");
$time = date("h:i:s A");

/* Log folder */

$folder = "project_logs/";

/* Create folder automatically */

if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

/* Create today's file */

$file = $folder . "project_log_" . $date . ".txt";

$message = "";


/* Save project log */

if (isset($_POST["save"])) {

    $task = $_POST["task"];
    $status = $_POST["status"];

    $log = "PROJECT DAILY LOG\n";
    $log .= "--------------------------\n";
    $log .= "Date   : " . date("d-m-Y") . "\n";
    $log .= "Time   : " . date("h:i:s A") . "\n";
    $log .= "Task   : " . $task . "\n";
    $log .= "Status : " . $status . "\n";
    $log .= "--------------------------\n\n";

    // Append log to today's file
    file_put_contents($file, $log, FILE_APPEND);

    $message = "Daily project log saved successfully!";

    /* Update time after saving */

    $time = date("h:i:s A");
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Daily Project Log</title>

<style>

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #134e5e, #71b280);
    min-height: 100vh;
}

.container {
    width: 850px;
    max-width: 90%;
    margin: 45px auto;
}

.header {
    text-align: center;
    color: white;
    margin-bottom: 25px;
}

.header h1 {
    font-size: 38px;
}

.date-card {
    background: rgba(255,255,255,0.15);
    color: white;
    padding: 20px;
    text-align: center;
    border-radius: 18px;
    margin-bottom: 25px;
}

.date {
    font-size: 28px;
    font-weight: bold;
}

.time {
    margin-top: 8px;
}

.card {
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
}

h2 {
    color: #134e5e;
}

input, select {
    width: 100%;
    padding: 13px;
    margin: 8px 0 18px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 10px;
}

button {
    width: 100%;
    padding: 14px;
    background: #134e5e;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #0b3540;
}

.success {
    margin-top: 20px;
    padding: 15px;
    background: #d8f3dc;
    color: #1b4332;
    border-radius: 10px;
    text-align: center;
}

.log {
    margin-top: 25px;
    padding: 20px;
    background: #f1f8f3;
    border-left: 5px solid #40916c;
    border-radius: 10px;
    white-space: pre-line;
    line-height: 1.7;
}

.file-name {
    margin-top: 15px;
    padding: 12px;
    background: #e8f5e9;
    border-radius: 8px;
    color: #2d6a4f;
}

</style>

</head>

<body>

<div class="container">


    <div class="header">

        <h1> Daily Project Log</h1>

        <p>Automatic Project Activity Recorder</p>

    </div>


   

    <div class="date-card">

        <div> TODAY</div>

        <div class="date">
            <?php echo $date; ?>
        </div>

        <div class="time">
             <?php echo $time; ?>
        </div>

    </div>


    

    <div class="card">

        <h2> Add Project Update</h2>

        <form method="post">

            <input
                type="text"
                name="task"
                placeholder="Enter project task"
                required
            >

            <select name="status">

                <option value="Completed">
                    Completed
                </option>

                <option value="In Progress">
                     In Progress
                </option>

                <option value="Pending">
                     Pending
                </option>

            </select>

            <button type="submit" name="save">
                 Save Today's Log
            </button>

        </form>


        <?php if ($message != "") { ?>

            <div class="success">
                <?php echo $message; ?>
            </div>

        <?php } ?>


        <div class="file-name">

             Today's File:
            <b>
                <?php echo $file; ?>
            </b>

        </div>


       

        <h2> Today's Project Log</h2>

        <div class="log">

            <?php

            if (file_exists($file)) {

                echo nl2br(
                    htmlspecialchars(
                        file_get_contents($file)
                    )
                );

            } else {

                echo "No project activities recorded today.";

            }

            ?>

        </div>

    </div>

</div>

</body>
</html>