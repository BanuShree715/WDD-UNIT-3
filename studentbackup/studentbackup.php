<?php

$studentFile = "student_records.txt";
$backupFolder = "backups";

if (!is_dir($backupFolder)) {
    mkdir($backupFolder);
}

$message = "";

/* Save student */

if (isset($_POST["save"])) {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $department = $_POST["department"];
    $mark = $_POST["mark"];

    $student =
        "ID: $id | Name: $name | Department: $department | Mark: $mark\n";

    file_put_contents(
        $studentFile,
        $student,
        FILE_APPEND
    );

    $message = "Student record saved!";
}


/* Backup */

if (isset($_POST["backup"])) {

    if (file_exists($studentFile)) {

        $stamp = date("Ymd_His");

        $backupName =
            $backupFolder . "/students_" . $stamp . ".bak";

        copy($studentFile, $backupName);

        $log =
            "Backup: $backupName | Time: "
            . date("d-m-Y h:i:s A")
            . "\n";

        file_put_contents(
            "backup_history.txt",
            $log,
            FILE_APPEND
        );

        $message = "Backup created successfully!";
    } else {

        $message = "No student records available!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Student Backup Center</title>

<style>

body {
    font-family: Arial;
    background: linear-gradient(120deg, #312e81, #9333ea);
    margin: 0;
    padding: 40px;
}

.container {
    width: 600px;
    margin: auto;
    background: white;
    padding: 30px;
    border-radius: 18px;
    box-shadow: 0 10px 25px #111;
}

h1 {
    text-align: center;
    color: #581c87;
}

.form {
    background: #faf5ff;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
}

input {
    width: 92%;
    padding: 11px;
    margin: 7px;
    border: 1px solid #c084fc;
    border-radius: 7px;
}

input[type="submit"] {
    width: 96%;
    background: #7e22ce;
    color: white;
    border: none;
    cursor: pointer;
}

input[type="submit"]:hover {
    background: #581c87;
}

.message {
    padding: 12px;
    background: #dcfce7;
    color: #166534;
    text-align: center;
    border-radius: 8px;
    margin-bottom: 15px;
}

.data {
    background: #f3e8ff;
    padding: 15px;
    border-radius: 10px;
}

</style>

</head>

<body>

<div class="container">

<h1> Student Backup Center</h1>

<?php

if ($message != "") {
    echo "<div class='message'>$message</div>";
}

?>

<div class="form">

<h3>Add Student</h3>

<form method="post">

<input type="text"
       name="id"
       placeholder="Student ID"
       required>

<input type="text"
       name="name"
       placeholder="Student Name"
       required>

<input type="text"
       name="department"
       placeholder="Department"
       required>

<input type="number"
       name="mark"
       placeholder="Mark"
       required>

<input type="submit"
       name="save"
       value="Save Record">

</form>

</div>

<div class="form">

<h3>Backup Student Records</h3>

<form method="post">

<input type="submit"
       name="backup"
       value="Create Backup">

</form>

</div>

<div class="data">

<h3> Current Records</h3>

<?php

if (file_exists($studentFile)) {

    echo nl2br(
        htmlspecialchars(
            file_get_contents($studentFile)
        )
    );

} else {

    echo "No records found.";

}

?>

</div>

</div>

</body>

</html>