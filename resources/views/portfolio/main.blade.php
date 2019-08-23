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
		<link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
		<link href="{{ asset('css/styles.css') }}" rel="stylesheet">
		<link href="{{ asset('libraries/slick/slick.css') }}" rel="stylesheet">
		<link href="{{ asset('libraries/slick/slick-theme.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/customPortfolio.css') }}">
		{{--Fancybox--}}
		<link rel="stylesheet" href="{{ asset('libraries/fancybox/dist/jquery.fancybox.min.css') }}">
@endpush
@push('scripts')
		<!-- Bootstrap core JavaScript -->
		<script src="{{ asset('libraries/jquery/jquery.min.js') }}"></script>
		<script src="{{ asset('libraries/bootstrap/js/bootstrap.min.js') }}"></script>
		<script src="{{ asset('libraries/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		{{--Slick--}}
		<script src="{{ asset('libraries/slick/slick.min.js') }}"></script>
		<!-- Plugin JavaScript -->
		<script src="{{ asset('libraries/jquery-easing/jquery.easing.min.js') }}"></script>
		{{-- Fancybox --}}
		<script src="{{ asset('libraries/fancybox/dist/jquery.fancybox.min.js') }}"></script>
		 <!-- Contact form JavaScript-->
		<script src="{{ asset('js/jqBootstrapValidation.js') }}"></script>
		<script src="{{ asset('js/contact_me.js') }}"></script>

		<!-- Custom scripts for this template -->
		<script src="{{ asset('js/agency.min.js') }}"></script>

@endpush

@section('content')
	<div id="page-top">

		@include('portfolio.partials.header')

{{--		@include('portfolio.sections.about')--}}

		@include('portfolio.sections.services')
		
		@include('portfolio.sections.projects')

		@include('portfolio.sections.team_members')

		@include('portfolio.sections.contact')

		@include('portfolio.partials.footer')
		
		@stack('modals')
	</div>
@endsection('content')