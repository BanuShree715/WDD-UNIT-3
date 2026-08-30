<?php

$message = "";

if (isset($_POST["upload"])) {

    $folder = "resumes";

    if (!is_dir($folder)) {
        mkdir($folder);
    }

    $fileName = basename($_FILES["resume"]["name"]);
    $fileSize = $_FILES["resume"]["size"];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $tempFile = $_FILES["resume"]["tmp_name"];

    $allowedTypes = ["pdf", "doc", "docx"];

    if (!in_array($fileType, $allowedTypes)) {

        $message = "❌ Invalid file type! Upload PDF, DOC or DOCX.";

    } elseif ($fileSize > 2000000) {

        $message = "❌ File is too large! Maximum size is 2 MB.";

    } elseif ($fileName == "") {

        $message = "❌ Please select a resume.";

    } else {

        $newName = "resume_" . time() . "." . $fileType;

        if (move_uploaded_file(
            $tempFile,
            "$folder/$newName"
        )) {
            $message = "✅ Resume uploaded successfully!";
        } else {
            $message = "❌ Upload failed.";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Resume Upload</title>

<style>

body {
    margin: 0;
    font-family: Arial;
    background: linear-gradient(135deg, #172554, #3b82f6);
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.card {
    width: 450px;
    background: white;
    padding: 35px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 12px 30px #111;
}

h1 {
    color: #1e40af;
}

input[type="file"] {
    margin: 25px;
}

input[type="submit"] {
    padding: 12px 30px;
    background: #2563eb;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.message {
    margin-top: 20px;
    padding: 15px;
    background: #eff6ff;
    color: #1e3a8a;
    border-radius: 10px;
    font-weight: bold;
}

.info {
    margin-top: 20px;
    color: #64748b;
}

</style>

</head>

<body>

<div class="card">

<h1> Resume Upload</h1>

<p>Upload your resume for job application</p>

<form method="post"
      enctype="multipart/form-data">

<input type="file"
       name="resume"
       accept=".pdf,.doc,.docx"
       required>

<br>

<input type="submit"
       name="upload"
       value="Upload Resume">

</form>

<?php

if ($message != "") {
    echo "<div class='message'>$message</div>";
}

?>

<div class="info">
    Accepted: PDF, DOC, DOCX<br>
    Maximum Size: 2 MB
</div>

</div>

</body>

</html>