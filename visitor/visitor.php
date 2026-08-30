<?php

session_start();

/* Create session counter */

if (!isset($_SESSION["page_count"])) {

    $_SESSION["page_count"] = 0;
}

/* Increase page visit count */

$_SESSION["page_count"]++;

$currentPage = basename($_SERVER["PHP_SELF"]);

?>

<!DOCTYPE html>
<html>

<head>

<title>Visitor Session Tracker</title>

<style>

body {
    font-family: Arial;
    background: linear-gradient(135deg, #164e63, #06b6d4);
    margin: 0;
    padding: 50px;
}

.container {
    width: 600px;
    margin: auto;
    background: white;
    padding: 35px;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 10px 30px black;
}

h1 {
    color: #0e7490;
}

.counter {
    font-size: 60px;
    color: #0891b2;
    font-weight: bold;
    margin: 20px;
}

.page {
    background: #ecfeff;
    padding: 15px;
    border-radius: 10px;
}

button {
    padding: 12px 25px;
    background: #0891b2;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

</style>

</head>

<body>

<div class="container">

<h1> Visitor Session Tracker</h1>

<div class="page">

<p>Current Page</p>

<h2>
<?php
echo htmlspecialchars($currentPage);
?>
</h2>

</div>

<p>Pages Visited During This Session</p>

<div class="counter">

<?php
echo $_SESSION["page_count"];
?>

</div>

<p>Page visits are counted using PHP sessions.</p>

<button onclick="location.reload()">
    Visit Page Again
</button>

</div>

</body>

</html>