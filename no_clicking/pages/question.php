<head>
</head>

<?php
// By Christian Roest 2018
	// List
	$subject_number 	= $_GET['subject_number'];
	$list 				= $_GET['list'];
	$block 				= $_GET['block'];
	$question_number	= $_GET['question_number'];
	$list_length		= getLengthQuiz($list);
	$list_title			= getListTitle($list);
	$list_description	= getListDescription($list);
	$question			= actualQuestion($list, $subject_number, $question_number);
	

	
	if($question_number > 0) {
		if(isset($_GET['answer'])){
			storeAnswer($list, $subject_number, (intval($question_number) - 1), $_GET['answer']);
		}else {storeAnswer($list, $subject_number, (intval($question_number) - 1), "-");}
		
			
	}else if($question_number == 0) {
		$gender = $_GET['gender'];
		$block = $_GET['block'];
		$age_year = $_GET['age_year'];
		//$age_extra_months   = $_GET['age_extra_months'];
		storeParticipant($list, $subject_number, $gender, $age_year);//, $age_extra_months);
		//$question_number++;
	}
	
	function changePage($subject_number,$list,$question_number) {
			$gender = $_GET['gender'];
			$age_year = $_GET['age_year'];
			$block = $_GET['block'];
			
			//DIT VERBETEREN
			$url = "index3.php?subject_number=".$subject_number."&gender=".$gender."&block=".$block."&list=".$list."&age_year=".$age_year."&question_number=".$question_number
			?>
			<meta http-equiv="refresh" content="3; url=<?php echo $url; ?>" />
			
	<?php };
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
				if($question_number%4 == 3) {showAnswerButtons($list, $question['options']);
				}else{showAnswerPictures($list, $question['options']);
				$question_number++;
				changePage($subject_number,$list,$question_number);
				};
				makeHiddenFields();
				
			?>
		</form>
		
	</div>
</div>