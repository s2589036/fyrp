<!-- Made by Christian Roest 2018 -->

<!-- Include Bootstrap -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="bootstrap/js/bootstrap.min.js"></script>

<html>
	<div class="container"> 
		<?php
			include('functions/functions.php');
			// er is een lijst gekozen
			
			if( isset( $_GET['list'] ) ){
				
				// check of we al bij de laatste vraag zijn
				if(intval($_GET['question_number']) >= getLengthQuiz($_GET['list'])){
					include ('pages/success.php');
				} else {				
				include('pages/question.php');
				}
			}else{
				
				include('pages/start.php');
			}
		?>
	</div>
</html>