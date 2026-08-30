<?php

$mainFolder = "reports";

$folders = [
    "academic",
    "finance",
    "projects"
];

foreach ($folders as $folder) {

    if (!is_dir("$mainFolder/$folder")) {
        mkdir("$mainFolder/$folder", 0777, true);
    }
}

$selectedFolder = "";
$message = "";

/* Select folder */

if (isset($_POST["show"])) {

    $selectedFolder = $_POST["category"];

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Report File Access</title>

<style>

body {
    font-family: Arial;
    background: linear-gradient(135deg, #064e3b, #10b981);
    margin: 0;
    padding: 50px;
}

.container {
    width: 650px;
    margin: auto;
    background: white;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 10px 30px #222;
}

h1 {
    text-align: center;
    color: #047857;
}

select {
    width: 70%;
    padding: 12px;
    border: 2px solid #6ee7b7;
    border-radius: 8px;
}

button {
    padding: 12px 20px;
    background: #059669;
    color: white;
    border: none;
    border-radius: 8px;
}

.report {
    background: #ecfdf5;
    padding: 15px;
    margin: 10px 0;
    border-left: 5px solid #10b981;
    border-radius: 8px;
}

a {
    color: #047857;
    text-decoration: none;
    font-weight: bold;
}

</style>

</head>

<body>

<div class="container">

<h1> Report Access System</h1>

<form method="post">

<select name="category">

<option value="academic">Academic Reports</option>
<option value="finance">Finance Reports</option>
<option value="projects">Project Reports</option>

</select>

<button type="submit" name="show">
    View Reports
</button>

</form>

<hr>

<?php

if ($selectedFolder != "") {

    echo "<h2>Available Reports</h2>";

    $path = "$mainFolder/$selectedFolder";

    $files = scandir($path);

    $found = false;

    foreach ($files as $file) {

        if ($file != "." && $file != "..") {

            $found = true;

            echo "<div class='report'>";
            echo " " . htmlspecialchars($file);
            echo "<br><br>";

            echo "<a href='$path/" .
                 rawurlencode($file) .
                 "' target='_blank'>";

            echo "Open Report →";

            echo "</a>";

            echo "</div>";
        }
    }

    if (!$found) {
        echo "<p>No reports available in this folder.</p>";
    }
}

?>

</div>

</body>

</html>