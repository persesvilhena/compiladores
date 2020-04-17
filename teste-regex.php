<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Php eh foda</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link href="https://getbootstrap.com/docs/3.3/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <nav>
          <ul class="nav nav-pills pull-right">
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">About</a></li>
            <li role="presentation"><a href="#">Contact</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">CPF Finder</h3>
      </div>

      <div class="jumbotron">
        <h1>Encontre o CPF:</h1>
        <form action="" method="post">
        	<textarea name="texto" class="form-control" rows="10"></textarea>
        	<br>
        	<div align="right">
        		<input type="submit" name="enviar" value="Submeter" class="btn btn-default">
        	</div>
        </form>
      </div>

      <div class="row marketing">
      		<?php
      		$texto = $_POST['texto'];
			preg_match_all("/([0-9]{3})(.)?([0-9]{3})(.)?([0-9]{3})(-)([0-9]{2})/", $texto, $matches);
			$result = $matches[0];

			/*echo "<pre>";
			var_dump($matches[0]);
			echo "</pre>";*/
			?>
      </div>
      <ul class="list-group">
      <?php

      foreach ($result as $n) {
      	echo "<li class=\"list-group-item\">$n</li>";
      }
      ?>
  	  </ul>

      <footer class="footer">
        <p>&copy; 2016 Company, Inc.</p>
      </footer>

    </div> <!-- /container -->



  </body>
</html>

