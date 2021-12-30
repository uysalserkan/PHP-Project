<HTML>

<head>
	<title>Homepage - uysalserkan</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<style>
	body {
		font-family: arial;
		background: lightseagreen
	}

	.logo {
		border: 1px solid #f6f6f6
	}

	.logo img {
		width: 70px;
		height: 70px
	}

	.card {
		display: block;
		padding: 3vh 2vh 7vh 5vh;
		border: none;
		border-radius: 15px;
		margin-top: 5%;
		margin-bottom: 5%;
		max-width: 500px
	}

	.header {
		margin-bottom: 5vh;
		margin-right: 2vh;
		float: right;
		margin-left: auto
	}

	.far {
		color: rgba(15, 198, 239, 0.97) !important;
		font-size: 16px !important
	}

	p.heading {
		font-weight: bold;
		font-size: 25px
	}

	p.text-muted {
		font-size: 17px;
		font-weight: bold;
		color: #a1a7ae !important
	}

	.btn-sm {
		border-radius: 8px
	}

	.fas.fa-users {
		color: rgba(15, 198, 239, 0.97) !important
	}

	.mutual span {
		font-size: 14px;
		color: #adb5bd;
		font-weight: bold
	}

	.btn-primary.btn-lg {
		border-radius: 30px;
		width: 90%;
		border: none;
		background: #8c02e3
	}

	.btn-dark.btn-lg {
		border-radius: 30px;
		width: 90%;
		border: none;
		background: #dee2e6
	}

	.btn-dark span {
		font-size: 14px;
		text-align: center;
		color: #0000008c;
		font-weight: bold
	}

	.btn-primary span {
		font-size: 14px;
		text-align: center;
		color: #fff;
		font-weight: bold
	}

	/* NavBar */
	body {
		margin: 0;
		padding: 0;
		width: 100%;
		min-height: 100vh;
	}

	body {
		font-family: "Open Sans", sans-serif;
		background: #e0e0e0;
	}

	.jumbo {
		padding-top: 100px;
		min-height: 200vh;
	}
</style>


<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container">
			<a class="nav-link active">Job Portal | UYSAL</a>

			<div class="collapse navbar-collapse" id="navbarMain">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="/admin" target="_blank">Admin Page</a>
					</li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</nav>

	<div class="container-flex p-3 m-2">
		<div class="row">

			<?php
			$conn = new mysqli('localhost', 'root', '', 'project');
			$all_jobs_query = "SELECT * FROM jobs";

			$response = mysqli_query($conn, $all_jobs_query);

			while ($each_job = mysqli_fetch_array($response)) {


				echo "<div class='card mx-auto'>"
					. "<div class='row'>"
					. "<div class='logo ml-3 mb-3'><img src={$each_job['company_logo_url']}></div>"
					. "<div class='header left'><h4><i class='fas fa-ellipsis-h'>{$each_job['company']}</i></h4></div>"
					. "<div class='header right'><i class='fas fa-ellipsis-h'>{$each_job['publish_date']}</i></div>"
					. "</div>"
					. "<div class='card-title'>"
					. 	"<p class='heading'><b>{$each_job['title']}&nbsp;</b><i class='far fa-compass'></i></p>"
					. "</div>"
					. "<p class='text-muted'>{$each_job['description']}</p>"
					. 	"<div class='row btnrow my-4'>"
					. 		"<div class='col-6 col-md-6'><button type='button' class='btn btn-outline-primary btn-sm' style='background: #007bff33;'><b>Tag</b> {$each_job['tag']}</button></div>"
					. 		"<div class='col-4 col-md-3'><button type='button' class='btn btn-outline-danger btn-sm' style='background:"; // #dc35452e;'><b>Status</b>
				if ($each_job['status']) {
					echo "#00ff002b;'><b>Open</b>";
				} else {
					echo "#dc35452e;'><b>Closed</b>";
				}

				echo "</button></div>"
					. "	</div>"
					. 	"<div class='mutual'><i class='fas fa-users'></i>&nbsp;&nbsp;<span><b>Publisher: </b>{$each_job['publisher']}</span></div>"
					. 	"<div class='row btnsubmit mt-4'>";

				if ($each_job['status'] == 0) {
					echo "<div class='col-md-6 col-6'><a href='{$each_job['apply_url']}' target='_blank' class='btn btn-danger disabled' style='width: 160px;'><i class='fa fa-exit'></i> Closed</a> <br></div>";
				} else if (str_starts_with($each_job['apply_url'], 'http')) {
					echo "<div class='col-md-6 col-6'><a href='{$each_job['apply_url']}' target='_blank' class='btn btn-dark' style='width: 160px;'><i class='fa fa-exit'></i> Out-Source Page</a> <br></div>";
				} else {
					echo "<div class='col-md-6 col-6'><a href='apply.php?id={$each_job['id']}' target='_blank' class='btn btn-primary' style='width: 160px;'><i class='fa fa-exit'></i> Apply Page</a> <br></div>";
				}
				echo "</div>"
					. "</div>";
			}
			?>

		</div>
	</div>
</body>

</HTML>