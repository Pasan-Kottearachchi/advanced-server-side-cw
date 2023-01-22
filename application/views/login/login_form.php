<!DOCTYPE HTML>
<html lang="en">
<html>
<head>
	<title>Quizzy Time</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo CSS_URL . 'assets/css/authentication/login.css'; ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
		  integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>

<body class="body">
<div class="login-page">
	<?php if ($this->session->flashdata('error')) : ?>
		<div class="alert alert-danger alert-dismissible fade show js-alert" role="alert">
			<?= $this->session->flashdata('error');  unset($_SESSION['error']);?>
		</div>
	<?php endif; ?>
	<?php if ($this->session->flashdata('success')) : ?>
		<div class="alert alert-success alert-dismissible fade show js-alert" role="alert">
			<?= $this->session->flashdata('success'); ?>
		</div>
	<?php endif; ?>
	<div class="form">
		<form method="post">
			<lottie-player
					src="https://assets4.lottiefiles.com/datafiles/XRVoUu3IX4sGWtiC3MPpFnJvZNq7lVWDCa8LSqgS/profile.json"
					background="transparent"
					speed="1"
					style="width: 200px; height: 200px; margin: auto; justify-content: center; "
					loop
					autoplay>
			</lottie-player>
			<input type="text" name="username" placeholder="&#xf007;  Username"/>
			<input type="password" id="password" name="password" placeholder="&#xf023;  Password"/>
			<i class="fas fa-eye" onclick="show()"></i>
			<br>
			<br>

			<button type="submit" formaction="<?php echo base_url('login/submit') ?>">
				SIGN IN
			</button>
		</form>
		<div class="message">
			Not registered? <a href="<?php echo base_url('signup/') ?>">Create an account</a>
		</div>
	</div>
</div>
</body>
<script>
	function show() {
		var password = document.getElementById("password");
		var icon = document.querySelector(".fas");

		// ========== Checking type of password ===========
		if (password.type === "password") {
			password.type = "text";
		} else {
			password.type = "password";
		}
	}

	if (document.querySelector('.js-alert')) {
		document.querySelectorAll('.js-alert').forEach(function ($el) {
			setTimeout(() => {
				$el.classList.remove('show');
			}, 2000);
		});
		// removeAlert div after 2 seconds
		setTimeout(() => {
			document.querySelector('.js-alert').remove();
		}, 2000);
	}
</script>
</html>
