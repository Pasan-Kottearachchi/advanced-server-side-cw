<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Quizzy Time</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>

	<style>
		.img-fluid {
			width: 100%;
			height: 100%;
		}

		.side-bar-user-details {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			margin-top: 20px;
		}

		.side-bar-user-details-container {
			/*margin-left: 10px;*/
		}

		.img-fluid-card img {
			width: 250px;
			height: 100px;
			border-radius: 20%;
			border: #55586c 2px solid;

		}

		.profile-edit-card {
			margin-top: 20px;
			width: 80%;
		}

		.profile-edit-container {
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			width: 90%;
			height: 94%;
			margin: 10px;
		}

		.main-wrapper {
			display: flex;
			flex-direction: row;
			justify-content: space-between;
			/*margin-left: 15px;*/
			margin: auto;
		}

		.stat-card {
			width: 100%;
			margin: 10px;
		}

		.detail-card {
			width: 100%;
			margin: 10px;
		}

		.submit-answer-btn {
			float: right;
			width: 200px;
			margin-top: 10%;
		}

	</style>


</head>
<body>
<container>
	<div class="main-div" style="margin-top: 120px">
		<div class="row main-wrapper">
			<div class="col-md-3 side-bar-user-details-container">
				<div class="card detail-card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-4 img-fluid-card">
								<img src="https://www.w3schools.com/bootstrap4/img_avatar1.png" alt="profile"
									 class="img-fluid">
							</div>
							<div class="col-md-8 side-bar-user-details">
								<!--								<h5>-->
								<?php //echo $user_data['first_name'] . ' ' . $user_data['last_name']; ?><!--</h5>-->
								<!--								<p>-->
								<?php //echo $user_data['email']; ?><!--</p>-->
								<h5><?php echo $data['userDetails']->name; ?></h5>
								<p><?php echo $data['userDetails']->username ?></p>
							</div>
						</div>
					</div>
				</div>
				<div class="card stat-card">
					<div class="card-body">
						<h5>Quizes</h5>
						<table>
							<tr>
								<td>Total Quizes Created:</td>
								<td/>
								<td/>
								<td/>
								<td><?php echo $data['userStats']['createdQuizCount']; ?></td>
							</tr>
							<tr>
								<td>Total Quizes Participated:</td>
								<td/>
								<td/>
								<td/>
								<td><?php echo $data['userStats']['participatedQuizCount']; ?></td>
							</tr>
							<tr>
								<td>Total Quizes Attempted:</td>
								<td/>
								<td/>
								<td/>
								<td><?php echo $data['userStats']['attemptedQuizCount']; ?></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-9">
				<div class="card profile-edit-container">
					<div class="card-body profile-edit-card">
						<h5>Profile</h5>
						<hr>
						<form id="user-detail-form" action="" method="POST">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group first-name-group">
										<label for="name">Name</label>
										<input type="text" name="name" id="name" class="form-control"
											   value="<?php echo $data['userDetails']->name; ?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group last-name-group">
										<label for="user_name">Username</label>
										<input type="text" name="user_name" id="user_name" class="form-control"
											   value="<?php echo $data['userDetails']->username ?>" disabled>
									</div>
								</div>
							</div>
						</form>

						<button class="submit-answer-btn btn btn-success" onclick="submitUserData()">
							Submit
						</button>
						<!--						<hr>-->
						<!--						<h5>Additional Details</h5>-->
						<!--<						show additional user details -->
						<!--						<div class="row">-->
						<!--							<div class="col-md-6">-->
						<!--								<div class="form-group first-name-group">-->
						<!--									<label for="first_name">Phone Number</label>-->
						<!--									<input type="text" name="first_name" id="first_name" class="form-control"-->
						<!--										   value="-->
						<?php //echo '0123456789'; ?><!--">-->
						<!--								</div>-->
						<!--							</div>-->
						<!--							<div class="col-md-6">-->
						<!--								<div class="form-group phone-number-group">-->
						<!--									<label for="phone-number">Phone Number</label>-->
						<!--									<input type="tel" name="phone-number" id="phone-number" class="form-control">-->
						<!--									<span class="input-group-addon">Tel</span>-->
						<!--								</div>-->
						<!--							</div>-->
						<!--						</div>-->

					</div>
				</div>
			</div>

		</div>
	</div>
</container>
</body>
<script>
	function submitUserData() {
		const form = document.querySelector('#user-detail-form');
		const formData = new FormData(form);
		const object = {};
		formData.forEach((value, key) => object[key] = value);

		$.ajax({
			type: "POST",
			url: "<?php echo base_url('profile/edit/'.$this->session->userdata('user_id')); ?>",
			data: {
				"userData": object
			},
			dataType: 'json',
			success: function (response) {
				location.reload();
			}
		})
	}
</script>
</html>
