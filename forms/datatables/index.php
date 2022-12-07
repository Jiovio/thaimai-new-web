<html>
<head>
<title>Datatables</title>
	<link rel="stylesheet"  href="dataTables.min.css">	
	<link rel="stylesheet"  href="style.css">	
	<script src="jquery-3.4.1.min.js" type="text/javascript"></script>
    <script src="dataTables.min.js" type="text/javascript"></script> 	
	<style>
	body {font-family: calibri;color:#4e7480;}
	</style>
</head>
<body>
<div class="container">
	<table id="users-detail" class="display nowrap" cellspacing="0" width="100%">
	<thead>
		<tr>
		<th>Name</th>
		<th>Email</th>
		<th>UserName</th>
		<th>Mobile</th>
		<th>UserType</th>
		<th>Status</th>
		<th>Last Login</th>
		</tr>
	</thead>
	</table>
</div>
</body>
<script>
$(document).ready(function() {
    $('#users-detail').dataTable({
		"scrollX": true,
		"pagingType": "numbers",
        "processing": true,
        "serverSide": true,
        "ajax": "usersModel.php"
    } );
} );
</script>
</html>