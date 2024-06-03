@extends('frontend.layout')

@section('content')
	<div class="breadcrumb-area pt-205 breadcrumb-padding pb-210" style="background-image: url({{ asset('themes/ezone/assets/img/bg/adat.png') }})">
		<div class="container-fluid">
			<style>
        .breadcrumb-content {
            text-align: center;
        }

        .breadcrumb-content h2,
        .breadcrumb-content ul li a,
        .breadcrumb-content ul li {
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
            font-size: 2em; /* Anda dapat mengatur ukuran sesuai keinginan */
        }

        .breadcrumb-content ul li {
            display: inline;
            list-style: none;
            margin: 0 5px;
        }

        .breadcrumb-content ul li::after {
            content: "/";
            margin-left: 5px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
        }

        .breadcrumb-content ul li:last-child::after {
            content: "";
        }
    </style>

    <div class="breadcrumb-content text-center">
        <h2>Register</h2>
        <ul>
            <li><a href="#">Home</a></li>
            <li>register</li>
        </ul>
    </div>
		</div>
	</div>
	<!-- register-area start -->
	<div class="register-area ptb-100" style="position: relative; background-color: #f8f7f4;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
					<div class="login" style="border: none;">
						<div class="login-form-container" style="background: none;">
							<div class="login-form">
								<form method="POST" action="{{ route('register') }}">
									@csrf

									<div class="form-group row">
										<div class="col-md-12">
											<input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror input-animate" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus placeholder="First name">
											@error('first_name')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12">
											<input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror input-animate" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus placeholder="Last name">
											@error('last_name')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12">
											<input id="email" type="email" class="form-control @error('email') is-invalid @enderror input-animate" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
											@error('email')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12">
											<input id="password" type="password" class="form-control @error('password') is-invalid @enderror input-animate" name="password" required autocomplete="new-password" placeholder="Password">
											@error('password')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
											@enderror
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12">
											<input id="password-confirm" type="password" class="form-control input-animate" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
										</div>
									</div>

									<div class="button-box">
										<button type="submit" class="default-btn floatright">Register</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Robot animation -->
		<div class="robot-animation"></div>
	</div>
	<!-- register-area end -->

	<style>
		/* Background color for the register area */
		.register-area {
			background-color: #fbfbf9;
			position: relative;
			overflow: hidden;
		}

		/* Robot animation */
		.robot-animation {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 200px; /* Ukuran lebar, sesuaikan sesuai kebutuhan */
    height: 200px; /* Ukuran tinggi , sesuaikan sesuai kebutuhan */
    background: url('{{ asset('themes/ezone/assets/img/bg/berlari.gif') }}') no-repeat bottom center;
    background-size: contain;
    animation: moveRobot 10s linear infinite;
}

/* Keyframes untuk mengatur animasi bergerak dari kiri ke kanan */
@keyframes moveRobot {
    0% {
        left: -200px; /* Mulai dari luar layar di sebelah kiri */
    }
    100% {
        left: 100%; /* Berakhir di luar layar di sebelah kanan */
    }
}
		}

		@keyframes moveRobot {
			0% {transform: translateX(0);}
			100% {transform: translateX(100%);}
		}

		/* Animasi pada kolom input */
		.input-animate {
			position: relative;
			z-index: 1;
			background: rgba(174, 167, 167, 0.8);
			transition: background 0.3s, transform 0.3s;
		}

		.input-animate:focus {
			background: rgb(240, 236, 236);
			transform: scale(1.05);
		}

		/* Style untuk menghilangkan border dan background pada form */
		.login {
			border: none;
			background: none;
		}

		.login-form-container {
			background: none;
		}
	</style>
@endsection
