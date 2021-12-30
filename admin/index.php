<?php
session_start();
if (!isset($_SESSION["logged_in"])) {
	header("location: login.php");
	exit;
}
?>

<HTML>

<head>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Admin Page</title>
	<style>
		.wrapper {
			width: 1200px;
			margin: 0 auto;
		}

		table tr td:last-child {
			width: 120px;
		}
	</style>
</head>

<body>
	<!-- <div class="wrapper"> -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="mt-5 mb-3 clearfix">
					<?php echo "<h2 class='pull-left'><u>{$_SESSION['username']}</u> - Active Job Advertisements</h2>"; ?>
					<a href="logout.php" class="btn btn-danger pull-right"><i class="fa fa-minus-square-o"></i> Log Out</a>
					<a href="add.php" class="btn btn-success pull-right" style="margin-right: 25px;"><i class="fa fa-plus"></i> Add New Job Ad</a>
				</div>
				<?php
				$conn = new mysqli('localhost', 'root', '', 'project');
				$query = "SELECT * FROM jobs WHERE publisher='{$_SESSION['username']}';";
				if ($result = mysqli_query($conn, $query)) {
					if (mysqli_num_rows($result) > 0) {
						echo '<table class="table table-bordered table-striped">';
						echo "<thead>";
						echo "<tr>";
						echo "<th>ID</th>";
						echo "<th>Company</th>";
						echo "<th>Company Logo URL</th>";
						echo "<th>Title</th>";
						echo "<th>Description</th>";
						echo "<th>Applying URL</th>";
						echo "<th>Publisher</th>";
						echo "<th>Publish Date</th>";
						echo "<th>Tag</th>";
						echo "<th>Status</th>";
						echo "<th>Operators	</th>";
						echo "</tr>";
						echo "</thead>";
						echo "<tbody>";
						while ($row = mysqli_fetch_array($result)) {
							echo "<tr>";
							echo "<td>" . $row['id'] . "</td>";
							echo "<td>" . $row['company'] . "</td>";
							echo "<td>" . $row['company_logo_url'] . "</td>";
							echo "<td>" . $row['title'] . "</td>";
							echo "<td>" . $row['description'] . "</td>";
							echo "<td>" . $row['apply_url'] . "</td>";
							echo "<td>" . $row['publisher'] . "</td>";
							echo "<td>" . $row['publish_date'] . "</td>";
							echo "<td>" . $row['tag'] . "</td>";
							echo "<td>" . $row['status'] . "</td>";
							echo "<td>";
							echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Job" data-toggle="tooltip"><span class="fa fa-pencil" style="font-size:25px;"></span></a>';
							if ($row['status']) {
								echo '<a href="disable.php?id=' . $row['id'] . '" class="mr-3" title="Disable Job" data-toggle="tooltip"><span class="fa fa-eye" style="font-size:25px; color:green;"></span></a>';
							} else {
								echo '<a href="disable.php?id=' . $row['id'] . '" class="mr-3" title="Enable Job" data-toggle="tooltip"><span class="fa fa-eye-slash" style="font-size:25px; color:darkgreen;"></span></a>';
							}
							echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Job" data-toggle="tooltip"><span class="fa fa-trash" style="font-size:25px; color:red; margin-left: 8px;"></span></a>';
							echo "</td>";
							echo "</tr>";
						}
						echo "</tbody>";
						echo "</table>";
						// Free result set
						mysqli_free_result($result);
					} else {
						echo '<div class="alert alert-danger"><em>No records were found. Please add one..</em></div>';
					}
				} else {
					echo "Oops! Something went wrong. Please try again later.";
				}
				?>
			</div>
		</div>
	</div>
	<!-- </div> -->

</body>

</HTML>