<?php

$file = "students.txt";
$message = "";

/* Add new student record */

if (isset($_POST["add"])) {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $course = $_POST["course"];
    $mark = $_POST["mark"];

    $record = "$id | $name | $course | $mark\n";

    // Append record to existing file
    file_put_contents($file, $record, FILE_APPEND);

    $message = "Student record added successfully!";
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Student Record Manager</title>

<style>

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
    min-height: 100vh;
}

.container {
    width: 850px;
    max-width: 90%;
    margin: 50px auto;
}

.header {
    text-align: center;
    color: white;
    margin-bottom: 25px;
}

.header h1 {
    font-size: 36px;
}

.card {
    background: white;
    padding: 30px;
    margin-bottom: 25px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
}

h2 {
    color: #203a43;
}

input {
    width: 100%;
    padding: 13px;
    margin: 8px 0 15px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 10px;
}

input:focus {
    outline: none;
    border-color: #2c5364;
}

button {
    width: 100%;
    padding: 14px;
    background: #203a43;
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #2c5364;
}

.success {
    margin-top: 20px;
    padding: 15px;
    background: #d8f3dc;
    color: #1b4332;
    border-radius: 10px;
    text-align: center;
}

.record {
    background: #f1f5f9;
    padding: 16px;
    margin: 10px 0;
    border-left: 5px solid #2c5364;
    border-radius: 8px;
}

.empty {
    text-align: center;
    color: #777;
}

</style>

</head>

<body>

<div class="container">

    <div class="header">

        <h1> Student Record Manager</h1>

        <p>File-Based Student Information System</p>

    </div>


    <!-- ADD STUDENT -->

    <div class="card">

        <h2> Add Student</h2>

        <form method="post">

            <input
                type="text"
                name="id"
                placeholder="Enter Student ID"
                required
            >

            <input
                type="text"
                name="name"
                placeholder="Enter Student Name"
                required
            >

            <input
                type="text"
                name="course"
                placeholder="Enter Course"
                required
            >

            <input
                type="number"
                name="mark"
                placeholder="Enter Mark"
                required
            >

            <button type="submit" name="add">
                 Save Student Record
            </button>

        </form>


        <?php if ($message != "") { ?>

            <div class="success">
                 <?php echo $message; ?>
            </div>

        <?php } ?>

    </div>


    <!-- DISPLAY RECORDS -->

    <div class="card">

        <h2> Updated Student Records</h2>

        <?php

        if (file_exists($file)) {

            $records = file($file);

            foreach ($records as $record) {

                echo "<div class='record'>";

                echo " "
                    . htmlspecialchars($record);

                echo "</div>";
            }

        } else {

            echo "<div class='empty'>";
            echo "No student records found.";
            echo "</div>";
        }

        ?>

    </div>

</div>

</body>
</html>