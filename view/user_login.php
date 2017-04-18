<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= $title ?> | Bbc MVC</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
		<form class="form-horizontal" action="/user/doLogin" method="post">
			<div class="component" data-html="true">
				<div class="form-group">
		  	<div class="col-md-4">
		  		<input id="username" name="username" type="text" placeholder="Username" class="form-control input-md">
		  	</div>
			</div>
			<div class="form-group">
		  	<div class="col-md-4">
		  		<input id="password" name="password" type="password" placeholder="Password" class="form-control input-md">
		  	</div>
			</div>
			<div class="form-group">
	      	<label class="col-md-2 control-label" for="send">&nbsp;</label>
		  	<div class="col-md-4">
		    	<input id="send" name="send" type="submit" class="btn btn-primary">
		  	</div>
			</div>
		</div>
	</form>

	    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	  </body>
	</html>
