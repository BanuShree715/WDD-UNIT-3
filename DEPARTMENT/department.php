<?php

$message = "";

if (isset($_POST["action"])) {

    $action = $_POST["action"];
    $folder = $_POST["folder"];

    if ($action == "create") {

        if (!file_exists($folder)) {
            mkdir($folder);
            $message = "Department folder created!";
        } else {
            $message = "Folder already exists!";
        }
    }

    if ($action == "rename") {

        $newname = $_POST["newname"];

        if (file_exists($folder)) {
            rename($folder, $newname);
            $message = "Folder renamed successfully!";
        } else {
            $message = "Folder does not exist!";
        }
    }

    if ($action == "delete") {

        if (is_dir($folder)) {

            $items = scandir($folder);

            if (count($items) == 2) {
                rmdir($folder);
                $message = "Folder deleted!";
            } else {
                $message = "Please delete files inside the folder first.";
            }

        } else {
            $message = "Folder not found!";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Department Folder Manager</title>

<style>

body {
    font-family: Arial;
    background: #1e293b;
    margin: 0;
    padding: 50px;
}

.main {
    width: 600px;
    margin: auto;
    background: #f8fafc;
    padding: 30px;
    border-radius: 15px;
}

h1 {
    text-align: center;
    color: #0f172a;
}

.box {
    background: #e0f2fe;
    padding: 20px;
    margin: 15px 0;
    border-radius: 10px;
}

input {
    padding: 10px;
    margin: 5px;
    border-radius: 6px;
    border: 1px solid #94a3b8;
}

button {
    padding: 10px 20px;
    background: #0284c7;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

button:hover {
    background: #0369a1;
}

.msg {
    background: #dcfce7;
    color: #166534;
    padding: 12px;
    text-align: center;
    border-radius: 8px;
}

</style>

</head>

<body>

<div class="main">

<h1> Department File Manager</h1>

<?php

if ($message != "") {
    echo "<div class='msg'>$message</div>";
}

?>

<div class="box">

<h3>Create Folder</h3>

<form method="post">

<input type="text"
       name="folder"
       placeholder="Department name"
       required>

<input type="hidden"
       name="action"
       value="create">

<button>Create</button>

</form>

</div>

<div class="box">

<h3>Rename Folder</h3>

<form method="post">

<input type="text"
       name="folder"
       placeholder="Existing folder"
       required>

<input type="text"
       name="newname"
       placeholder="New folder name"
       required>

<input type="hidden"
       name="action"
       value="rename">

<button>Rename</button>

</form>

</div>

<div class="box">

<h3>Delete Folder</h3>

<form method="post">

<input type="text"
       name="folder"
       placeholder="Folder name"
       required>

<input type="hidden"
       name="action"
       value="delete">

<button>Delete</button>

</form>

</div>

</div>

</body>

</html>