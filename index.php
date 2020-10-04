<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lifetrack Medical Systems</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="app/resources/styles.css" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha256-WqU1JavFxSAMcLP2WIOI+GB2zWmShMI82mTpLDcqFUg=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
</head>

<body>
	<div class="container">
        <div class="row border border-primary pt-4 pb-4 px-4 mb-2 mt-2">
        	<form method="post" id="costForm">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label class="col-form-label-sm font-weight-bold" for="studyPerDay">Current Number of study per day</label>
						<input type="text" class="form-control form-control-sm" name="studyPerDay" placeholder="Eg. 1000">
					</div>
					<div class="form-group col-md-4">
						<label class="col-form-label-sm font-weight-bold" for="growthPercentage">Number of Study Growth per month in %</label>
						<input type="text" class="form-control form-control-sm" name="growthPercentage" placeholder="Growth Percentage">
					</div>
					<div class="form-group col-md-4">
						<label class="col-form-label-sm font-weight-bold" for="numberOfMonthsToForecast">Number of months to forecast</label>
						<input type="text" class="form-control form-control-sm" name="numberOfMonthsToForecast" placeholder="Eg. 12">
					</div>
				</div>
				<button class="btn btn-primary mt-2 btn-sm" id="submit">Calculate Forecast</button>
			</form>
        </div>
        <div class="row">
        	<div class="text-center bg-primary">
                <h4 class="text-white"><strong>Results</strong></h2>
            </div>
            <div id="results">
            	
            </div>
        </div>
    </div>
	<script src="app/resources/ajax.js"></script>
</body>
</html>