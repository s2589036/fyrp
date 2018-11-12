<?php
// By Christian Roest 2018
	// List
	$subject_number 	= $_GET['subject_number'];
	$list 				= $_GET['list'];
	$question_number	= $_GET['question_number'];
	$list_length		= getLengthQuiz($list);
	$list_title			= getListTitle($list);
	$list_description	= getListDescription($list);
	$question			= actualQuestion($list, $subject_number, $question_number);
	
	if($question_number > 0) {
		storeAnswer($list, $subject_number, (intval($question_number) - 1), $_GET['answer']);
	}else if($question_number == 0) {
		$gender 			= $_GET['gender'];
		$age_year 			= $_GET['age_year'];
		//$age_extra_months   = $_GET['age_extra_months'];
		storeParticipant($list, $subject_number, $gender, $age_year);//, $age_extra_months);
	}
	
	// Question
?>

<div class="row">
	<div class="col-md-12" align="center">
		<!--<h1><?php echo $list_title ?></h1>-->
		<!--<h4> <?php echo $list_description; ?> </h4>-->
		<p>
			<?php echo "Question " . ($question_number +1 )." of $list_length"; ?>
		</p>
		<form action="index3.php" method="get">
			<?php
				showImage($list, $question['image']);
				showQuestion($question['text']);
				showAnswerButtons($list, $question['options']);
				makeHiddenFields();
			?>
		</form>
		
	</div>
</div>