<?php
	$session = session();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schulplanung</title>
    <!-- base_url() = localhost/-->
    <link rel="stylesheet" href="<?php echo base_url('ci4/public/assets/css/style.css');?>">
   
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <main>
        <h1>Schulplanung</h1>
		<form action="process_login" method="post">
			<div class="form_all">
				<div>
					<h2>Login</h2>
					<!-- ------------------------------------ Alerts             -->
					<?php
						if ($session->login_unsuccessful == true) {
						?>
							<div id="login_unsuccessful" class="alert_unsuccessful alert alert-danger" >
							Benutzername oder Passwort ist falsch.
							</div>
						<?php
						$session->login_unsuccessful = false;
						}
					?>
					<label for="">Benutzername: </label>
					<input type="text" name="user_name" placeholder="Geben Sie Ihren Benutzername ein">
				</div>
				<div>
					<label for="">Passwort: </label>
					<input type="password" name="pass" placeholder="Geben Sie Ihr Passwort ein">
				</div>
				<div>
					<button class="btn btn-primary btn-margin-top" type="submit">Login</button>
				</div>
				<div class="">
					<a class="float-start" href="<?php echo base_url('/ci4/public/register'); ?>" >Haben Sie noch kein Konto? Hier registrieren</a>
				</div>
				<div class="clearfix"></div>
			</div>
    	</form>
    </main>
	<!--<script src="index.js"></script>-->
  </body>
</html>