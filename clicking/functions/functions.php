<?php
	function getNumberBlock1 (){
		$myfile = fopen("lists/number1.txt", "r") or die("Unable to open file!");
		$number = fgets($myfile);
		fclose($myfile);
		
		return $number;
	}

	function changeNumberBlock1 (){
		$myfile = fopen("lists/number1.txt", "r") or die("Unable to open file!");
		
		$number = getNumberBlock1();
		if($number < 15){
			$number = $number + 1;
		}
		else{
			$number = 0;
		}
		
		file_put_contents("lists/number1.txt", $number);
		#writetofile
	}
	
	function getNumberBlock2 (){
		$myfile = fopen("lists/number2.txt", "r") or die("Unable to open file!");
		$number = fgets($myfile);
		fclose($myfile);
		
		return $number;
	}

	function changeNumberBlock2 (){
		$myfile = fopen("lists/number2.txt", "r") or die("Unable to open file!");
		
		$number = getNumberBlock2();
		if($number < 15){
			$number = $number + 1;
		}
		else{
			$number = 0;
		}
		
		file_put_contents("lists/number2.txt", $number);
		#writetofile
	}
	
	// Randomization function for arrays
	function fisherYatesShuffle(&$items, $seed)
	{
		@mt_srand($seed);
		for ($i = count($items) - 1; $i > 0; $i--)
		{
			$j = @mt_rand(0, $i);
			$tmp = $items[$i];
			$items[$i] = $items[$j];
			$items[$j] = $tmp;
		}
	}
	
	// Lists
	// return length of a list
	function getListName ($path) {
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		return $xml->title;
	}
	
	function getListLength ($path) {
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		$count = 0;
		foreach($xml->questiontype as $type){
			$count += count($type->question);
		}
		return $count;
	}
	
	function getLengthQuiz ($path) {
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		$count = 0;
		foreach($xml->questiontype as $type){
			$count += intval($type->amountAsked);
		}
		return $count;
	}
	
	function getAmountOfTypes ($path) {
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		return count($xml->questiontype);
	}
	
	function getTypeById ($path, $id) {
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		return $xml->questiontype[intval($id)]->name;
	}
	
	function getAmountByType ($path, $id) {
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		return $xml->questiontype[intval($id)]->amountAsked;
	}
	
	function allQuestionsOfType ($path, $id){
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		return $xml->questiontype[intval($id)]->question;
	}
	
	function amountOfQuestionsInList ($path, $id) {
		return count(allQuestionsOfType ($path, $id));
	}
	
	function getListTitle ($path) {
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		return $xml->title;
	}
	
	function getListDescription ($path) {
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		return $xml->description;
	}
	
	// BACKEND FUNCTIONS
	// Unrandomized functions for getting questions from list
	
	// Question text
	function listQuestionText ($path, $type, $questionNumber) {
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		return ($xml->questiontype[$type]->question[intval ($questionNumber) ]->text);
	}
	
	// Question image
	function listQuestionImage ($path, $type, $questionNumber) {
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		return ($xml->questiontype[$type]->question[intval ($questionNumber) ]->image);
	}
	
	// Question audio
	function listQuestionAudio ($path, $type, $questionNumber) {
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		return ($xml->questiontype[$type]->question[intval ($questionNumber) ]->audio);
	}
	
	function listQuestionOptions ($path, $type, $questionNumber) {
		$xml=simplexml_load_file("lists/". $path . "/questions.xml") or die("Error: Cannot create object");
		return ($xml->questiontype[$type]->question[intval ($questionNumber) ]->options);
	}
	
	// get randomized list sequence based on participant id
	function getListSequence($participantId, $list) {
		$quizlength = getLengthQuiz($list);
		$types = getAmountOfTypes($list);
		$practiceList = [];
		$questionlist = [];
		
		$qNumber = 0;
		
		// FIND PRACTICE QUESTIONS AND ADD THEM FIRST
		for ($t = 0; $t < $types; $t++){
			if(getTypeById($list, $t) == 'practice'){
				$amountOfQuestiontype = getAmountByType($list, $t);
				$randomOrder = range(0, intval(amountOfQuestionsInList($list, $t) - 1));
				for ($i = 0; $i < $amountOfQuestiontype; $i++){
					$practiceList[$qNumber]['type'] = $t;
					$practiceList[$qNumber]['id'] = $randomOrder[$i];
					$qNumber++;
				}
			}
		}
		
		$qNumber = 0;
		for ($t = 0; $t < $types; $t++){
			if(getTypeById($list, $t) == 'practice'){
				continue; // skip practice questions, we add them at the beginning
			}
			// generate random per type list
			$amountOfQuestiontype = getAmountByType($list, $t);
			$randomOrder = range(0, intval(amountOfQuestionsInList($list, $t) - 1));
			fisherYatesShuffle($randomOrder, $participantId);
			for ($i = 0; $i < $amountOfQuestiontype; $i++){
				$questionlist[$qNumber]['type'] = $t;
				$questionlist[$qNumber]['id']	 = $randomOrder[$i];
				$qNumber++;
			}
		}
		
		fisherYatesShuffle($questionlist, $participantId);
		$questionlist = array_merge($practiceList, $questionlist);
		return $questionlist;
	}
	
	//ADDED
	function randomizename($name){
		$name = $name;
		return $name;
	}
	
	function actualQuestion ($list, $participantId, $number) {
		$sequence = getListSequence($participantId, $list);
		$type 	  = $sequence[$number]['type'];
		$q		  = $sequence[$number]['id'];
		
		$question = [];
		
		//IF I ADD RANDOMIZESTUFF HERE, IT WILL CHANGE FOR EACH NEW QUESTION! I DON'T KNOW WHERE I SHOULD CHANGE IT
		$question['text']  = randomizename(listQuestionText ($list, $type, $q));
		$question['image'] = listQuestionImage($list, $type, $q);
		$question['audio'] = listQuestionAudio($list, $type, $q);
		$question['options']=listQuestionOptions($list, $type, $q);
		$question['type']  = $type;
		$question['id']	   = $q; // within type
		
		return $question;
	}
	
	// HTML output
	function showImage($path, $image) {
	?>
	<div class="row">
		<div class="col-md-3" ></div>
		<div class="col-md-6" align="center">
		<?php 
		if($image != "")
			//echo "<img src='lists/". $path . "/images/". $image . "' width='100%' >";
			echo "<img src='/images".$image."' width='100%' >";
		else
			echo "";
		?>
		</div>
	</div>
	<?php
	}
	
	function showQuestion($text){
		?>
		<div class="row">
			<div class="col-md-12" align="center">
				<h1>
					
					<?php 
					$vowels = array("a","e","o","u","i");
						if(in_array(substr($text,0,1),$vowels)){
						echo "Oh look, there is an $text over there!!"; }
						else{echo "Oh look, there is a $text over there!!";}
						?>
					
				</h1>
				<br />
			</div>
		</div>
		<?php
	}
	
	function showAnswerButtons($list, $options){
		?><div class="row"><?php
		
		foreach($options->option as $option){
			?><div class="col-md-3 mb-3"><?php
			if(!isset ($option->image) || $option->image == ""){
				
				?>
				<button class="btn btn-primary btn-lg btn-block" name='answer' type="submit" value="<?php echo $option->value; ?>"><?php echo $option->text; ?></button>
				<?php
			}else{
				?>
				<button class="btn btn-default" name='answer' type="submit" value="<?php echo $option->value; ?>">
					<img src='images/<?php echo $option->image;?>' width='90%' >
				</button>
				<?php
			}
		
		?></div><?php
		}
		?>
		</div>
		<?php
	}
	
	function makeHiddenFields(){
		echo "<input type='hidden' name='subject_number' value='" . $_GET['subject_number'] . "'>\n";
		echo "<input type='hidden' name='gender' value='" . $_GET['gender'] . "'>\n";
		echo "<input type='hidden' name='list' value='" . $_GET['list'] . "'>\n";
		echo "<input type='hidden' name='block' value='" . $_GET['block'] . "'>\n";
		echo "<input type='hidden' name='age_year' value='" . $_GET['age_year'] . "'>\n";
		//echo "<input type='hidden' name='age_extra_months' value='" . $_GET['age_extra_months'] . "'>\n";
		echo "<input type='hidden' name='question_number' value='" . (intval($_GET['question_number']) + 1) . "'>";
	}
	
	// FILE WRITING
	
	function writeToSubjectFile($list, $participant, $line) {
		$date = date("Y-m-d");
			
		if(!is_dir("output/". $list)){
			mkdir("output/".$list);
		}
		if(!is_dir("output/$list/$date")){
			mkdir("output/$list/$date");
		}
		$file = fopen("output/$list/$date/$participant.txt", "a+") or die("Unable to open file!");
		fwrite($file, $line);
		fclose($file);
	}
	
	function storeAnswer($list, $participant, $questionnumber, $answer){
		$question = actualQuestion($list, $participant, $questionnumber);
		//$time = date("H:i:s:v");
		
		//toegevoegd:
		
		$time = date("H:i:s");
		$microtime = microtime(true);
		
			
		$line = "Time: $time, Seconds: $microtime, Type: ". getTypeById($list, $question['type']) .", Question: ".$question['text']."-".$question['id'].", Answer: $answer". PHP_EOL;
		writeToSubjectFile($list, $participant, $line);
	}
	
	function storeParticipant($list, $subject_number, $gender, $age_year){
		$date = date("Y-m-d H:i:s");
		writeToSubjectFile($list, $subject_number, "Gender: $gender, Age: $age_year". PHP_EOL . "Begin_test: $date" . PHP_EOL);
	}

	function getQuestionList ($block){
		if($block == 1){$number = getNumberBlock1();
						$lists = array("questions-block1-v1", "questions-block1-v2","questions-block1-v3","questions-block1-v4","questions-block1-v5","questions-block1-v6",
							"questions-block1-v7", "questions-block1-v8","questions-block1-v9", "questions-block1-v10","questions-block1-v11", "questions-block1-v12",
							"questions-block1-v13", "questions-block1-v14","questions-block1-v15", "questions-block1-v16");
		}
		
		if($block == 2){$number = getNumberBlock2();
						$lists = array("questions-block2-v1", "questions-block2-v2","questions-block2-v3","questions-block2-v4","questions-block2-v5","questions-block2-v6",
							"questions-block2-v7", "questions-block2-v8","questions-block2-v9", "questions-block2-v10","questions-block2-v11", "questions-block2-v12",
							"questions-block2-v13", "questions-block2-v14","questions-block2-v15", "questions-block2-v16");
		}
		return $lists[$number];
	}	
	
	
//	echo getNumber();
	//echo getQuestionList();
	//changeNumber();
	//echo getNumber();
	
	
	?>
	
	
