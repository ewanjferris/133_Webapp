<?php $session = session();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Schulplanung</title>
    <link rel="stylesheet" href="<?php echo base_url('ci4/public/assets/css/style.css');?>">
	
    <link rel="icon" href="./favicon.ico" type="image/x-icon">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<!--<div class="alert alert-success">
		<?php ?>
	</div>
	<div class="alert alert-danger">
		
	</div>-->
  </head>
  <body>
    <main>
        <h1>Schulplanung</h1>
		<form action="submit_register" method="post">
			<div class="form_all">
				<div>
					<h2>Registrieren</h2>
					<!-- ------------------------------------ Alerts             -->
					<?php
						if ($session->register_unsuccessful == true) {
						?>
							<div id="register_unsuccessful" class="alert_unsuccessful alert alert-danger" >
								Registrierung ist fehlgeschlagen.
							</div>
						<?php
						$session->register_unsuccessful = false;
						}
					?>
					<label for="">Benutzername*: </label>
					<input type="text" name="user_name" placeholder="Geben Sie Ihren Benutzername ein">
				</div>
				<div>
					<label for="">Passwort*: </label>
					<input type="password" name="pass" placeholder="Geben Sie Ihr Passwort ein">
				</div>
				<div>
					<label for="">Passwort bestätigen*: </label>
					<input type="password" name="pass_confirm" placeholder="Geben Sie Ihr Passwort nochmals ein">
				</div>			
				<div class="">
					<h10 class="float-start">* Ist erforderlich</h10>
					<h10 class="float-start">Passwort muss mindestens 7 Zeichen enthalten</h10>
					<a class="float-start" href="<?php echo site_url('login'); ?>">Sie haben bereits ein Konto? Hier einloggen</a>
					<div>
						<button class="btn btn-primary btn-margin-top" type="submit">Register</button>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
    	</form>
    </main>
  </body>
</html>