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
        <div class="main-content" style="width: 100%;">

            <h1 style="text-align: center;">All News</h1>
            <?php
            $i=0;
            foreach($news as $new)
            {
                $title=$new['title'];
                $date=$new['date'];
                $author=$new['author'];
                $description=$new['description'];

                ?>
                <section class="posts-con">
                    <article>
                        <div class="info">
                            <h3><?php echo($title); ?></h3>
                            <p class="info-line"><span class="time"><?php echo($date); ?></span><span class="author"><?php echo($author); ?></span></p>
                            <p style="text-align: justify;"><?php echo($description); ?></p>

                            <!-- Trigger the modal with a button -->
                            <a class="more" href="#" data-toggle="modal" data-target="#allnews<?php echo($i); ?>">Read more</a>

                            <!-- Modal -->
                            <div class="modal fade" id="allnews<?php echo($i); ?>" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title"><?php echo($title); ?></h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo($description); ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </article>
                </section>
                <?php
                $i++;
            }
            ?>
        </div>
    </div>
</div>


<?php
require('footer.php');
?>


</body>
</html>