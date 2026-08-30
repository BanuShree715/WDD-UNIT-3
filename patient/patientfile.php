<?php

$folder = "patients/";

if (!is_dir($folder)) {
    mkdir($folder);
}

$message = "";
$result = "";



if (isset($_POST["add"])) {

    $id = $_POST["id"];
    $name = $_POST["name"];
    $age = $_POST["age"];
    $department = $_POST["department"];

    $file = $folder . $department . ".txt";

    $record = "$id,$name,$age,$department\n";

    file_put_contents($file, $record, FILE_APPEND);

    $message = "Patient record added successfully!";
}



if (isset($_POST["search"])) {

    $searchID = $_POST["search_id"];

    $files = glob($folder . "*.txt");

    foreach ($files as $file) {

        $records = file($file);

        foreach ($records as $record) {

            $data = explode(",", trim($record));

            if ($data[0] == $searchID) {

                $result = "
                <b>Patient ID:</b> $data[0]<br>
                <b>Name:</b> $data[1]<br>
                <b>Age:</b> $data[2]<br>
                <b>Department:</b> $data[3]
                ";

                break 2;
            }
        }
    }

    if ($result == "") {
        $result = " No patient found with this ID.";
    }
}

?>

<!DOCTYPE html>
<html>

<head>

<title>CarePoint Patient System</title>

<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #eef7f6;
}




.header {
    background: linear-gradient(135deg, #006d77, #00a896);
    color: white;
    padding: 25px 8%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 25px;
    font-weight: bold;
}

.status {
    background: #d8f3dc;
    color: #1b4332;
    padding: 10px 18px;
    border-radius: 20px;
}


.container {
    width: 90%;
    max-width: 1100px;
    margin: 40px auto;
}




.welcome {
    margin-bottom: 30px;
}

.welcome h1 {
    color: #006d77;
}

.welcome p {
    color: #52796f;
}


/* CARDS */

.cards {
    display: flex;
    gap: 25px;
    flex-wrap: wrap;
}

.card {
    background: white;
    padding: 30px;
    border-radius: 20px;
    flex: 1;
    min-width: 320px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
}

.card h2 {
    color: #006d77;
    margin-top: 0;
}




input, select {
    width: 100%;
    padding: 13px;
    margin: 8px 0 15px;
    border: 1px solid #b7e4c7;
    border-radius: 10px;
    font-size: 15px;
}

input:focus, select:focus {
    outline: none;
    border-color: #00a896;
}




button {
    width: 100%;
    padding: 13px;
    border: none;
    border-radius: 10px;
    background: #00a896;
    color: white;
    font-size: 16px;
    cursor: pointer;
}

button:hover {
    background: #007f73;
}



.message {
    margin-top: 25px;
    padding: 15px;
    background: #d8f3dc;
    color: #1b4332;
    border-radius: 10px;
    text-align: center;
}




.result {
    margin-top: 20px;
    padding: 20px;
    background: #e0fbfc;
    border-left: 5px solid #00a896;
    border-radius: 10px;
    line-height: 2;
}


/* DEPARTMENT */

.departments {
    margin-top: 30px;
    background: white;
    padding: 25px;
    border-radius: 20px;
}

.departments h2 {
    color: #006d77;
}

.department-list {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.department {
    flex: 1;
    min-width: 180px;
    padding: 20px;
    text-align: center;
    background: #f1faee;
    border-radius: 15px;
    font-weight: bold;
    color: #386641;
}


/* FOOTER */

footer {
    text-align: center;
    padding: 25px;
    color: #52796f;
}

</style>

</head>


<body>




<div class="header">

    <div class="logo">
         CarePoint
    </div>

    <div class="status">
         System Online
    </div>

</div>


<div class="container">


    <!-- WELCOME -->

    <div class="welcome">

        <h1>Patient File Management</h1>

        <p>
            Securely store and quickly retrieve patient information.
        </p>

    </div>


    <div class="cards">


        <!-- ADD PATIENT -->

        <div class="card">

            <h2> Add Patient</h2>

            <form method="post">

                <input
                    type="text"
                    name="id"
                    placeholder="Patient ID"
                    required
                >

                <input
                    type="text"
                    name="name"
                    placeholder="Patient Name"
                    required
                >

                <input
                    type="number"
                    name="age"
                    placeholder="Patient Age"
                    required
                >

                <select name="department" required>

                    <option value="">
                        Select Department
                    </option>

                    <option value="Cardiology">
                         Cardiology
                    </option>

                    <option value="Neurology">
                         Neurology
                    </option>

                    <option value="Orthopedics">
                         Orthopedics
                    </option>

                </select>

                <button name="add">
                    Save Patient
                </button>

            </form>

        </div>


     

        <div class="card">

            <h2> Find Patient</h2>

            <form method="post">

                <input
                    type="text"
                    name="search_id"
                    placeholder="Enter Patient ID"
                    required
                >

                <button name="search">
                    Search Record
                </button>

            </form>


            <?php if ($result != "") { ?>

                <div class="result">

                    <?php echo $result; ?>

                </div>

            <?php } ?>

        </div>

    </div>


  

    <?php if ($message != "") { ?>

        <div class="message">

             <?php echo $message; ?>

        </div>

    <?php } ?>


   

    <div class="departments">

        <h2> Department Files</h2>

        <div class="department-list">

            <div class="department">
                <br>
                Cardiology
            </div>

            <div class="department">
                <br>
                Neurology
            </div>

            <div class="department">
                <br>
                Orthopedics
            </div>

        </div>

    </div>

</div>


<footer>

    CarePoint Patient Management System © 2026

</footer>


</body>

</html>