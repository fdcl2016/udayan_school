<?php

include('config.php');

$statement = $db->prepare("SELECT * FROM notice ORDER BY idnotice DESC;");
$statement->execute();
$news = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html lang="en" xmlns="http://www.w3.org/1999/html"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <title>UDAYAN UCHCHA MADHYAMIK BIDYALAYA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <link rel="stylesheet" media="all" href="css/style.css">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<?php
require('header.php');
?>

<div class="divider"></div>

<div class="content">
    <div class="container">

        <h1 class="single"></h1>

        <div class="main-content">
            <div class="slider-con">
                <ul class="bxslider">
                    <li>
                        <div class="slide">
                            <ul>
                                <li></li>
                                
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="slide">
                            <ul>
                                <li></li>
                                
                            </ul>
                        </div>
                    </li>
                    <li>
                        <div class="slide">
                            <ul>
                                <li></li>
                                
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>


    </div>
</div>


<?php
require('footer.php');
?>




</body>
</html>