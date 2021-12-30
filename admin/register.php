<?php
session_start();
if (isset($_SESSION["logged_in"])) {
	header("location: index.php");
	exit;
}
?>

<HTML>

<head>
	<title>REGISTER USER PAGE</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
	<style>
		@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			font-family: 'Poppins', sans-serif
		}

		.container {
			margin: 50px auto
		}

		.body {
			position: relative;
			width: 720px;
			height: 440px;
			margin: 20px auto;
			border: 1px solid #dddd;
			border-radius: 18px;
			overflow: hidden;
			box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px
		}

		.box-1 img {
			width: 100%;
			height: 100%;
			object-fit: cover
		}

		.box-2 {
			padding: 10px
		}

		.box-1,
		.box-2 {
			width: 50%
		}

		.h-1 {
			font-size: 24px;
			font-weight: 700
		}

		.text-muted {
			font-size: 14px
		}

		.container .box {
			width: 100px;
			height: 100px;
			display: flex;
			flex-direction: column;
			align-items: center;
			justify-content: center;
			border: 2px solid transparent;
			text-decoration: none;
			color: #615f5fdd
		}

		.box:active,
		.box:visited {
			border: 2px solid #ee82ee
		}

		.box:hover {
			border: 2px solid #ee82ee
		}

		.btn.btn-primary {
			background-color: transparent;
			color: #ee82ee;
			border: 0px;
			padding: 0;
			font-size: 14px
		}

		.btn.btn-primary .fas.fa-chevron-right {
			font-size: 12px
		}

		.footer .p-color {
			color: #ee82ee
		}

		.footer.text-muted {
			font-size: 10px
		}

		.fas.fa-times {
			position: absolute;
			top: 20px;
			right: 20px;
			height: 20px;
			width: 20px;
			background-color: #f3cff379;
			font-size: 18px;
			display: flex;
			align-items: center;
			justify-content: center
		}

		.fas.fa-times:hover {
			color: #ff0000
		}

		@media (max-width:767px) {
			body {
				padding: 10px
			}

			.body {
				width: 100%;
				height: 100%
			}

			.box-1 {
				width: 100%
			}

			.box-2 {
				width: 100%;
				height: 440px
			}
		}
	</style>

	<div class="container">
		<div class="body d-md-flex align-items-center justify-content-between">
			<div class="box-1 mt-md-0 mt-5"> <img src="https://i.ibb.co/2ZPxp2z/1500x500.jpg?auto=compress&cs=tinysrgb&dpr=2&w=500" class="" alt=""> </div>
			<div class=" box-2 d-flex flex-column h-100">
				<div class="mt-5">
					<p class="mb-1 h-1">Sign In.</p>
					<!-- <p class="text-muted mb-2">Share your thouhts with the world form today.</p> -->
					<div class="d-flex flex-column ">
						<form method="POST" action="register.php">
							<input type="text" name="username" class="form-control" placeholder="Username">
							<input type="password" name="password" class="form-control" placeholder="Password">
							<button type="submit" name="register_user" class="btn btn-lg btn-primary btn-block btn-signin" value="Register">Register</button><br>
						</form>
						<div class="mt-3">
							<p class="mb-0 text-muted">Already a member?</p>
							<div class="btn btn-primary"><a href="login.php">Login</a><span class="fas fa-chevron-right ms-1"></span></div>
						</div>
					</div>
				</div>
				<div class="mt-auto">
					<p class="footer text-muted mb-0 mt-md-0 mt-4">By register you agree with our <span class="p-color me-1">terms and conditions</span>and <span class="p-color ms-1">privacy policy</span> </p>
				</div>
			</div> <span class="fas fa-times"></span>
		</div>
	</div>


	<?php
	if (isset($_POST["username"]) or isset($_POST["password"])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username)) {
			echo "Please fill the username blank..";
		} else if (empty($password)) {
			echo "Please fill the password blank..";
		} else {
			$conn = new mysqli('localhost', 'root', '', 'project');

			$query = "SELECT * FROM users WHERE username='$username' LIMIT 1";

			$response = mysqli_query($conn, $query);

			$user = mysqli_fetch_assoc($response);

			if ($user['username'] === $username) {
				echo "User is already exists, Please try to login";
			} else {
				$query_register = "INSERT INTO users (username, password) VALUES('$username', '$password')";
				mysqli_query($conn, $query_register);
				$_SESSION['username'] = $username;
				$_SESSION['logged_in'] = true;
				header('location: index.php');
			}
		}
	}
	?>
</body>

</HTML>