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
		<div class="col-md-4 col-md-offset-1 title"><h2> Pie Chart &mdash; {{$pie->banner}} </h2></div>
		<div class="col-md-2">
			<h2 id="week">{{$pie->week}}</h2>
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

			<table id="data-table" class="table table">
				<thead>
					<tr>
						<th>Category</th>
						<th>Value</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					
					@foreach($pie->details as $detail) 
						
						<tr>
						<td>{{ $detail->category }}</td>
						<td>{{ $detail->value }}</td>
						<td> <button type="button" class="btn btn-xs btn-danger removeCategory">
  								&mdash;
							</button>
						</td>
						</tr>

					@endforeach
				</tbody>
				
			</table>					
			
		</div>
	</div>
	<div class="row">
		<div class="col-md-offset-9">
			<span><button id="addCategory" class="btn btn-default"> Add more Categories  </button></span>
			<span><button id="saveUpdates" class="btn btn-default" type="submit">Save</button></span>
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
						identifier: [0, 'category[]'],
						editable: [[0, 'category[]'],[1, 'percentage[]']]
	 				}
 		});	
	}
	

	$("#addCategory").on("click", function (e) {
		e.preventDefault();
		console.log("add more");
		$("#data-table tbody").append("<tr><td>Edit this..</td><td>Edit this..</td></tr>");
		initiateTableEdit();
		$('input[name="category[]"]:last').click();

	});

	$(".removeCategory").on("click", function (e) {
		e.preventDefault();
		console.log("remove row");
		$(this).closest('tr').remove();
		saveChanges();

	});

	$("#week").on("click", function(){

		var week = "<?php echo $pie->week; ?>"
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
	});

 	var buildJSON = function() {

 		var json = {};

 		json["banner"] = "<?php echo $pie->banner; ?>"
 		if ($('input[name="week"]').length) {
 			json["week"]   = $('input[name="week"]').val();
 			console.log("1");
 			
 		}
 		else{
 			json["week"] = $("#week").text();
 			console.log("2");
 		}
 		console.log(json["week"]);

 		json["details"] = {};

 		$("tbody tr").each(function(i) {


 			var category_val = $(this).find('input[name^="category"]').val();
 			var percentage_val = $(this).find('input[name^="percentage"]').val();
 			
 			var dataByCategory = {};
 			dataByCategory["category"] =  category_val;
 			dataByCategory["value"] = percentage_val;

			json["details"][""+i+""] = dataByCategory;
 			
	 		
 		});
 		
 		return JSON.stringify(json);
 	}

 	var saveChanges  = function() {
 		
 		var jsonfile = buildJSON();
 		console.log(jsonfile);
 		var url = "/pie/save";
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
		  
		})
	} 

 	$("body").on("change", "input", function(){

 			saveChanges();
		 		
 	})
 	
 	$("document").ready(function () {
 		initiateTableEdit();

 	});

	</script>	
</body>
</html>