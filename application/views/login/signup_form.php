<!DOCTYPE html>
<html lang="en">
<html>
<head>
	<title>Quizzy Time</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta charset="utf-8" />
	<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

	<style type="text/css">
		@import url(https://fonts.googleapis.com/css?family=Roboto:300);

		a {
			text-decoration: none !important;
			font-family: FontAwesome, "Roboto", sans-serif;
			text-align: center;
			font-weight: bold;
			letter-spacing: 1px;
			color: #000000;
			/*font-style: normal;*/
		}

		.login-page {
			width: 360px;
			margin: auto;
			margin-top: 2rem;

		}
		.form {
			position: relative;
			z-index: 1;
			background: #3C5060;
			max-width: 360px;
			/*margin: 0 auto;*/
			padding-left: 35px;
			padding-right: 35px;
			text-align: center;
			box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);

		}
		.form input {
			font-family: FontAwesome, "Roboto", sans-serif;
			outline: 0;
			background: #f2f2f2;
			width: 100%;
			border: 0;
			margin: 0 0 15px;
			padding: 15px;
			box-sizing: border-box;
			font-size: 14px;
			border-radius:10px;

		}
		.form button,
		.submit-btn {
			font-family: "Titillium Web", sans-serif;
			font-size: 14px;
			font-weight: bold;
			letter-spacing: .1em;
			outline: 0;
			background: #EFF8E2;
			width: 100%;
			border: 0;
			border-radius:30px;
			margin: 0px 0px 8px;
			padding: 15px;
			color: #0C1618;
			-webkit-transition: all 0.3 ease;
			transition: all 0.3 ease;
			cursor: pointer;
			transition: all 0.2s;

		}
		.form button:hover,
		.form button:focus,
		.submit-btn:hover,
		.submit-btn:focus{
			background: #148f77;
			box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
		}
		.form button:active,
		.submit-btn:active {
			transform: translateY(2px);
			box-shadow: 0 2.5px 5px rgba(0, 0, 0, 0.2);
		}

		.form .message {
			margin: 6px 6px;
			color: #808080;
			font-size: 11px;
			text-align: center;
			font-weight: bold;
			font-style: normal;
		}
		.form .message a {
			color: #FFFFFF;
			text-decoration: none;
			font-size: 13px;
		}
		.form .register-form {
			display: none;
		}
		.container {
			position: relative;
			z-index: 1;
			max-width: 300px;
			margin: 0 auto;
		}
		.container:before, .container:after {
			content: "";
			display: block;
			clear: both;
		}
		.container .info {
			margin: 50px auto;
			text-align: center;
		}
		.container .info h1 {
			margin: 0 0 15px;
			padding: 0;
			font-size: 36px;
			font-weight: 300;
			color: #1a1a1a;
		}
		.container .info span {
			color: #4d4d4d;
			font-size: 12px;
		}
		.container .info span a {
			color: #000000;
			text-decoration: none;
		}
		.container .info span .fa {
			color: #EF3B3A;
		}
		body {
			background: #587792;
			font-family: "Roboto", sans-serif;
			-webkit-font-smoothing: antialiased;
			-moz-osx-font-smoothing: grayscale;
		}


	</style>
</head>


<div class="login-page">
	<?php if ($this->session->flashdata('error')) :?>
		<div class="alert alert-danger alert-dismissible fade show js-alert" role="alert">
			<?= $this->session->flashdata('error'); ?>
		</div>
	<?php endif; ?>
	<?php if ($this->session->flashdata('success')) :?>
		<div class="alert alert-success alert-dismissible fade show js-alert" role="alert">
			<?= $this->session->flashdata('success'); ?>
		</div>
	<?php endif; ?>
	<div class="form">
		<form action="/quiz-app/index.php/login/Login/signup" method="post">
			<lottie-player
				src="https://assets4.lottiefiles.com/datafiles/XRVoUu3IX4sGWtiC3MPpFnJvZNq7lVWDCa8LSqgS/profile.json"
				background="transparent"
				speed="1"
				style="width: 200px; height: 200px; margin: auto; justify-content: center; "
				loop
				loop
				autoplay
			></lottie-player>
			<input type="text" name="username" placeholder="Pick a Username" />
			<input type="password" id="password" name="password" placeholder="Set a Password" />
			<input type="text" id="name" name="name" placeholder="Enter name" />
			<i class="fas fa-eye" onclick="show()"></i>
			<br>
			<br>
			<button type="submit" formaction="<?php echo base_url('signup/submit') ?>">
				SIGN UP
			</button>
		</form>

		</form>
		<a href="<?php echo base_url('login/') ?>" >Already have an account?</a>
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
		document.querySelectorAll('.js-alert').forEach(function($el) {
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
</html>
