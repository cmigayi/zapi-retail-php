<!doctype html>
<html lang="en">
	<head>
		<title></title>
		<meta charset="utf-8">
  		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

		<link rel="stylesheet" type="text/css" href="webui/css/style.css">

		<!-- jQuery library -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

		<!-- Popper JS -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

		<!-- Latest compiled JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 		
	</head>
	<body>
		<div class="container">

			<header>
				<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
				  <a class="navbar-brand" href="#">Zapi</a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
				    <span class="navbar-toggler-icon"></span>
				  </button> 
				</nav>
			</header>

			<div class="content">
				<div class="login">	
					<h2>Login to Zapi</h2>
					<form action="/action_page.php" class="was-validated">
					    <div class="form-group">
					      <label for="uname">Username:</label>
					      <input type="text" class="form-control" id="uname" placeholder="Enter username" name="uname" required>
					      <div class="valid-feedback">Valid.</div>
					      <div class="invalid-feedback">Please fill out this field.</div>
					    </div>
					    <div class="form-group">
					      <label for="pwd">Password:</label>
					      <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
					      <div class="valid-feedback">Valid.</div>
					      <div class="invalid-feedback">Please fill out this field.</div>
					    </div>
					    <button type="submit" class="btn btn-primary">Submit</button>
					</form> 
				</div>	
			</div>			

		</div>
	</body>
</html>