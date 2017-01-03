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

        <h2>Students' Information</h2>

        <div class="span11">

            <div class="widget ">

                <div class="widget-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3></h3>
                        </div>


                    </div>
                </div>
                <!-- /widget-header -->



                <div class="widget-content">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th style="text-align: center">Class</th>
                            <th style="text-align: center">Details</th>
                            <th style="text-align: center">Total Students</th>

                        </tr>

                        </thead>
                        <?php


                        $statement = $db->prepare("SELECT class_name FROM class_teacher_info GROUP BY class_name ORDER BY value ASC ");
                        $statement->execute();
                        $allclass  = $statement->fetchAll(PDO::FETCH_ASSOC);



                        ?>
                        <tbody>
                        <?php foreach($allclass as $cls){ ?>
                            <tr>
                                <td class="text-center" style="font-weight: bold; padding: 80px 10px; text-align: center">
                                    <?php echo $cls['class_name']; ?>
                                </td>
                                <td >
                                    <table class="table table-bordered">
                                        <thead>
                                        <th style="text-align: center">Section</th>
                                        <th style="text-align: center">Class Teacher</th>
                                        <th style="text-align: center">Total Students</th>
                                        <th style="text-align: center">Male Students</th>
                                        <th style="text-align: center">Female Students</th>
                                        <th style="text-align: center">Muslim Students</th>
                                        <th style="text-align: center">Hindu Students</th>
                                        <th style="text-align: center">Others</th>
                                        </thead>
                                        <?php

                                        $cn = $cls['class_name'];

                                        $statement1 = $db->prepare("SELECT * FROM class_teacher_info where class_name='$cn' ");
                                        $statement1->execute();

                                        $allsec= $statement1->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($allsec as $cl)
                                        {
                                            ?>

                                            <tbody>
                                            <tr>
                                                <td  style="text-align: left"><?php echo $cl['section'] ; ?></td>
                                                <td  style="text-align: left">
                                                    <?php echo $cl['teacher_name']; ?></td>
                                                <td  style="text-align: center">
                                                    <?php

                                                    $cn1 = $cl['class_name'];
                                                    $cn2 = $cl['section'];

                                                    $statement2 = $db->prepare("SELECT * FROM student_to_section_update where class='$cn1' AND  section='$cn2' ");
                                                    $statement2->execute();
                                                    //  $st_count =$statement2->fetchAll(PDO::FETCH_ASSOC);
                                                    $count = $statement2->rowCount();
                                                    ?>
                                                    <?php echo $count ; ?>
                                                </td>
                                                <td  style="text-align: center">
                                                    <?php
                                                    $cn3 = $cl['class_name'];
                                                    $cn4 = $cl['section'];

                                                    $statement3 = $db->prepare("SELECT * FROM class_std where std_gender='Male' and std_class ='$cn3' and std_section='$cn4' ");
                                                    $statement3->execute();
                                                    // $male = ClassWiseStd::where('std_gender','=','Male')->where('std_class','=',$cl->class_name)->where('std_section','=', $cl->section)->get();
                                                    $male_std = $statement3->rowCount();
                                                    ?>
                                                    <?php echo $male_std ; ?>
                                                </td>
                                                <td  style="text-align: center">
                                                    <?php
                                                    $feml_std = $count - $male_std;
                                                    echo $feml_std;
                                                    ?>
                                                </td>
                                                <td  style="text-align: center">
                                                    <?php

                                                    $cn5 = $cl['class_name'];
                                                    $cn6 = $cl['section'];

                                                    $statement3 = $db->prepare("SELECT * FROM class_std where std_religion='Islam' and std_class ='$cn5' and std_section='$cn6' ");
                                                    $statement3->execute();

                                                    //  $religion_m = ClassWiseStd::where('std_religion','=','Islam')->where('std_class','=',$cl->class_name)->where('std_section','=', $cl->section)->get();
                                                    $std_religion_m = $statement3->rowCount();
                                                    echo $std_religion_m;
                                                    ?>
                                                </td>
                                                <td  style="text-align: center">
                                                    <?php

                                                    $cn7 = $cl['class_name'];
                                                    $cn8 = $cl['section'];

                                                    $statement4 = $db->prepare("SELECT * FROM class_std where std_religion='Hindu' and std_class ='$cn7' and std_section='$cn8' ");
                                                    $statement4->execute();

                                                    $std_religion_h = $statement4->rowCount();
                                                    echo $std_religion_h;
                                                    ?>
                                                </td>
                                                <td  style="text-align: center">
                                                    <?php
                                                    $others = $count - ($std_religion_m + $std_religion_h);
                                                    echo $others;
                                                    ?>
                                                </td>
                                            </tr>
                                            </tbody>
                                        <?php } ?>
                                    </table>
                                </td>
                                <td class="text-center" style="font-weight: bold; padding: 80px 10px; text-align: center">
                                    <?php
                                    $cn9 = $cl['class_name'];

                                    $statement5 = $db->prepare("SELECT * FROM student_to_section where class ='$cn9' ");
                                    $statement5->execute();
                                    $s_count = $statement5->rowCount();
                                    echo $s_count;
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<?php
require('footer.php');
?>




</body>
</html>