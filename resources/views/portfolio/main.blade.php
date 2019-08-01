@extends('layouts.app')

@push('styles')
		<!-- Custom fonts for this template -->
		<link href="{{ asset('libraries/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
		<link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
		<link href="{{ asset('libraries/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
		<!-- Custom styles for this template -->
		<link href="{{ asset('css/portfolio.min.css') }}" rel="stylesheet">
		<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
@endpush
@push('scripts')
		<!-- Bootstrap core JavaScript -->
		<script src="{{ asset('libraries/jquery/jquery.min.js') }}"></script>
		<script src="{{ asset('libraries/bootstrap/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('libraries/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

		<!-- Plugin JavaScript -->
		<script src="{{ asset('libraries/jquery-easing/jquery.easing.min.js') }}"></script>

		 <!-- Contact form JavaScript-->
		<script src="{{ asset('js/jqBootstrapValidation.js') }}"></script>
		<script src="{{ asset('js/contact_me.js') }}"></script>-->

		<!-- Custom scripts for this template -->
		<script src="{{ asset('js/agency.min.js') }}"></script>
@endpush

@section('content')
	<div id="page-top">

		<!-- Navigation -->
		<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
			<div class="container">
				<a class="navbar-brand js-scroll-trigger" href="#page-top">The Expendables</a>
				<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
					Menu
					<i class="fa fa-bars"></i>
				</button>
				<div class="collapse navbar-collapse" id="navbarResponsive">
					<ul class="navbar-nav text-uppercase ml-auto">
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#services">Services</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#portfolio">Portfolio</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#about">About</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#team">Team</a>
						</li>
						<li class="nav-item">
							<a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Header -->
		<header class="masthead">
			<div class="container">
				<div class="intro-text">
					<div class="intro-lead-in">Welcome To Our Web-page!</div>
					<div class="intro-heading text-uppercase">It's Nice To Meet You</div>
					<a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Tell Me More</a>
				</div>
			</div>
		</header>
<div class="row">


</div>
		<!-- Services -->
		<section id="services">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<h2 class="section-heading text-uppercase">Services</h2>
						<h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
					</div>
				</div>
				<div class="row text-center">
					@foreach ($services as $service)
					<div class="col-md-4">
						<span class="fa-stack fa-4x">
							<i class="fa fa-circle fa-stack-2x text-primary"></i>
							<i class="fa fa-{{$service['icon']}} fa-stack-1x fa-inverse"></i>
						</span>
						<h4 class="service-heading">{{$service['name']}}</h4>
						<p class="text-muted">{{$service['description']}}</p>
					</div>
					@endforeach
				</div>
			</div>
		</section>
		
		@include('portfolio.projects')

		<!-- About -->
		<section id="about">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<h2 class="section-heading text-uppercase">About</h2>
						<h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<ul class="timeline">
							@foreach ($about as $element)
								@if ($element['id'] % 2 == 0)
									<li>
										<div class="timeline-image">
											<img class="rounded-circle img-fluid" src="{{ $element['image'] }}" alt="">
										</div>
										<div class="timeline-panel">
											<div class="timeline-heading">
												<h4>{{ $element['date'] }}</h4>
												<h4 class="subheading">{{ $element['name'] }}</h4>
											</div>
											<div class="timeline-body">
												<p class="text-muted">{{ $element['description'] }}</p>
											</div>
										</div>
									</li>
								@elseif ($element['id'] % 2 == 1)
									<li class="timeline-inverted">
										<div class="timeline-image">
											<img class="mx-auto rounded-circle img-fluid" src="{{ $element['image'] }}" alt="">
										</div>
										<div class="timeline-panel">
											<div class="timeline-heading">
												<h4>{{ $element['date'] }}</h4>
												<h4 class="subheading">{{ $element['name'] }}</h4>
											</div>
											<div class="timeline-body">
												<p class="text-muted">{{ $element['description'] }}</p>
											</div>
										</div>
									</li>
								@endif
							@endforeach
							<li class="timeline-inverted">
								<div class="timeline-image">
									<h4>Be Part
										<br>Of Our
										<br>Story!</h4>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</section>

		@include('portfolio.team_members')

		<!-- Clients -->
		<section class="py-5">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<a href="#">
							<img class="img-fluid d-block mx-auto" src="{{ asset('img/logos/envato.jpg')}}" alt="">
						</a>
					</div>
					<div class="col-md-3 col-sm-6">
						<a href="#">
							<img class="img-fluid d-block mx-auto" src="{{ asset('img/logos/designmodo.jpg')}}" alt="">
						</a>
					</div>
					<div class="col-md-3 col-sm-6">
						<a href="#">
							<img class="img-fluid d-block mx-auto" src="{{ asset('img/logos/themeforest.jpg')}}" alt="">
						</a>
					</div>
					<div class="col-md-3 col-sm-6">
						<a href="#">
							<img class="img-fluid d-block mx-auto" src="{{ asset('img/logos/creative-market.jpg')}}" alt="">
						</a>
					</div>
				</div>
			</div>

		</section>

		<!-- Contact -->
		<section id="contact">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<h2 class="section-heading text-uppercase">Contact Us</h2>
						<h3 class="section-subheading text-muted">Lorem ipsum dolor sit amet consectetur.</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form id="contactForm" name="sentMessage" action="{{route('contact')}}" method="POST">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input class="form-control" name="name" id="name" type="text" placeholder="Your Name *" required data-validation-required-message="Please enter your name.">
										<p class="help-block text-danger"></p>
									</div>
									<div class="form-group">
										<input class="form-control" name="email" id="email" type="email" placeholder="Your Email *" required data-validation-required-message="Please enter your email address.">
										<p class="help-block text-danger"></p>
									</div>
									<div class="form-group">
										<input class="form-control" name="company" id="company" type="text" placeholder="Your Company">
										<p class="help-block text-danger"></p>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<textarea class="form-control" name="message" id="message" placeholder="Your Message *" required data-validation-required-message="Please enter a message."></textarea>
										<p class="help-block text-danger"></p>
									</div>
								</div>
								<div class="clearfix"></div>
								<div class="col-lg-12">
									<div class="alert alert-danger" id="error" role="alert" style="display:none">
										<strong>Oh no!</strong> Apply comments written below and try again.
										<div id="error_list"></div>
									</div>
									<div class="alert alert-success text-center" id="success" role="alert" style="display:none">
									</div>
								</div>
								<div class="col-lg-12 text-center">
									<button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase">Send Message</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>

		<!-- Footer -->
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<span class="copyright">Copyright &copy; The Expendables {{ date('Y') }}</span>
					</div>
					<div class="col-md-6">
						<ul class="list-inline social-buttons">
							<li class="list-inline-item">
								<a href="#">
									<i class="fa fa-twitter"></i>
								</a>
							</li>
							<li class="list-inline-item">
								<a href="#">
									<i class="fa fa-facebook"></i>
								</a>
							</li>
							<li class="list-inline-item">
								<a href="#">
									<i class="fa fa-linkedin"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</footer>
		
		@stack('modals')
	</div>
@endsection('content')