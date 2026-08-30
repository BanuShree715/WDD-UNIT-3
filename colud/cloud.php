<?php

$folder = "cloud_documents";

if (!is_dir($folder)) {
    mkdir($folder);
}

$message = "";

/* Upload document */

if (isset($_POST["upload"])) {

    $name = basename($_FILES["document"]["name"]);
    $temp = $_FILES["document"]["tmp_name"];

    $allowed = ["pdf", "doc", "docx", "txt"];

    $extension =
        strtolower(pathinfo($name, PATHINFO_EXTENSION));

    if (in_array($extension, $allowed)) {

        if (move_uploaded_file(
            $temp,
            "$folder/$name"
        )) {

            $message = "Document uploaded successfully!";
        }

    } else {

        $message = "Only PDF, DOC, DOCX and TXT files are allowed.";
    }
}


/* Delete document */

if (isset($_POST["delete"])) {

    $file = basename($_POST["file"]);

    if (file_exists("$folder/$file")) {

        unlink("$folder/$file");

        $message = "Document deleted successfully!";

    } else {

        $message = "Document not found!";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Cloud Document Manager</title>

<style>

body {
    font-family: Arial;
    background: linear-gradient(135deg, #fef3c7, #fca5a5);
    margin: 0;
    padding: 40px;
}

.container {
    width: 700px;
    margin: auto;
    background: white;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 10px 30px #555;
}

h1 {
    text-align: center;
    color: #9a3412;
}

.upload {
    background: #fff7ed;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
}

input {
    padding: 11px;
    margin: 5px;
    border: 1px solid #fdba74;
    border-radius: 7px;
}

input[type="submit"] {
    background: #ea580c;
    color: white;
    border: none;
    cursor: pointer;
}

.document {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #fffbeb;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border-left: 5px solid #f97316;
}

.delete {
    background: #dc2626 !important;
}

.message {
    background: #dcfce7;
    color: #166534;
    padding: 12px;
    text-align: center;
    border-radius: 8px;
    margin-bottom: 15px;
}

</style>

</head>

<body>

<div class="container">

<h1> Cloud Document Manager</h1>

<?php

if ($message != "") {
    echo "<div class='message'>$message</div>";
}

?>

<div class="upload">

<h3> Upload Document</h3>

<form method="post"
      enctype="multipart/form-data">

<input type="file"
       name="document"
       required>

<input type="submit"
       name="upload"
       value="Upload Document">

</form>

</div>

<h3> Stored Documents</h3>

<?php

$files = scandir($folder);

foreach ($files as $file) {

    if ($file != "." && $file != "..") {

        echo "<div class='document'>";

        echo " " .
             htmlspecialchars($file);

        echo "
        <form method='post'>

            <input type='hidden'
                   name='file'
                   value='" . htmlspecialchars($file) . "'>

            <input type='submit'
                   name='delete'
                   value='Delete'
                   class='delete'>

        </form>";

        echo "</div>";
    }
}

?>

</div>

</body>

</html>