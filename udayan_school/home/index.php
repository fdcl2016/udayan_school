<?php

include('config.php');
?>

<!DOCTYPE html>
<!--[if IE 8]> <html class="ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>UDAYAN UCHCHA MADHYAMIK BIDYALAYA</title>
	<link rel="shortcut icon" type="image/gif" href="images/4d.gif"/>
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

<div class="slider" >
	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
			<li data-target="#carousel-example-generic" data-slide-to="3"></li>
			<li data-target="#carousel-example-generic" data-slide-to="4"></li>
		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="images/u6.jpg" alt="1">
				<!--
				<div class="carousel-caption">
					<h1 style="color: #008bc4;">UDAYAN UCHCHA MADHYAMIK BIDYALAYA</h1>
					<p style="text-align: left;">Udayan Higher Secondary School Dhaka, formerly known as Udayan Bidyalaya is a private higher secondary school in Bangladesh, established in 1955 by the University of Dhaka.</p>
				</div>
				-->
			</div>
			<div class="item">
				<img src="images/u8.jpg" alt="2">
				<!--
				<div class="carousel-caption">
					<h1 style="color: #008bc4;">UDAYAN UCHCHA MADHYAMIK BIDYALAYA</h1>
					<p style="text-align: left;">Udayan Higher Secondary School Dhaka, formerly known as Udayan Bidyalaya is a private higher secondary school in Bangladesh, established in 1955 by the University of Dhaka.</p>
				</div>
				-->
			</div>
			<div class="item">
				<img src="images/u7.jpg" alt="3">
				<!--
				<div class="carousel-caption">
					<h1 style="color: #008bc4;">UDAYAN UCHCHA MADHYAMIK BIDYALAYA</h1>
					<p style="text-align: left;">Udayan Higher Secondary School Dhaka, formerly known as Udayan Bidyalaya is a private higher secondary school in Bangladesh, established in 1955 by the University of Dhaka.</p>
				</div>
				-->
			</div>
			<div class="item">
				<img src="images/u2.jpg" alt="4">
				<!--
				<div class="carousel-caption">
					<h1 style="color: #008bc4;">UDAYAN UCHCHA MADHYAMIK BIDYALAYA</h1>
					<p style="text-align: left;">Udayan Higher Secondary School Dhaka, formerly known as Udayan Bidyalaya is a private higher secondary school in Bangladesh, established in 1955 by the University of Dhaka.</p>
				</div>
				-->
			</div>
			<div class="item">
				<img src="images/u4.jpg" alt="4">
				<!--
				<div class="carousel-caption">
					<h1 style="color: #008bc4;">UDAYAN UCHCHA MADHYAMIK BIDYALAYA</h1>
					<p style="text-align: left;">Udayan Higher Secondary School Dhaka, formerly known as Udayan Bidyalaya is a private higher secondary school in Bangladesh, established in 1955 by the University of Dhaka.</p>
				</div>
				-->
			</div>

		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<div class="bg-bottom"></div>
</div>

<!--<div class="slider">-->
<!--	<ul class="bxslider">-->
<!--		<li>-->
<!--			<div class="container">-->
<!--				<div class="info">-->
<!--					<h2>It’s Time to <br><span>Get back to school</span></h2>-->
<!--					<a href="#">Check out our new programs</a>-->
<!--				</div>-->
<!--			</div>-->
<!--		</li>-->
<!--		<li>-->
<!--			<div class="container">-->
<!--				<div class="info">-->
<!--					<h2>It’s Time to <br><span>Get back to school</span></h2>-->
<!--					<a href="#">Check out our new programs</a>-->
<!--				</div>-->
<!--			</div>-->
<!--		</li>-->
<!--		<li>-->
<!--			<div class="container">-->
<!--				<div class="info">-->
<!--					<h2>It’s Time to <br><span>Get back to school</span></h2>-->
<!--					<a href="#">Check out our new programs</a>-->
<!--				</div>-->
<!--			</div>-->
<!--		</li>-->
<!--	</ul>-->
<!--	<div class="bg-bottom"></div>-->
<!--</div>-->

<section class="posts">
	<div class="container">
		<article>
			<!--			<div class="pic"><img width="121" src="images/2.png" alt=""></div>-->
			<div class="info" style="max-height: 335px;">
				<h3 style="margin-top: 0px;">History</h3>
				<?php
				$history="Udayan Higher Secondary School Dhaka, formerly known as Udayan Bidyalaya is a private higher secondary school in Bangladesh, established in 1955 by the University of Dhaka. It is a co-educational institution and currently one of the most reputed schools in Dhaka.

					The school was first allotted a small piece of land and two sheds. With the increase in the number of students it was upgraded to a secondary school and, after independence of Bangladesh, as a higher secondary one. In 1976, it received formal recognition from the Dhaka Board of Intermediate and Secondary Education.

					In 1980, it applied for a larger space and Dhaka University donated an area of 30,000 sq ft (2,800 m2) not far from its original location on Fuller Road. Construction of the new five-storied building was completed in 1987. Although established with donations from University of Dhaka, the school enjoys the status of a private organisation.

					The school conducts co-education programmes and in 1999, had 60 teachers (44 women), 14 other staff, and 2,030 students of whom 935 were girls. It is equipped with computer labs, science labs and library. It takes part in scout and girls guide activities and in serving distressed people in situations of flood or other natural calamity. The school boasts of a band group of its own and performs in sports, cultural shows, science fairs and debating competitions. In 1998, it introduced intermediate level programmes with courses in business studies and science, and was upgraded to a school cum college, and took its name as Udayan Higher Secondary School.";
				?>
				<p><?php echo($history); ?></p>
			</div>
			<?php
			if (str_word_count($history) > 50)
			{
				?>
				<br>
				<!-- Trigger the modal with a button -->
				<a class="more" href="#" data-toggle="modal" data-target="#history">Read more</a>

				<!-- Modal -->
				<div class="modal fade" id="history" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">History</h4>
							</div>
							<div class="modal-body">
								<p><?php echo($history); ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</article>
		<article>
			<!--			<div class="pic"><img width="121" src="images/3.png" alt=""></div>-->
			<div class="info" style="max-height: 335px;">
				<h3 style="margin-top: 0px;">Campus</h3>
				<?php
				$campus="Udayan is located at an alluring site in the Dhaka University Campus. It is situated right at the opposite of Salimullah Muslim Hall and the Dhaka office of British Council.

					Initially situated on the land next to the Vice Chancellor’s house, the school got its current building completed in 1987.

					The school has a bit small campus with an area of 30,000 square feet. There is a 6 storied building bearing an aesthetic red brick architecture.

					The administrative and the principal's offices are situated on the first floor while there are separate rooms for separate subject teachers e.g. all the math teachers share a specific math room which is located in the 6th floor. The labs for physics and biology and chemistry are all situated on the newly made 6th floor and the computer lab is situated on the 4th floor. The library is on the 3rd floor. There is a multimedia lab on the second floor especially to hold the public speaking classes.";
				?>
				<p><?php echo($campus); ?></p>
			</div>
			<?php
			if (str_word_count($campus) > 1000)
			{
				?>
				<br>
				<!-- Trigger the modal with a button -->
				<a class="more" href="#" data-toggle="modal" data-target="#campus">Read more</a>

				<!-- Modal -->
				<div class="modal fade" id="campus" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Campus</h4>
							</div>
							<div class="modal-body">
								<p><?php echo($campus); ?></p>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>
		</article>
	</div>
</section>

<?php
$statement = $db->prepare("SELECT * FROM notice ORDER BY idnotice DESC LIMIT 2;");
$statement->execute();
$news = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="news">
	<div class="container">
		<h2>Latest news</h2>
		<?php
		$i=0;
		foreach($news as $new)
		{
			$title=$new['title'];
			$date=$new['date'];
			$author=$new['author'];
			$description=$new['description'];

			?>
			<article>
				<div class="info" style="max-height: 238px;">
					<h4><?php echo($title); ?></h4>
					<p class="date"><?php echo($date.", ".$author); ?></p>

					<p><?php echo($description); ?></p>
				</div>
				<?php
				if (str_word_count($description) > 150)
				{
					?>
					<!-- Trigger the modal with a button -->
					<a class="more" href="#" data-toggle="modal" data-target="#news<?php echo($i); ?>">Read more</a>

					<!-- Modal -->
					<div class="modal fade" id="news<?php echo($i); ?>" role="dialog">
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
					<?php
				}
				?>
			</article>
			<?php
			$i++;
		}
		?>

		<div class="btn-holder">
			<a class="btn" href="all_news.php">See archival news</a>
		</div>
	</div>
</section>


<?php
$statement = $db->prepare("SELECT * FROM events ORDER BY idevents DESC LIMIT 4;");
$statement->execute();
$events = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<section class="events">
	<div class="container">
		<h2>Upcoming events</h2>
		<?php
		$j=0;
		foreach($events as $event)
		{
			$start_date = $event['start_date'];
			$event_description = $event['event_description'];
			$event_name = $event['event_name'];
			$event_place = $event['event_place'];

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

			<article>
				<div class="current-date">
					<p><?php echo($e_month); ?></p>

					<p class="date"><?php echo($e_date); ?></p>

					<p><?php echo($e_year); ?></p>
				</div>
				<div class="info" style="max-height: 210px;">
					<h3 style="font-weight: bold; color: #0e90d2; font-size: 15px; margin-top: 0px;"><?php echo($event_name); ?></h3>
					<h4 style="color: #899ec4; font-size: 13px;">
						Place: <?php echo($event_place); ?></h4>
					<p style="text-align: left;"><?php echo($event_description); ?></p>
				</div>
				<?php
				if (str_word_count($event_description) > 30)
				{
					?>
					<div style="padding-left: 100px;">
						<!-- Trigger the modal with a button -->
						<a class="more" href="#" data-toggle="modal" data-target="#events<?php echo($j); ?>">Read more</a>

						<!-- Modal -->
						<div class="modal fade" id="events<?php echo($j); ?>" role="dialog">
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
					</div>
					<?php
				}
				?>
			</article>
			<?php
			$j++;
		}
		?>
		<div class="btn-holder">
			<a class="btn blue" href="all_events.php">See all events</a>
		</div>
	</div>
</section>

<div class="container">
	<!-- Trigger the modal with a button -->
	<a class="info-request" data-toggle="modal" data-target="#contact">
			<span class="holder">
				<span class="title">Request information</span>
				<span class="text">Do you have some questions? Fill the form and get an answer!</span>
			</span>
		<span class="arrow"></span>
	</a>
</div>

<?php
require('footer.php');
?>




</body>
</html>