<!DOCTYPE html>
<html>

<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8" />
	<title>CRM - Register</title>

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

	<x-style></x-style>

	<link rel="stylesheet" type="text/css" href="src/plugins/jquery-steps/jquery.steps.css" />

</head>

<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="/">
					<img src="https://allureindustries.com/files/uploads/2016/03/600.png" style="height: 50%;" alt="" />
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="/login">Login</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
					<img src="vendors/images/register-page-img.png" alt="" />
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="register-box bg-white box-shadow border-radius-10">
						<div class="wizard-content">
							<form class="tab-wizard2 wizard-circle wizard" id="register" method="post" action="/register">
								@csrf
								<h5>Daftar</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Name*</label>
											<div class="col-sm-8">
												<input type="text"
													class="form-control name @error('name') is-invalid @enderror"
													name="name" value="{{ old('name') }}"/>
												@error('name')
													<small class="text-danger">{{ $message }}</small>
												@enderror
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Email Address*</label>
											<div class="col-sm-8">
												<input type="email"
													class="form-control email @error('email') is-invalid @enderror"
													name="email" value="{{ old('email') }}" />
													@error('email')
														<small class="text-danger">{{ $message }}</small>
													@enderror
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Password*</label>
											<div class="col-sm-8">
												<input type="password"
													class="form-control password @error('password') is-invalid @enderror"
													name="password" />
													@error('password')
														<small class="text-danger">{{ $message }}</small>
													@enderror
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-4 col-form-label">Confirm Password*</label>
											<div class="col-sm-8">
												<input type="password" class="form-control" id="confirm_password"
													name="password_confirmation" />
											</div>
										</div>
									</div>
								</section>
								<!-- Step 4 -->
								<h5>Overview</h5>
								<section>
									<div class="form-wrap max-width-600 mx-auto">
										<ul class="register-info">
											<li>
												<div class="row">
													<div class="col-sm-4 weight-600">Name</div>
													<div class="col-sm-8" id="name"></div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-4 weight-600">Email Address</div>
													<div class="col-sm-8" id="email"></div>
												</div>
											</li>
											<li>
												<div class="row">
													<div class="col-sm-4 weight-600">Password</div>
													<div class="col-sm-8" id="password"></div>
												</div>
											</li>
										</ul>
									</div>
								</section>
								<button type="submit" id="submit" hidden></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<x-script></x-script>


	<script src="/src/plugins/jquery-steps/jquery.steps.js"></script>
	<script src="/vendors/scripts/steps-setting.js"></script>
	<script>
		let nama = document.querySelector('.name');
		let email = document.querySelector('.email');
		let password = document.querySelector('.password');
		let confirm = document.getElementById("confirm_password");

		nama.addEventListener("input", function (elemen) {
			document.getElementById("name").innerHTML = elemen.target.value;
		});

		email.addEventListener("input", function (elemen) {
			document.getElementById("email").innerHTML = elemen.target.value;
		});

		password.addEventListener("input", function (elemen) {
			document.getElementById("password").innerHTML = elemen.target.value;

			if (elemen.target.value != confirm.value) {
				confirm.classList.add("is-invalid");
			} else {
				confirm.classList.remove("is-invalid");
			}

		});

		confirm.addEventListener("input", function (elemen) {
			if (elemen.target.value != password.value) {
				elemen.target.classList.add("is-invalid");
			} else {
				elemen.target.classList.remove("is-invalid");
			}
		});
	</script>
</body>

</html>