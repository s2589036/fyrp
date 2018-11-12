<?php
	include_once('functions/functions.php');
	
	$subject_number 	= $_GET['subject_number'];
	$block 				= $_GET['block']; 
	$list 				= $_GET['list'];
	$question_number	= $_GET['question_number'];
	$gender 			= $_GET['gender'];
	$age_year 			= $_GET['age_year'];
	//$age_extra_months   = $_GET['age_extra_months'];
	$list_length		= getLengthQuiz($list);
	$list_title			= getListTitle($list);
	$list_description	= getListDescription($list);
	
	if($question_number > 0) {
		storeAnswer($list, $subject_number, (intval($question_number) - 1), $_GET['answer']);
	}
?>

<h1> Thank you for participating. 
</br>
<?php
$random_number = rand(00000,99999);
echo "Your random code: ".$random_number;


file_put_contents("output/numbers.txt", $random_number.PHP_EOL,FILE_APPEND);




?>

</h1> <!--ALS IEDERE PERSOON MAAR 1 BLOCK DOET, DIT WEGHALEN -->

<?php
	if($block=="1"){changeNumberBlock1();}	//DO NOT REMOVE
	if($block=="2"){changeNumberBlock2();}	//DO NOT REMOVE

	
/*
	if($block == 1){
		//DEZE LINK NOG GOED AANPASSEN, DAN ALLES TESTEN!!!
		?>
		
		Please return to the <a href="index.php"> main page </a> to continue with block 2.
		
<?php
	}
	if($block == 2){
		echo "Thank you for participating in this experiment. You are ready, now!";
	}
	?>
	<!--  //'index.php?zsubject_number=rrr&gender=male&block=2&age_year=11&age_extra_months=0&question_number=0' -->

	
	


<!--  //'index.php?zsubject_number=rrr&gender=male&block=2&age_year=11&age_extra_months=0&question_number=0' -->

*/
?>
