<html>
	<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
	</head>
	<body>
	<div class="container">
	<h1>Welcome Template SMS</h1>
		<form method="post" action='phpsendbulksmstemp.php'>
		<div class="form-group">
			<label for="phoneno">Mobile Number</label>
			<input type="text" name="phoneno" class="form-control" placeholder="Enter Phone Number" >
		</div>
		<div class="form-group">
			<label for="patient">Patient Name (RCHID)</label>
			<input type="text" name="patient" class="form-control" placeholder="Enter Name with RCHID" >
		</div>
		<div class="form-group">
			<input type="submit" name="submit" class="btn btn-primary" value="Send Message">
		</div>
		</form>
	</div>	
	</body>
</html>
