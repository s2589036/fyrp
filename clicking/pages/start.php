<?php
	// By Christian Roest 2018
	
	// TODO: GET LIST FROM GLOBAL VAR
	
	$lists[0]['name'] = "Pre-test";
	$lists[0]['path'] = "pretest";
	$lists[1]['name'] = "Post-test";
	$lists[1]['path'] = "posttest";

	//include("functions/functions.php")
	?>

<form action="index3.php" method="get">
	
	<div class="row">
		<div class="col-md-6 mb-3">
			<h2>Personal details</h2>
			<!--kan ik hier uitleg typen?-->
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6 mb-3">
			<label for="subject_number">Amazon mechanical turk ID</label>
			<input class="form-control" id="subject_number" name="subject_number" placeholder="" value="" required="" type="text">
		</div>
	</div>
	
	<div class="row">
		<div class="col-md-6 mb-3">
			<p class="mb-3">Gender</p>
			<div class="d-block my-3">
		  <div class="custom-control custom-radio">
			<input id="male" name="gender" value="male" class="custom-control-input" checked="" required="" type="radio">
			<label class="custom-control-label" for="male">Male</label>
		  </div>
		  <div class="custom-control custom-radio">
			<input id="female" name="gender" value="female" class="custom-control-input" required="" type="radio">
			<label class="custom-control-label" for="female">Female</label>
		  </div>
		</div>
	  </div>
	</div>
	<!--
	<div class="row">
		<div class="col-md-6 mb-3">
			<p class="mb-3">Block</p>
			<div class="d-block my-3">
		  <div class="custom-control custom-radio">
			<input id="1" name="block" value="1" class="custom-control-input" checked="" required="" type="radio">
			<label class="custom-control-label" for="1">1</label>
		  </div>
		  <div class="custom-control custom-radio">
			<input id="2" name="block" value="2" class="custom-control-input" required="" type="radio">
			<label class="custom-control-label" for="2">2</label>
		  </div>
		</div>
	  </div>
	</div>  
	-->
	
	<?php $blocknr = rand(1,2); ?>
	<input type="hidden" name="block" id="block" value=<?php echo $blocknr; ?>>
	<input type="hidden" name="list" id="list" value=<?php echo getQuestionList($blocknr); ?>>
	
	<div class="row">
		<div class="col-md-3 mb-3">
			<label for="age_year">Age</label>
			<input class="form-control" name="age_year" id="age_year" placeholder="" value="" required="" type="text">
		</div>
		<!--
		<div class="col-md-3 mb-3">
			<label for="age_year">Extra months</label>
			<input class="form-control" name="age_extra_months" id="age_extra_months" placeholder="" value="0" required="" type="text">
		</div>
		-->
	</div>
	
	<div class="row">
		<div class="col-md-6 mb-3">
			<hr class="mb-4">
			<button class="btn btn-primary btn-lg btn-block" type="submit">Next</button>
		</div>
	</div>
	
	<input type="hidden" name="question_number" value="0" />
</form>