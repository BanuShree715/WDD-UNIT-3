<?php

$message = "";
$messageType = "";

if (isset($_POST["upload"])) {

    $student = $_POST["student"];
    $department = $_POST["department"];

    $allowedTypes = ["pdf", "doc", "docx"];

    $fileName = $_FILES["assignment"]["name"];
    $tempName = $_FILES["assignment"]["tmp_name"];

    $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (!in_array($extension, $allowedTypes)) {

        $message = " Invalid file type! Only PDF, DOC and DOCX are allowed.";
        $messageType = "error";

    } else {

        $folder = "assignments/" . $department . "/";

        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
        }

        $newName = $student . "_" . time() . "." . $extension;

        if (move_uploaded_file($tempName, $folder . $newName)) {

            $message = " Assignment uploaded successfully!";
            $messageType = "success";

        } else {

            $message = " Upload failed.";
            $messageType = "error";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Assignment Portal</title>

<style>

body {
    margin: 0;
    font-family: Arial;
    background: linear-gradient(135deg, #42275a, #734b6d);
}

.container {
    width: 500px;
    max-width: 90%;
    margin: 70px auto;
    background: #fff;
    padding: 35px;
    border-radius: 25px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.35);
}

.logo {
    text-align: center;
    font-size: 50px;
}

h1 {
    text-align: center;
    color: #42275a;
}

.subtitle {
    text-align: center;
    color: #777;
}

label {
    font-weight: bold;
    color: #42275a;
}

input, select {
    width: 100%;
    padding: 13px;
    margin: 8px 0 20px;
    border: 2px solid #ddd;
    border-radius: 10px;
    box-sizing: border-box;
}

input:focus, select:focus {
    border-color: #734b6d;
    outline: none;
}

button {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 10px;
    background: #42275a;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #734b6d;
}

.success {
    margin-top: 20px;
    padding: 15px;
    background: #d8f3dc;
    color: #1b4332;
    border-radius: 10px;
    text-align: center;
}

.error {
    margin-top: 20px;
    padding: 15px;
    background: #ffe5e5;
    color: #9b2226;
    border-radius: 10px;
    text-align: center;
}

.info {
    margin-top: 25px;
    padding: 15px;
    background: #f3e8ff;
    border-radius: 12px;
    color: #42275a;
}

</style>

</head>

<body>

<div class="container">

    <div class="logo"></div>

    <h1>Assignment Portal</h1>

    <p class="subtitle">
        Submit your assignment securely
    </p>

    <form method="post" enctype="multipart/form-data">

        <label>Student Name</label>

        <input
            type="text"
            name="student"
            placeholder="Enter student name"
            required
        >

        <label>Department</label>

        <select name="department" required>

            <option value="">Choose Department</option>

            <option value="CSE">Computer Science</option>

            <option value="IT">Information Technology</option>

            <option value="ECE">Electronics</option>

            <option value="AIML">AI & ML</option>

        </select>

        <label>Assignment File</label>

        <input
            type="file"
            name="assignment"
            accept=".pdf,.doc,.docx"
            required
        >

        <button name="upload">
             Upload Assignment
        </button>

    </form>


    <?php if ($message != "") { ?>

        <div class="<?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>

    <?php } ?>


    <div class="info">

         <b>Allowed Files:</b> PDF, DOC, DOCX

        <br><br>

         Files are stored department-wise.

    </div>

</div>

</body>

</html>