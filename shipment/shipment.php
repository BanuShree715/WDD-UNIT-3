<?php
$folder = "shipment_data";

if (!is_dir($folder)) {
    mkdir($folder);
}

$records = [
    "SHIP101" => "Customer: Banu\nProduct: Laptop\nDestination: Coimbatore\nStatus: Shipped",
    "SHIP102" => "Customer: Arun\nProduct: Mobile\nDestination: Chennai\nStatus: Delivered",
    "SHIP103" => "Customer: Priya\nProduct: Books\nDestination: Bangalore\nStatus: Processing"
];

foreach ($records as $id => $data) {
    file_put_contents("$folder/$id.txt", $data);
}
?>


<html>
<head>
    <title>Shipment Manager</title>
    <style>
        body {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            font-family: Arial;
            padding: 40px;
        }

        .container {
            width: 70%;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px #777;
        }

        h1 {
            text-align: center;
            color: #1e3a8a;
        }

        .record {
            background: #eff6ff;
            padding: 15px;
            margin: 15px 0;
            border-left: 6px solid #2563eb;
            border-radius: 8px;
        }
    </style>
</head>

<body>

<div class="container">
    <h1> Shipment Records</h1>

    <?php
    $files = scandir($folder);

    foreach ($files as $file) {
        if ($file != "." && $file != "..") {
            echo "<div class='record'>";
            echo "<h3>$file</h3>";
            echo nl2br(file_get_contents("$folder/$file"));
            echo "</div>";
        }
    }
    ?>
</div>

</body>
</html>