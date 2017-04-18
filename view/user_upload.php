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
		<form class="center-form" action="/user/doUpload" method="post">
      <div>
      <!--TODO LOGO -->
			<div>
        <input id="" class="input-form" name="file" type="file" >
		  	<input id="" class="input-form" name="name" type="text" placeholder="name">
			</div>
      <div>
				<label class="label-help">?</label><br>
				<input id="" class="input-form" name="tags" type="text" placeholder="tags">
			</div>
      <div>
				<label class="label-help">?</label><br>
				<input id="" class="input-form" name="acces" type="text" placeholder="acces">
			</div>
      <div class="submit-form-div">
				<input id="" class="submit-form" name="Submit" type="submit" value="upload">
			</div>
      </div>
  	   <a href="/user/create" class="form-switch">Create an account</a>
	</form>

	    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	  </body>
	</html>
