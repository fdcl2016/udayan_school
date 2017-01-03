<?php

include('config.php');

$statement = $db->prepare("SELECT * FROM events ORDER BY idevents DESC;");
$statement->execute();
$events = $statement->fetchAll(PDO::FETCH_ASSOC);

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
        <div class="main-content" style="width: 100%;">
            <h1 style="text-align: center;">All Events</h1>
            <?php
            $j=0;
            foreach($events as $event)
            {
            $start_date = $event['start_date'];
            $event_description = $event['event_description'];
            $event_name = $event['event_name'];
            $event_place = $event['event_place'];
            $start_time=$event['start_time'];

            $pieces = explode("/", $start_date);

            $e_month_no = $pieces[0];
            $e_date = $pieces[1];
            $e_year = $pieces[2];

            if ($e_month_no == 1) {
                $e_month = "JAN";
            } else if ($e_month_no == 2) {
                $e_month = "FEB";
            } else if ($e_month_no == 3) {
                $e_month = "MAR";
            } else if ($e_month_no == 4) {
                $e_month = "APR";
            } else if ($e_month_no == 5) {
                $e_month = "MAY";
            } else if ($e_month_no == 6) {
                $e_month = "JUN";
            } else if ($e_month_no == 7) {
                $e_month = "JUL";
            } else if ($e_month_no == 8) {
                $e_month = "AUG";
            } else if ($e_month_no == 9) {
                $e_month = "SEP";
            } else if ($e_month_no == 10) {
                $e_month = "OCT";
            } else if ($e_month_no == 11) {
                $e_month = "NOV";
            } else if ($e_month_no == 12) {
                $e_month = "DEC";
            }
            ?>
            <section class="posts-con">
                <article>
                    <div class="current-date">
                        <p><?php echo($e_month); ?></p>
                        <p class="date"><?php echo($e_date); ?></p>
                        <p><?php echo($e_year); ?></p>
                    </div>
                    <div class="info">
                        <h3><?php echo($event_name); ?></h3>
                        <p class="info-line"><span class="time"><?php echo($start_time); ?></span><span class="place"><?php echo($event_place); ?></span></p>
                        <p style="text-align: justify;"><?php echo($event_description); ?>

                            <?php
                            if (str_word_count($event_description) > 30)
                            {
                            ?>

                            <br>

                            <!-- Trigger the modal with a button -->
                            <a class="more" href="#" data-toggle="modal" data-target="#allevents<?php echo($j); ?>">Read more</a>

                            <!-- Modal -->
                            <div class="modal fade" id="allevents<?php echo($j); ?>" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><?php echo($event_name); ?></h4>
                                        </div>
                                        <div class="modal-body">
                        <p><?php echo($event_description); ?></p>
                    </div>
        </div>
    </div>
</div>
</p>
<?php
}
else {
?>
</p>
<?php
}
?>
</div>
</article>
</section>

<?php
$j++;
}
?>
</div>
</div>


<?php
require('footer.php');
?>




</body>
</html>