<?php

$base = "media";

$folders = ["images", "videos"];

foreach ($folders as $folder) {
    if (!is_dir("$base/$folder")) {
        mkdir("$base/$folder", 0777, true);
    }
}

$message = "";

/* Upload multimedia file */

if (isset($_POST["upload"])) {

    $file = $_FILES["media"];
    $name = basename($file["name"]);
    $extension = strtolower(pathinfo($name, PATHINFO_EXTENSION));

    $imageTypes = ["jpg", "jpeg", "png", "gif"];
    $videoTypes = ["mp4", "avi", "mkv"];

    if (in_array($extension, $imageTypes)) {
        $location = "$base/images/$name";
    } elseif (in_array($extension, $videoTypes)) {
        $location = "$base/videos/$name";
    } else {
        $message = "Only image and video files are allowed.";
        $location = "";
    }

    if ($location != "") {

        if (move_uploaded_file($file["tmp_name"], $location)) {
            $message = "Multimedia file uploaded successfully!";
        } else {
            $message = "Upload failed.";
        }
    }
}

/* Search files */

$search = "";

if (isset($_POST["search"])) {
    $search = strtolower($_POST["keyword"]);
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Multimedia File Manager</title>

<style>

body {
    font-family: Arial;
    background: linear-gradient(135deg, #172554, #0f766e);
    margin: 0;
    padding: 40px;
}

.container {
    width: 750px;
    margin: auto;
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 10px 30px black;
}

h1 {
    text-align: center;
    color: #164e63;
}

.box {
    background: #ecfeff;
    padding: 20px;
    margin: 20px 0;
    border-radius: 12px;
}

input {
    padding: 11px;
    border: 1px solid #67e8f9;
    border-radius: 7px;
    margin: 5px;
}

input[type="submit"] {
    background: #0891b2;
    color: white;
    border: none;
    cursor: pointer;
}

.message {
    background: #dcfce7;
    color: #166534;
    padding: 12px;
    border-radius: 8px;
    text-align: center;
}

.file {
    background: #f0fdfa;
    padding: 12px;
    margin: 8px;
    border-left: 5px solid #14b8a6;
    border-radius: 6px;
}

</style>

</head>

<body>

<div class="container">

<h1> Multimedia File Manager</h1>

<?php

if ($message != "") {
    echo "<div class='message'>$message</div>";
}

?>

<div class="box">

<h3> Upload Image / Video</h3>

<form method="post" enctype="multipart/form-data">

<input type="file"
       name="media"
       required>

<input type="submit"
       name="upload"
       value="Upload">

</form>

</div>

<div class="box">

<h3> Search Multimedia</h3>

<form method="post">

<input type="text"
       name="keyword"
       placeholder="Search file name"
       required>

<input type="submit"
       name="search"
       value="Search">

</form>

</div>

<div class="box">

<h3> Images</h3>

<?php

$files = scandir("$base/images");

foreach ($files as $file) {

    if ($file != "." && $file != "..") {

        if ($search == "" ||
            strpos(strtolower($file), $search) !== false) {

            echo "<div class='file'> $file</div>";
        }
    }
}

?>

<h3> Videos</h3>

<?php

$files = scandir("$base/videos");

foreach ($files as $file) {

    if ($file != "." && $file != "..") {

        if ($search == "" ||
            strpos(strtolower($file), $search) !== false) {

            echo "<div class='file'> $file</div>";
        }
    }
}

?>

</div>

</div>

</body>

</html>