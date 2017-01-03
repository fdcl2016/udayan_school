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
    <title>UDAYAN UCHCHA MADHYAMIK BIDYALAYA
</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <link rel="stylesheet" media="all" href="css/style.css">
    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->


    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">


    <link rel="stylesheet" href="css/font-awesome.css">
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/bootstrap.js"></script>

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

        <h2>Teachers' Information</h2>


        <div class="span12">

            <div class="widget ">

                
                <div class="widget-content">
                    <div class="tabbable">
                        <div class="tab-content">
                            <div class="panel-heading fdcl_panel">Principle and Vice-Principle</div>
                            <div class="fdcl_content_profile">
                                <center>
<!--                                    @if($headmaster!=""&&$headmaster!=null)-->
                                    <div class="col-sm-12">
                                        <div class="col-sm-4"></div>
                                        <div class="span3">
<!--                                            @if($headmaster->image!=null)-->
                                            <img src="uploads/head.jpg" width="100px" height="80px" class="fdcl_image_profile_dir">
<!--                                            @else-->

<!--                                            @endif-->
                                           <a href=""><h5><b>Dr. Umme Salema</b></h5></a>
                                           <p>Principal</p>
                                        </div>
                                    </div>


<?php


$statement = $db->prepare("SELECT * FROM teacherinfo where designation ='Asstt. Headmaster' ORDER BY teacher_name ASC;");
$statement->execute();
$asstheadmaster  = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<!--                                    @endif-->
<!--                                    @if($asstheadmaster!="[]")-->
<!---->
                                <?php foreach($asstheadmaster as $ast) { ?>

                                    <div class="col-sm-3">
                                        <?php if ($ast->image != null) { ?>
                                            <img src="uploads/<?php echo $ast->image; ?>"
                                                 class="fdcl_image_profile_dir">
                                        <?php } else { ?>

                                            <img src="uploads/maleandfemale.jpg}" class="fdcl_image_profile_dir">-->
                                        <?php } ?>

                                        <a href="#"><h4><?php echo $ast->teacher_name; ?></h4></a>

                                        <p><?php echo $ast->designation; ?></p>
                                    </div>
                                    <?php
                                }

                                  ?>
                                </center>
                            </div>
                        </div>
<?php


$statement1 = $db->prepare("SELECT * FROM department ORDER BY department_name ASC;");
$statement1->execute();
$department  = $statement1->fetchAll(PDO::FETCH_ASSOC);
?>
                        <br/><br/>
                      <?php if($department!="[]")

                        foreach($department as $dept) { ?>

                        <div class="tab-content">
                           <br/> <div class="panel-heading fdcl_panel"><?php echo $dept['department_name'] ;?></div>
                            <div class="fdcl_content_profile">
                                <?php
                                $v = $dept['department_name'];

                                $statement2 = $db->prepare("SELECT * FROM teacherinfo where department ='$v' ");
                                $statement2->execute();
                                $teacherinfo  = $statement2->fetchAll(PDO::FETCH_ASSOC);
                                // $teacherinfo = TeacherInfo::where('department','=',$dept->department_name)->orderBy('teacher_name')->get();?>
                                <center>
                                  <?php if($teacherinfo!="[]")
                                    foreach($teacherinfo as $info){ ?>
                                    <div class="col-sm-3">
                                  <?php if($info['image']!=null) { ?>
                                        <img src="uploads/<?php echo $info['image'] ; ?>"  class="fdcl_image_profile_dir">
                                     <?php } else { ?>
                                        <img src="uploads/maleandfemale.jpg" class="fdcl_image_profile_dir">
                                      <?php } ?>
                                        <a href=""><h5><?php echo $info['teacher_name'] ; ?></h5></a>

                                        <p><?php echo $info['designation'] ; ?></p>
                                    </div>

                                    <?php } ?>
                                </center>
                                <br/><br/>
                            </div>
                        </div>


                        <?php } ?>
                        <br/>

                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- /widget-content -->

</div>
<!-- /widget -->

</div> <!-- /span8 -->

    </div>

<?php
require('footer.php');
?>




</body>
</html>