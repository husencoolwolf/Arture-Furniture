<?php?>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Arture Furniture</title>
	<link rel="stylesheet" href="/dist/css/bootstrap.css">
	<link rel="stylesheet" href="/dist/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/dist/css/pages/daftar.css">

</head>

<body>

	<body>
		<div class="container">
			<div class="row">
				<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
					<div class="card border-0 shadow rounded-3 my-2">
						<div class="card-body p-4 p-sm-5">
							<div class="w-100 text-center">
								<a href="/index.php">
									<img src="/assets/material/Logo-transparent.png" style="width: 220px">
								</a>
							</div>
							<h5 class="card-title text-center mb-2 fw-light fs-5">Daftar</h5>
							<form>
								<div class="form-floating mb-3">
									<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
									<label for="floatingInput">Email address</label>
								</div>
								<div class="form-floating mb-3">
									<input type="password" class="form-control" id="floatingPassword" placeholder="Password">
									<label for="floatingPassword">Password</label>
								</div>

								<div class="form-check mb-3">
									<input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
									<label class="form-check-label" for="rememberPasswordCheck">
										Remember password
									</label>
								</div>
								<div class="mb-3">
									<p>Sudah terdaftar?, silahkan <a href="login.php">Login</a></p>
								</div>
								<div class="d-grid">
									<button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit">Sign
										in</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<script src="/dist/js/jquery-3.5.1.js"></script>
	<script src="/dist/js/bootstrap.js"></script>

</html>