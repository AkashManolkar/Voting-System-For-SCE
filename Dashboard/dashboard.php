<?php


session_start();
$voterdata = $_SESSION['voterdata'];

// Check if user is logged in. If not, redirect to login page.
$voterdata = isset($_SESSION['voterdata']) ? $_SESSION['voterdata'] : null;
if (!$voterdata) {
	echo '<script>
				alert("You are not logged in! Redirecting to login page.");
				location = "../index.html";
		  </script>';
	exit();
}

require '../connect.php';

$query = "SELECT * FROM addcandidate";
$result = mysqli_query($conn, $query);

if ($_SESSION['voterdata']['status'] == 0) {
	$status = '<b style = "color:green;">Not Voted</b>';
} else {
	$status = '<b style = "color:red;">Voted</b>';
}

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dashboard </title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
		crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


	<style>
		.navbar {
			position: fixed;
			top: 0px;
			left: 0;
			right: 0;
			z-index: 1000;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
		}

		.nav-item a {
			color: whitesmoke !important;
			padding: 8px 15px;
			margin: 0 5px;
			transition: all 0.3s ease;
		}

		.nav-item a:hover {
			color: whitesmoke !important;
			background: red;
			border-radius: 7px;
		}

		.navbar-brand {
			font-size: 1.8rem;
			font-weight: bold;
		}

		body {
			padding-top: 0;
		}

		#carouselExampleCaptions {
			margin-top: 56px;
			position: relative;
			overflow: hidden;
		}

		.carousel-item {
			position: relative;
			height: 0;
			padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
		}

		.carousel-item img {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			object-fit: cover;
			object-position: center;
		}

		.carousel-caption {
			background: rgba(0, 0, 0, 0.5);
			padding: 20px;
			border-radius: 10px;
			max-width: 30%;
			margin: 0 auto;
			bottom: 65%;
			transform: translateY(50%);
		}

		#main-sec {
			box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
			border-radius: 10px;
			margin-bottom: 30px;
		}

		.candidate-card {
			background: white;
			border-radius: 10px;
			padding: 20px;
			margin-bottom: 20px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
		}

		.position-section {
			background: #f8f9fa;
			padding: 20px;
			border-radius: 10px;
			margin-bottom: 30px;
		}

		.voter-card {
			background: white;
			border-radius: 10px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
		}

		.candidate-photo {
			border-radius: 10px;
			box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
			max-width: 100%;
			height: auto;
		}

		.vote-button {
			padding: 8px 20px;
			border-radius: 5px;
			transition: all 0.3s ease;
		}

		.vote-button:hover {
			transform: translateY(-2px);
		}

		.position-title {
			color: #2c3e50;
			font-weight: bold;
			margin-bottom: 20px;
			padding-bottom: 10px;
			border-bottom: 2px solid #3498db;
		}

		/* Responsive styles */
		@media (max-width: 992px) {
			.carousel-item {
				padding-bottom: 50%; /* Slightly shorter on tablets */
			}

			.carousel-caption {
				padding: 15px;
				max-width: 50%;
			}

			.carousel-caption h3 {
				font-size: 1.8rem;
			}

			.carousel-caption h4 {
				font-size: 1.4rem;
			}

			.navbar-brand {
				font-size: 1.5rem;
			}

			.voter-card {
				margin-bottom: 20px;
			}
		}

		@media (max-width: 768px) {
			.carousel-item {
				padding-bottom: 60%; /* Taller on mobile for better visibility */
			}

			.carousel-caption {
				padding: 10px;
				max-width: 95%;
			}

			.carousel-caption h3 {
				font-size: 1.5rem;
				margin-bottom: 5px;
			}

			.carousel-caption h4 {
				font-size: 1.2rem;
			}

			.navbar-brand {
				font-size: 1.3rem;
			}

			.candidate-card {
				padding: 15px;
			}

			.position-section {
				padding: 15px;
			}

			.voter-card img {
				max-width: 120px;
				height: auto;
			}
		}

		@media (max-width: 576px) {
			.carousel-item {
				padding-bottom: 75%; /* Even taller on small mobile */
			}

			.carousel-caption {
				padding: 8px;
			}

			.carousel-caption h3 {
				font-size: 1rem;
				margin-bottom: 3px;
			}

			.carousel-caption h4 {
				font-size: 0.8rem;
			}

			.navbar-brand {
				font-size: 1.1rem;
			}

			.candidate-card {
				padding: 10px;
			}

			.position-section {
				padding: 10px;
			}

			.voter-card img {
				max-width: 100px;
			}

			.vote-button {
				padding: 6px 15px;
				font-size: 0.9rem;
			}
		}
	</style>
</head>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand " style="font-family: sans;color: lawngreen; " href="#"><i
					class="fa fa-fw fa-globe"></i> Online Voting System</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mx-auto">
					<li class="nav-item">
						<a class="nav-link active" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="#vote"><i class="fa fa-fw fa-vote-yea"></i> Vote</a>
					</li>
				</ul>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
		<div class="carousel-indicators">
		</div>
		<div class="carousel-inner">
			<div class="carousel-item active">
				<img src="Image/21.jpg" class="d-block w-100" alt="Election Banner">
				<div class="carousel-caption d-md-block">
					<h3>Welcome to the Student Council Election</h3>
					<h4>Vote Smart. Vote Secure. Vote for Your Future.</h4>
				</div>
			</div>
		</div>
	</div>
	<br><br><br>

	<div class="container-fluid py-4 " id="vote">
		<div class="row ">
			<!-- Student details -->
			<div class="col-md-4 mb-4 ">
				<div class="voter-card container">
					<div class="card-header text-black">
						<h5 class="card-title text-primary text-center fw-bold">Voter Details</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-4">
								<img src="<?php echo '../VoterImg/' . $voterdata['photo']; ?>"
									class="img-fluid rounded-square" alt="Voter Photo"
									style="max-width: 150px; height: 200PX; border-radius:10px; margin-bottom: 20px;">
							</div>
							<div class="col-md-8" style="padding-left: 50px;">
								<ul class="list-unstyled">
									<li style="padding-top:10px;"><strong>Name:</strong>
										<?php echo $voterdata['name'] ?></li>
									<li><strong>Roll Number:</strong> <?php echo $voterdata['roll_number'] ?></li>
									<li><strong>Mobile No.:</strong> <?php echo $voterdata['mobile'] ?></li>
								</ul>
								<!-- <h5 class="card-title">Status: <?php echo $status ?></h5> -->
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Candidates by Position -->
			<div class="col-md-8 ">
				<?php
				$positions = ['GS', 'LR', 'Sports Secretary', 'Cultural Activity', 'Other Activity'];
				foreach ($positions as $position) {
					$query = "SELECT ac.* FROM addcandidate ac 
										  INNER JOIN candidate_positions cp ON ac.id = cp.candidate_id 
										  WHERE cp.position = '$position' ORDER BY ac.votes DESC";
					$result = mysqli_query($conn, $query);

					// Check if user has voted for this position
					$check_vote = mysqli_query($conn, "SELECT * FROM votes WHERE voter_id = '{$_SESSION['voterdata']['id']}' AND position = '$position'");
					$has_voted_position = mysqli_num_rows($check_vote) > 0;
					?>
					<div class="position-section container">
						<h3 class="position-title text-center">
							<?php echo $position; ?>
							<?php if ($has_voted_position) { ?>
								<span class="badge bg-secondary">Voted</span>
							<?php } ?>
						</h3>
						<div class="row ">
							<?php while ($row = mysqli_fetch_assoc($result)) { ?>
								<div class="col-md-6 mb-4 ">
									<div class="candidate-card">
										<div class="row">
											<div class="col-md-4">
												<img src="../Admin/images/<?php echo $row['photo']; ?>"
													class="img-fluid candidate-photo" alt="Candidate Photo">
											</div>
											<div class="col-md-8">
												<p class="card-title"><strong>Name :</strong> <?php echo $row['cname']; ?></p>
												<p class="card-text"><strong>Roll Number :</strong>
													<?php echo $row['roll_number'] ?? 'Not Set'; ?></p>
												<p class="card-text"> <?php echo $row['description'] ?></p>
												<form action="../Admin/vote.php" method="post">
													<input type="hidden" name="gvotes" value="<?php echo $row['votes']; ?>">
													<input type="hidden" name="gid" value="<?php echo $row['id']; ?>">
													<input type="hidden" name="position" value="<?php echo $position; ?>">
													<?php if (!$has_voted_position) { ?>
														<button type="submit" class="btn btn-danger vote-button">
															<i class="fa fa-check-circle"></i> Vote
														</button>
													<?php } else { ?>
														<button type="button" class="btn btn-secondary vote-button" disabled>
															<i class="fa fa-check-circle"></i> Already Voted
														</button>
													<?php } ?>
												</form>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>

	<script>
		function openRightMenu() {
			document.getElementById("rightMenu").style.display = "block";
		}

		function closeRightMenu() {
			document.getElementById("rightMenu").style.display = "none";
		}
	</script>
</body>

</html>