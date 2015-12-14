<?php
include($_SERVER['DOCUMENT_ROOT']."/php/courseHeader.php");
$lectnr = 1;
?>
<!DOCTYPE HTML>
<html>
    <head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="/js/createVideo.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="/css/master.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="/css/startmenu.css">
		<script src="/js/startmenu.js"></script>
		<script src="/js/exitCourse.js"></script>
        <?php echo "<title>$course_name</title>" ?>
    </head>
    <body>
		<div class="wrapper" align="center">
		<?php include($_SERVER['DOCUMENT_ROOT']."/php/navigator.php"); ?>
		<?php echo "<h1>Course $course_name</h1>";
		echo "Welcome ". $_SESSION['username'];
		if($teacher == 1) {
			echo "<br><p>You are the teacher for this course </p>";
		}
		else {
			echo "<br><p>You are a student in this course </p>";
		}
		$result = db_query("SELECT * FROM videos WHERE course_id = $course_id");
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo "<b>Lecture " . $lectnr." - </b><a href='./lecture.php?user=".$user_id."&course=".$course_id."&lecture_id=".$row['id']."'>".$row['title']."</a><br>";
			$lectnr++;
		}
		$lectnr = 0;
		?>
		</br>
		<form id="exitCourse_form" data-user="<?php echo $_SESSION['user_id'] ?>" data-course="<?php echo $_GET['course'] ?>" data-teacher="<?php echo $teacher ?>">
			<input type="submit" value="Exit course">
		</form>
		<div id="exitCourse_error">
		</div>
		<?php if($teacher == 1): ?>
			<div class="content">
			<form action="editCourse.php?user=<?php echo $user_id; ?>&course=<?php echo $course_id; ?>" method="POST">
			<input type="submit" name="create_course_submit" value="Edit or close course"/>
			</form>
			<form action="addVideo.php" method="POST">
			<input type="submit" name="addVid" value="Add lecture"/>
			</form>
			
			</div>
		
			</div>
		<?php endif; ?>

		</div>
    </body>
</html>