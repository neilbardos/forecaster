$(document).ready(function () {	
    $("#costForm").validate({
		rules: {
			studyPerDay : {
				required: true,
				number: true,
				min: 1
			},
			growthPercentage: {
				required: true,
				number: true,
				min: 1
			},
			numberOfMonthsToForecast: {
				required: true,
				number: true,
				min: 1
			},
		},
		submitHandler: function(form) {
			$("#results").empty();
			studyPerDay = $("#costForm input[name='studyPerDay']" ).val(),
			growthPercentage = $("#costForm input[name='growthPercentage']" ).val(),
			numberOfMonthsToForecast = $("#costForm input[name='numberOfMonthsToForecast']" ).val(),
			
			url = "api/calculate.php";
			// Send the data using post
			var posting = $.post( url, { 
				studyPerDay: studyPerDay, 
				growthPercentag: growthPercentage, 
				numberOfMonthsToForecast: numberOfMonthsToForecast, 
			} );

			posting.done(function( response ) {
				console.log(response)
				//render results in tables
				$.each( response, function( key, value ) {
				  value['numberOfStudies'] = value['numberOfStudies'].toLocaleString(undefined)
				  value['totalCost'] = value['totalCost'].toLocaleString(undefined)


				  $("#results").append('<table class="table border-primary table-bordered table-hover results-table "><tbody><tr><th scope="row">Month Year</th><td> '+value['monthYear']+'</td></tr><tr><th scope="row">Number of Studies</th><td> '+value['numberOfStudies']+'</td></tr><tr><th scope="row">Cost Forecasted </th><td> $'+value['totalCost']+'</td></tr></tbody></table>');
				});
			}).fail(function(response) {
		    	$("#results").append('<table class="table table-bordered "><tbody><tr><th scope="row">Fetching Results Failed!</th>/tr></tbody></table>');
			})
	    }
	});
});