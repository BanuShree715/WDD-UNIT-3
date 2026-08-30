<?php

$file = "article.txt";

if (file_exists($file)) {

    $article = file_get_contents($file);
    $lines = file($file);
    $totalLines = count($lines);

} else {

    $article = "No article available.";
    $totalLines = 0;
}

?>


<html>
<head>

    <title>Digital Article Library</title>

    <style>

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #141e30, #243b55);
            color: #333;
        }

        .header {
            text-align: center;
            padding: 35px;
            color: white;
        }

        .header h1 {
            font-size: 38px;
            margin-bottom: 5px;
        }

        .header p {
            color: #bde0fe;
        }

        .card {
            width: 70%;
            margin: auto;
            background: #ffffff;
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.4);
        }

        .article-title {
            color: #243b55;
            border-bottom: 3px solid #00b4d8;
            padding-bottom: 12px;
        }

        .content {
            background: #f1f5f9;
            padding: 25px;
            border-radius: 15px;
            line-height: 1.9;
            font-size: 18px;
            margin-top: 20px;
        }

        .info {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
        }

        .box {
            width: 45%;
            padding: 20px;
            text-align: center;
            background: #e0f7fa;
            border-radius: 15px;
        }

        .number {
            font-size: 30px;
            font-weight: bold;
            color: #0077b6;
        }

        .footer {
            text-align: center;
            color: #bde0fe;
            margin-top: 30px;
        }

    </style>

</head>

<body>

    <div class="header">

        <h1> Digital Article Library</h1>

        <p>Simple PHP File Reading Application</p>

    </div>


    <div class="card">

        <h2 class="article-title"> Featured Article</h2>

        <div class="content">

            <?php
            echo nl2br(htmlspecialchars($article));
            ?>

        </div>


        <div class="info">

            <div class="box">

                <div class="number">
                    <?php echo $totalLines; ?>
                </div>

                <div>
                     Total Lines
                </div>

            </div>


            <div class="box">

                <div class="number">
                    <?php echo strlen($article); ?>
                </div>

                <div>
                     Characters
                </div>

            </div>

        </div>

    </div>


    <div class="footer">

        © 2026 Digital Article Library

    </div>

</body>
</html>