<html>
<head>
	<title> Edit Sales </title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
	<style type="text/css">
		.table>tbody>tr>td {
			line-height: 2;
		}
		.title {
			text-transform: capitalize;
		}
	</style>
</head>
<body>
	
	<div class="row">
		<div class="col-md-4 col-md-offset-1 title"><h2> Sales &mdash; {{$sales->banner}} </h2></div>
		<div class="col-md-2">
			<h2 id="week">{{$sales->week}}</h2>
		</div>
		<div class="col-md-offset-9">
			<br>
			<a href="/" class="btn btn-default"> Back </a>
		</div>
	</div>
	<div class="row">
		<div id="table-container" class="col-md-10 col-md-offset-1">
			<form id="table-form">
			<meta name="csrf-token" content="{{ csrf_token() }}">

			<table id="data-table" class="table">
				<thead>
					<tr>
						<th>Day</th>
						<th>Actual</th>
						<th>Last Year</th>
						<th>Last Year %</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sales->details as $detail) 
						<tr>
						<td>{{ $detail->day }}</td>
						<td>{{ $detail->data->thisyear }}</td>
						<td>{{ $detail->data->lastyear }}</td>
						<td class="percentage"> {{$detail->data->percentage}} </td>
						</tr>
					@endforeach
				</tbody>
			</table>
			<table id="totals-table" class="table">
				<thead>
					<tr>
						<th></th>
						<th>Week Total</th>
						<th>Total Percentage</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td></td>
						<td id="weekTotal">{{$sales->weekTotal}}</td>
						<td id="totalPercentage">{{$sales->totalPercentage}}</td>
					</tr>
				</tbody>
			</table>
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-2 col-md-offset-10">
			<button id="saveUpdates" class="btn btn-default" type="submit">Save</button>
		</div>
	</div>
	</form>
	
	
	<script type="text/javascript" src="/js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="/js/jquery.tabledit.min.js"></script>

	<script type="text/javascript">
	
	var initiateTableEdit = function(){

		$('#data-table').Tabledit({
			editButton: false,
	        deleteButton: false,	
	        restoreButton:false,
	        saveButton:false,
			columns: {	
						
						identifier: [0, 'day[]'],                   
	 					editable: [[1, 'current_year[]'], [2, 'last_year[]']]
	 				}
	 	});

	 	$("#totals-table").Tabledit({
	 		editButton: false,
	        deleteButton: false,	
	        restoreButton:false,
	        saveButton:false,
			columns: {	                   
						identifier: [0, 'index'],
	 					editable: [[1, 'weekTotal'], [2, 'totalPercentage']]
	 				}
	 	})
	}

	

 	var buildJSON = function() {
 		var json = {};

 		json["banner"] = "<?php echo $sales->banner; ?>"
 		if ($('input[name="week"]').length) {
 			json["week"]   = $('input[name="week"]').val();
 		}
 		else{
 			json["week"] = $("#week").text();
 		}
 		json["weekTotal"] = $("input[name='weekTotal']").val();
 		json["totalPercentage"] = $("input[name='totalPercentage']").val();

 		json["details"] = {};

 		$("#data-table tbody tr").each(function(i) {


 			var day_val = $(this).find('input[name^="day"]').val();
 			var current_year_val = $(this).find('input[name^="current_year"]').val();
 			var last_year_val = $(this).find('input[name^="last_year"]').val();
 			
 			var diff = parseInt(current_year_val - last_year_val);
 			var percentage = 100 + (diff/last_year_val)*100;
 			var percentage_val = Math.round(percentage*100)/100;
 			
 			var dataByDay = {};
 			dataByDay["day"] =  day_val;

			var data =  {};
			data["lastyear"] = last_year_val;
			data["thisyear"] = current_year_val;
			data["percentage"] = percentage_val;

			dataByDay["data"] = data;

			json["details"][""+i+""] = dataByDay;
 			
	 		
 		});
 		console.log(JSON.stringify(json));
 		return JSON.stringify(json);
 	}

 	var saveChanges = function(){

 		var jsonfile = buildJSON();
 		
 		var url = "/sales/save";
 		var token = $('meta[name="csrf-token"]').attr('content');
 		
		$.ajaxSetup({
		        headers: {
		            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		            'allow' : "*"
		        }
		});

		$.ajax({
		  type: "POST",
		  url: url,
		  data: {"file" :jsonfile},
		  
		}).done(function( data ) {
		 });
 	}

 	$("body").on("change", "input", function(){

 		saveChanges();
		 		
 	})

 	$("#week").on("click", function(){

		var week = "<?php echo $sales->week; ?>"
	    $(this).html('');
	    $('<input></input>')
	        .attr({
	            'type': 'text',
	            'name': 'week',
	            'id': 'week',
	            'value': week
	        })
	        .appendTo('#week');
	    $('#week').focus();
	})

	$("document").ready(function () {
 		initiateTableEdit();

 	});


	</script>	
</body>
</html>